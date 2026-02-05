@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-1" style="color: #333; font-weight: 700;">Dashboard Admin</h1>
            <p class="text-muted">Ringkasan data penjualan dan produk toko baju online Anda</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <!-- Total Produk Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text mb-2" style="opacity: 0.9; font-size: 0.95rem;">Total Produk</p>
                            <h2 class="mb-0" style="font-weight: 700; font-size: 2.5rem;">{{ $totalProduk ?? 0 }}</h2>
                        </div>
                        <div style="font-size: 3rem; opacity: 0.2;">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                        <small style="opacity: 0.9;">Produk tersedia dalam toko</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pesanan Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #0ea5e9 0%, #06b6d4 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text mb-2" style="opacity: 0.9; font-size: 0.95rem;">Total Pesanan</p>
                            <h2 class="mb-0" style="font-weight: 700; font-size: 2.5rem;">{{ $totalPesanan ?? 0 }}</h2>
                        </div>
                        <div style="font-size: 3rem; opacity: 0.2;">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                        <small style="opacity: 0.9;">Pesanan dari pelanggan</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pelanggan Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text mb-2" style="opacity: 0.9; font-size: 0.95rem;">Total Pelanggan</p>
                            <h2 class="mb-0" style="font-weight: 700; font-size: 2.5rem;">{{ $totalPelanggan ?? 0 }}</h2>
                        </div>
                        <div style="font-size: 3rem; opacity: 0.2;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                        <small style="opacity: 0.9;">Pelanggan terdaftar</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="card-text mb-2" style="opacity: 0.9; font-size: 0.95rem;">Pendapatan Total</p>
                            <h2 class="mb-0" style="font-weight: 700; font-size: 1.8rem;">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h2>
                        </div>
                        <div style="font-size: 3rem; opacity: 0.2;">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.2);">
                        <small style="opacity: 0.9;">Total dari semua pesanan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pesanan Terbaru Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom" style="padding: 1.5rem;">
                    <h5 class="mb-0" style="font-weight: 600; color: #333;">
                        <i class="fas fa-list me-2" style="color: #3b82f6;"></i>5 Pesanan Terbaru
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($pesananTerbaru && count($pesananTerbaru) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="font-weight: 600; color: #666; padding: 1rem;">ID Pesanan</th>
                                        <th style="font-weight: 600; color: #666; padding: 1rem;">ID Konsumen</th>
                                        <th style="font-weight: 600; color: #666; padding: 1rem;">Total Biaya</th>
                                        <th style="font-weight: 600; color: #666; padding: 1rem;">Status</th>
                                        <th style="font-weight: 600; color: #666; padding: 1rem;">Tanggal Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pesananTerbaru as $pesanan)
                                        <tr style="border-bottom: 1px solid #e5e7eb;">
                                            <td style="color: #333; padding: 1rem;">
                                                <span style="font-weight: 600; color: #3b82f6;">#{{ $pesanan->id_pemesanan }}</span>
                                            </td>
                                            <td style="color: #555; padding: 1rem;">{{ $pesanan->id_konsumen }}</td>
                                            <td style="color: #333; font-weight: 600; padding: 1rem;">
                                                Rp {{ number_format($pesanan->total_biaya ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td style="padding: 1rem;">
                                                @php
                                                    $statusClass = match($pesanan->status) {
                                                        'pending' => 'warning',
                                                        'completed' => 'success',
                                                        'cancelled' => 'danger',
                                                        'processing' => 'info',
                                                        default => 'secondary'
                                                    };
                                                    $statusLabel = match($pesanan->status) {
                                                        'pending' => 'Menunggu',
                                                        'completed' => 'Selesai',
                                                        'cancelled' => 'Dibatalkan',
                                                        'processing' => 'Diproses',
                                                        default => ucfirst($pesanan->status)
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $statusClass }}" style="padding: 0.5rem 0.75rem; font-size: 0.8rem;">{{ $statusLabel }}</span>
                                            </td>
                                            <td style="color: #777; padding: 1rem; font-size: 0.9rem;">
                                                {{ $pesanan->tanggal ? \Carbon\Carbon::parse($pesanan->tanggal)->format('d M Y') : '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-5 text-center text-muted">
                            <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block; opacity: 0.3;"></i>
                            <p style="margin: 0;">Belum ada pesanan terbaru</p>
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
        border-radius: 0.5rem;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12) !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: #f8fafc;
    }
    
    .badge {
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
        font-weight: 500;
        border-radius: 0.25rem;
    }
    
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0;
    }

    /* Status Badge Colors */
    .bg-success {
        background-color: #10b981 !important;
    }
    
    .bg-danger {
        background-color: #ef4444 !important;
    }
    
    .bg-warning {
        background-color: #f59e0b !important;
        color: #fff !important;
    }
    
    .bg-info {
        background-color: #0ea5e9 !important;
    }
    
    .bg-secondary {
        background-color: #6b7280 !important;
    }
</style>
@endsection