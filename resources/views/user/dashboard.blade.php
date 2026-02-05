@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <!-- Welcome Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-card shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="welcome-icon me-3">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div>
                            <h1 class="mb-1">Halo, {{ Auth::user()->name ?? 'Pelanggan' }}!</h1>
                            <p class="text-muted mb-0">Selamat datang kembali di Orikawe Store.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats for the User -->
        <div class="row mb-4">
            <!-- My Orders -->
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100 stat-card"
                    style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-text mb-2" style="opacity: 0.9;">Total Pesanan Saya</p>
                                <h2 class="mb-0" style="font-weight: 700;">{{ $total_pemesanan ?? 0 }}</h2>
                            </div>
                            <div style="font-size: 2.5rem; opacity: 0.3;">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                        <a href="{{ route('user.pesanan.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Active Orders -->
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100 stat-card"
                    style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-text mb-2" style="opacity: 0.9;">Pesanan Aktif</p>
                                <h2 class="mb-0" style="font-weight: 700;">{{ $pesanan_aktif ?? 0 }}</h2>
                            </div>
                            <div style="font-size: 2.5rem; opacity: 0.3;">
                                <i class="fas fa-truck"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Spending -->
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100 stat-card"
                    style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-text mb-2" style="opacity: 0.9;">Total Belanja</p>
                                <h2 class="mb-0" style="font-weight: 700; font-size: 1.5rem;">Rp
                                    {{ number_format($total_belanja ?? 0, 0, ',', '.') }}
                                </h2>
                            </div>
                            <div style="font-size: 2.5rem; opacity: 0.3;">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Orders Section -->
            <div class="col-lg-7 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0" style="font-weight: 600; color: #333;">
                            <i class="fas fa-history me-2 text-primary"></i>Riwayat Pesanan Terakhir
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($recent_orders) && count($recent_orders) > 0)
                            <div class="list-group list-group-flush">
                                @foreach($recent_orders->take(5) as $order)
                                    <div class="list-group-item px-3 py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1 fw-bold">#{{ $order->id_pemesanan }}</h6>
                                                <small
                                                    class="text-muted">{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</small>
                                            </div>
                                            <div class="text-end">
                                                <span class="fw-bold d-block">Rp
                                                    {{ number_format($order->total_biaya, 0, ',', '.') }}</span>
                                                @php
                                                    $statusClass = match (strtolower($order->status ?? 'pending')) {
                                                        'pending' => 'warning',
                                                        'completed', 'selesai' => 'success',
                                                        'cancelled', 'dibatalkan' => 'danger',
                                                        'processing', 'diproses' => 'info',
                                                        default => 'secondary'
                                                    };
                                                    $statusLabel = match (strtolower($order->status ?? 'pending')) {
                                                        'pending' => 'Menunggu',
                                                        'completed', 'selesai' => 'Selesai',
                                                        'cancelled', 'dibatalkan' => 'Dibatalkan',
                                                        'processing', 'diproses' => 'Diproses',
                                                        default => ucfirst($order->status ?? 'Tidak Diketahui')
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $statusClass }} mt-1">{{ $statusLabel }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="p-3">
                                <a href="{{ route('user.pesanan.index') }}" class="btn btn-outline-primary w-100">
                                    Lihat Semua Pesanan <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="p-4 text-center text-muted">
                                <i class="fas fa-inbox"
                                    style="font-size: 2.5rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                                <p class="mb-0">Anda belum memiliki pesanan.</p>
                                <a href="{{ route('user.katalog.index') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Latest Products Section -->
            <div class="col-lg-5 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0" style="font-weight: 600; color: #333;">
                            <i class="fas fa-tshirt me-2 text-primary"></i>Produk Terbaru
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        @if(isset($latest_products) && count($latest_products) > 0)
                            <div class="list-group list-group-flush">
                                @foreach($latest_products->take(4) as $product)
                                    <a href="{{ route('user.katalog.show', $product->id_produk) }}"
                                        class="list-group-item list-group-item-action p-3">
                                        <div class="d-flex align-items-center">
                                            <div class="product-thumb me-3">
                                                @if($product->ft_produk)
                                                    <img src="{{ asset('storage/' . $product->ft_produk) }}"
                                                        alt="{{ $product->nama_produk }}" class="rounded">
                                                @else
                                                    <div class="placeholder-img rounded">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 fw-bold text-truncate">{{ $product->nama_produk }}</h6>
                                                <span class="text-primary fw-bold">Rp
                                                    {{ number_format($product->harga_produk, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="p-3">
                                <a href="{{ route('user.katalog.index') }}" class="btn btn-outline-primary w-100">
                                    Lihat Semua Produk <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="p-4 text-center text-muted">
                                <i class="fas fa-store-slash"
                                    style="font-size: 2.5rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
                                <p class="mb-0">Belum ada produk tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .welcome-card {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 1rem;
            padding: 1.5rem;
            border: 1px solid #bae6fd;
        }

        .welcome-icon {
            font-size: 3rem;
            color: #3b82f6;
        }

        .welcome-card h1 {
            color: #1e40af;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .stat-card {
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .product-thumb img,
        .product-thumb .placeholder-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .product-thumb .placeholder-img {
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
        }

        .list-group-item-action:hover {
            background-color: #f8f9fa;
        }

        .badge {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
            font-weight: 500;
        }
    </style>
@endsection