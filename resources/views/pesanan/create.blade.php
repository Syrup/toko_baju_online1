@extends('layouts.app')

@section('content')
    <div style="max-width: 800px; margin: 0 auto; padding: 2rem 1rem;">
        <!-- Header -->
        <div class="mb-4">
            <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Checkout Pesanan</h1>
            <p class="text-muted" style="margin: 0;">Selesaikan pesanan Anda dengan mengonfirmasi detail di bawah ini</p>
        </div>

        <div class="row g-4">
            <div class="col-md-8">
                <!-- Order Details Form -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header bg-white border-bottom" style="padding: 1.5rem;">
                        <h5 style="margin: 0; font-weight: 600; color: #333;">
                            <i class="fas fa-box me-2" style="color: #667eea;"></i>Detail Produk
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="checkoutForm" action="{{ route('user.pesanan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_konsumen" value="{{ Auth::id() }}">
                            <input type="hidden" name="tanggal" value="{{ date('Y-m-d H:i:s') }}">
                            <input type="hidden" name="status" value="pending">

                            <input type="hidden" name="id_produk" value="{{ $produk->id }}">
                            <input type="hidden" name="harga" value="{{ $produk->harga }}">
                            <input type="hidden" name="jumlah" value="{{ $jumlah }}">
                            <input type="hidden" name="total_biaya" value="{{ $total }}">
                            <input type="hidden" name="keterangan" value="{{ $keterangan }}">

                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-light rounded d-flex align-items-center justify-content-center me-3"
                                    style="width: 80px; height: 80px; overflow: hidden;">
                                    @if($produk->foto)
                                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <i class="fas fa-tshirt" style="font-size: 2rem; color: #ccc;"></i>
                                    @endif
                                </div>
                                <div>
                                    <h5 class="mb-1" style="font-weight: 600; color: #333;">
                                        {{ $produk->nama_produk }}
                                    </h5>
                                    <p class="mb-0 text-muted">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="text-muted mb-1" style="font-size: 0.9rem;">Jumlah</label>
                                    <p style="font-weight: 600; color: #333; margin: 0;">{{ $jumlah }} item</p>
                                </div>
                                <div class="col-6 text-end">
                                    <label class="text-muted mb-1" style="font-size: 0.9rem;">Subtotal</label>
                                    <p style="font-weight: 600; color: #667eea; margin: 0; font-size: 1.1rem;">Rp
                                        {{ number_format($total, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <hr>

                            <div class="mb-0">
                                <label class="text-muted mb-1" style="font-size: 0.9rem;">Keterangan / Catatan
                                    Tambahan</label>
                                @if($keterangan)
                                    <p class="mb-0" style="color: #333;">{{ $keterangan }}</p>
                                @else
                                    <p class="mb-0" style="color: #333; font-style: italic;">Tidak ada catatan</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shipping Address Summary from user profile -->
                <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header bg-white border-bottom" style="padding: 1.5rem;">
                        <h5 style="margin: 0; font-weight: 600; color: #333;">
                            <i class="fas fa-map-marker-alt me-2" style="color: #10b981;"></i>Alamat Pengiriman
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 style="font-weight: 600; color: #333; margin: 0;">{{ Auth::user()->name }}</h6>
                            @if(Auth::user()->detail && Auth::user()->detail->nomor_telepon)
                                <span class="badge bg-light text-dark border">{{ Auth::user()->detail->nomor_telepon }}</span>
                            @endif
                        </div>
                        @if(Auth::user()->detail && Auth::user()->detail->alamat)
                            <p class="text-muted mb-3" style="line-height: 1.5;">{{ Auth::user()->detail->alamat }}</p>
                        @else
                            <div class="alert alert-warning mb-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>Anda belum mengatur alamat pengiriman.
                            </div>
                        @endif
                        <a href="{{ route('user.profil.edit') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit me-1"></i>Ubah Alamat
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Summary Card -->
                <div class="card border-0 shadow-sm" style="border-radius: 12px; position: sticky; top: 20px;">
                    <div class="card-header bg-white border-bottom" style="padding: 1.5rem;">
                        <h5 style="margin: 0; font-weight: 600; color: #333;">Ringkasan Pesanan</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Total Harga Produk</span>
                            <span style="font-weight: 600; color: #333;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Biaya Pengiriman</span>
                            <span style="font-weight: 600; color: #10b981;">Gratis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong style="color: #333; font-size: 1.1rem;">Total Pembayaran</strong>
                            <strong style="color: #667eea; font-size: 1.3rem;">Rp
                                {{ number_format($total, 0, ',', '.') }}</strong>
                        </div>

                        <button type="button" onclick="submitOrder()" class="btn btn-primary w-100 py-3 mb-2"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; font-weight: 600; font-size: 1.1rem; border-radius: 8px;">
                            <i class="fas fa-check-circle me-2"></i>Buat Pesanan Sekarang
                        </button>
                        <a href="{{ route('user.katalog.index') }}" class="btn btn-light w-100 py-2 text-muted"
                            style="border-radius: 8px;">
                            Batal & Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitOrder() {
            @if(!Auth::user()->detail || !Auth::user()->detail->alamat)
                if (!confirm('Anda belum mengatur alamat pengiriman. Pesanan ini mungkin tidak dapat dikirim. Lanjutkan?')) {
                    return;
                }
            @endif

            document.getElementById('checkoutForm').submit();
        }
    </script>
@endsection