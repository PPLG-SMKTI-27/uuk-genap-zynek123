<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            min-height: 100vh;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #34495e;
            color: white;
        }
        .navbar {
            background-color: #2c3e50;
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }
        .main-content {
            padding: 30px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .stat-card {
            border-left: 4px solid #3498db;
        }
    </style>
</head>
<body>
    @auth
        <div class="d-flex">
            <div class="sidebar" style="width: 250px;">
                <h5 class="mb-4">POS System</h5>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-link text-white w-100 text-start">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-link text-white w-100 text-start">Kelola Produk</a>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-link text-white w-100 text-start">Kelola Transaksi</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-link text-white w-100 text-start">Dashboard</a>
                    <a href="{{ route('user.products.index') }}" class="btn btn-sm btn-link text-white w-100 text-start">Cari Produk</a>
                    <a href="{{ route('user.transactions.index') }}" class="btn btn-sm btn-link text-white w-100 text-start">Transaksi Saya</a>
                    <a href="{{ route('user.transactions.create') }}" class="btn btn-sm btn-link text-white w-100 text-start">Buat Transaksi</a>
                @endif
                <hr class="bg-light">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger w-100">Logout</button>
                </form>
            </div>
            <div style="flex: 1;">
                <div class="main-content">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    @else
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="/">POS System</a>
            </div>
        </nav>
        <div class="main-content">
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    @endauth
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
