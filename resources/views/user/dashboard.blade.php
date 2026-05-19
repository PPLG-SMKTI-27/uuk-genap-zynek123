@extends('layout')

@section('title', 'User Dashboard')

@section('content')
<h1 class="mb-4">Dashboard Saya</h1>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Total Transaksi</h6>
                <h2 class="card-title">{{ $totalTransactions }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Total Belanja</h6>
                <h2 class="card-title">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Transaksi Terbaru</h5>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $transaction)
                    <tr>
                        <td>{{ $transaction->product->name }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $transaction->status === 'completed' ? 'success' : ($transaction->status === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
