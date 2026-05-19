@extends('layout')

@section('title', 'Ubah Status Transaksi')

@section('content')
<h1 class="mb-4">Ubah Status Transaksi</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <p class="form-control-plaintext">{{ $transaction->user->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Produk</label>
                    <p class="form-control-plaintext">{{ $transaction->product->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <p class="form-control-plaintext">{{ $transaction->quantity }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Total</label>
                    <p class="form-control-plaintext">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                </div>

                <form action="{{ route('admin.transactions.update', $transaction) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $transaction->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
