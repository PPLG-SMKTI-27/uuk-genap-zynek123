@extends('layout')

@section('title', 'Buat Transaksi')

@section('content')
<h1 class="mb-4">Buat Transaksi Baru</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.transactions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Produk</label>
                        <select class="form-control" name="product_id" required id="product_id">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" class="form-control" name="quantity" value="1" min="1" required id="quantity">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total</label>
                        <p class="form-control-plaintext" id="total">Rp 0</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Buat Transaksi</button>
                        <a href="{{ route('user.transactions.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const totalDisplay = document.getElementById('total');

    function calculateTotal() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const price = parseFloat(selectedOption.dataset.price) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        const total = price * quantity;
        
        totalDisplay.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
    }

    productSelect.addEventListener('change', calculateTotal);
    quantityInput.addEventListener('input', calculateTotal);
</script>
@endsection
