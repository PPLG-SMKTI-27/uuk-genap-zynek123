<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::where('status', 'completed')->sum('total_price');
        $recentTransactions = Transaction::with('user', 'product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalProducts', 'totalTransactions', 'totalRevenue', 'recentTransactions'));
    }
}
