<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    
    // Transactions
    Route::get('/transactions', [TransactionController::class, 'adminIndex'])->name('admin.transactions.index');
    Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'adminEdit'])->name('admin.transactions.edit');
    Route::put('/transactions/{transaction}', [TransactionController::class, 'adminUpdate'])->name('admin.transactions.update');
});

// User Routes
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', [TransactionController::class, 'userDashboard'])->name('user.dashboard');
    
    // Products Search
    Route::get('/products', function () {
        $search = request('search');
        $products = \App\Models\Product::when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('sku', 'like', '%' . $search . '%');
        })->paginate(10);
        return view('user.products.index', compact('products', 'search'));
    })->name('user.products.index');
    
    // Transactions
    Route::get('/transactions', [TransactionController::class, 'userIndex'])->name('user.transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'userCreate'])->name('user.transactions.create');
    Route::post('/transactions', [TransactionController::class, 'userStore'])->name('user.transactions.store');
});

