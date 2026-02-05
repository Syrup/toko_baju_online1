@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-1" style="color: #333; font-weight: 700;">Dashboard</h1>
            <p class="text-muted">Selamat datang di dashboard toko baju online Anda</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <!-- Products Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text mb-2" style="opacity: 0.9;">Total Produk</p>
                            <h2 class="mb-0" style="font-weight: 700;">{{ $productsCount ?? 0 }}</h2>
                        </div>
                        <div style="font-size: 2.5rem; opacity: 0.3;">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text mb-2" style="opacity: 0.9;">Total Pesanan</p>
                            <h2 class="mb-0" style="font-weight: 700;">{{ $ordersCount ?? 0 }}</h2>
                        </div>
                        <div style="font-size: 2.5rem; opacity: 0.3;">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #3b82f6 0%, #0ea5e9 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text mb-2" style="opacity: 0.9;">Total Pelanggan</p>
                            <h2 class="mb-0" style="font-weight: 700;">{{ $customersCount ?? 0 }}</h2>
                        </div>
                        <div style="font-size: 2.5rem; opacity: 0.3;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text mb-2" style="opacity: 0.9;">Pendapatan</p>
                            <h2 class="mb-0" style="font-weight: 700;">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h2>
                        </div>
                        <div style="font-size: 2.5rem; opacity: 0.3;">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0" style="font-weight: 600; color: #333;">
                        <i class="fas fa-history me-2"></i>Pesanan Terbaru
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if(isset($recent_orders) && count($recent_orders) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="font-weight: 600; color: #666;">ID Pesanan</th>
                                        <th style="font-weight: 600; color: #666;">Pelanggan</th>
                                        <th style="font-weight: 600; color: #666;">Total Biaya</th>
                                        <th style="font-weight: 600; color: #666;">Status</th>
                                        <th style="font-weight: 600; color: #666;">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_orders as $order)
                                        <tr>
                                            <td style="color: #333;">
                                                <span style="font-weight: 500;">#{{ $order->id_pemesanan }}</span>
                                            </td>
                                            <td style="color: #555;">{{ $order->nama_konsumen ?? 'N/A' }}</td>
                                            <td style="color: #333; font-weight: 500;">
                                                Rp {{ number_format($order->total_biaya, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                @php
                                                    $statusClass = match($order->status) {
                                                        'pending' => 'warning',
                                                        'completed' => 'success',
                                                        'cancelled' => 'danger',
                                                        'processing' => 'info',
                                                        default => 'secondary'
                                                    };
                                                    $statusLabel = match($order->status) {
                                                        'pending' => 'Menunggu',
                                                        'completed' => 'Selesai',
                                                        'cancelled' => 'Dibatalkan',
                                                        'processing' => 'Diproses',
                                                        default => $order->status
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $statusClass }}">{{ $statusLabel }}</span>
                                            </td>
                                            <td style="color: #777; font-size: 0.9rem;">
                                                {{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-4 text-center text-muted">
                            <i class="fas fa-inbox" style="font-size: 2.5rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                            <p>Belum ada pesanan terbaru</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .badge {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
        font-weight: 500;
    }
</style>
@endsection