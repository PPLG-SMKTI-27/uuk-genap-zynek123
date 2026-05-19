@extends('layout')

@section('title', 'Cari Produk')

@section('content')
<h1 class="mb-4">Cari Produk</h1>

<div class="card">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">SKU: {{ $product->sku }}</p>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                                <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                    Stok: {{ $product->stock }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Tidak ada produk</div>
                </div>
            @endforelse
        </div>

        <nav>
            {{ $products->links('pagination::bootstrap-4') }}
        </nav>
    </div>
</div>
@endsection
