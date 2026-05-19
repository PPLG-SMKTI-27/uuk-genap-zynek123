<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function adminIndex()
    {
        $search = request('search');
        $transactions = Transaction::with('user', 'product')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.transactions.index', compact('transactions', 'search'));
    }

    public function adminEdit(Transaction $transaction)
    {
        return view('admin.transactions.edit', compact('transaction'));
    }

    public function adminUpdate(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $transaction->update($request->only('status'));
        return redirect()->route('admin.transactions.index')->with('success', 'Status transaksi berhasil diupdate');
    }

    public function userIndex()
    {
        $search = request('search');
        $transactions = auth()->user()->transactions()
            ->with('product')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.transactions.index', compact('transactions', 'search'));
    }

    public function userCreate()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('user.transactions.create', compact('products'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok tidak cukup']);
        }

        $totalPrice = $product->price * $request->quantity;

        Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        $product->decrement('stock', $request->quantity);

        return redirect()->route('user.transactions.index')->with('success', 'Transaksi berhasil dibuat');
    }

    public function userDashboard()
    {
        $totalTransactions = auth()->user()->transactions()->count();
        $totalSpent = auth()->user()->transactions()->sum('total_price');
        $recentTransactions = auth()->user()->transactions()
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('user.dashboard', compact('totalTransactions', 'totalSpent', 'recentTransactions'));
    }
}
