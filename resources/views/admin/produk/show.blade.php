@extends('layouts.app')

@section('content')
    <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.produk.index') }}"
                        style="color: #667eea; text-decoration: none;">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $tproduk->nama_produk }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Gambar Produk -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                    <div
                        style="height: 500px; background: linear-gradient(135deg, #f0f0f0 0%, #e9ecef 100%); overflow: hidden; display: flex; align-items: center; justify-content: center;">
                        @if($tproduk->foto)
                            <img src="{{ asset('storage/' . $tproduk->foto) }}" alt="{{ $tproduk->nama_produk }}"
                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        @else
                            <div class="text-center" style="color: #999;">
                                <i class="fas fa-image" style="font-size: 5rem; margin-bottom: 1rem; display: block;"></i>
                                <p style="font-size: 1.1rem;">Foto Produk Tidak Tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                    <div class="card-body p-4 d-flex flex-column">
                        <!-- Judul Produk -->
                        <div class="mb-3">
                            <h1 style="font-weight: 700; color: #333; font-size: 1.8rem; line-height: 1.4;">
                                {{ $tproduk->nama_produk }}
                            </h1>
                        </div>

                        <!-- Rating dan Review -->
                        <div class="mb-3">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="color: #ffc107;">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span style="color: #666; font-size: 0.9rem;">(4.5 dari 5 - 12 ulasan)</span>
                            </div>
                        </div>

                        <hr style="margin: 1rem 0;">

                        <!-- Deskripsi Singkat -->
                        <div class="mb-4">
                            <p class="text-muted" style="line-height: 1.6; font-size: 1rem;">
                                {{ $tproduk->deskripsi ?? 'Produk berkualitas tinggi dari toko kami dengan standar internasional.' }}
                            </p>
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <div
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1.5rem; border-radius: 10px; color: white;">
                                <p style="font-size: 0.9rem; margin: 0; opacity: 0.9;">Harga</p>
                                <h2 style="font-weight: 700; margin: 0.5rem 0 0 0; font-size: 2rem;">
                                    Rp {{ number_format($tproduk->harga, 0, ',', '.') }}
                                </h2>
                                <p style="font-size: 0.8rem; margin: 0.5rem 0 0 0; opacity: 0.85;">Harga sudah termasuk
                                    pajak</p>
                            </div>
                        </div>

                        <!-- Form Pemesanan -->
                        <form action="{{ route('user.pesanan.create') }}" method="GET" class="mb-4">
                            <input type="hidden" name="id_produk" value="{{ $tproduk->id }}">
                            <!-- Jumlah Pembelian -->
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: 600; color: #333; margin-bottom: 0.5rem;">
                                    <i class="fas fa-shopping-bag me-2" style="color: #667eea;"></i>Jumlah Pembelian
                                </label>
                                <div style="display: flex; gap: 0.5rem; align-items: center;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="decreaseQty()"
                                        style="width: 45px; padding: 0;">−</button>
                                    <input type="number" id="jumlahBeli" name="jumlah" class="form-control" value="1"
                                        min="1" max="100" onchange="hitungTotal()" onkeyup="hitungTotal()"
                                        style="text-align: center; width: 70px; border: 1px solid #ddd;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="increaseQty()"
                                        style="width: 45px; padding: 0;">+</button>
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: 600; color: #333; margin-bottom: 0.5rem;">
                                    <i class="fas fa-note-sticky me-2" style="color: #667eea;"></i>Keterangan (Opsional)
                                </label>
                                <textarea id="keterangan" name="keterangan" class="form-control" rows="3"
                                    placeholder="Contoh: Ukuran M, warna hitam, atau catatan khusus lainnya..."
                                    style="border: 1px solid #ddd; border-radius: 8px;"></textarea>
                            </div>

                            <!-- Total Harga Summary -->
                            <div class="mb-4 p-3 rounded"
                                style="background: linear-gradient(135deg, #f8f9fa 0%, #f0f0f0 100%); border-left: 4px solid #667eea;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <span style="color: #666;">Subtotal:</span>
                                    <span style="font-weight: 600; color: #333;">Rp <span
                                            id="subtotal">{{ number_format($tproduk->harga, 0, ',', '.') }}</span></span>
                                </div>
                                <hr style="margin: 0.5rem 0;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-weight: 700; color: #333; font-size: 1.1rem;">Total:</span>
                                    <span style="font-weight: 700; color: #667eea; font-size: 1.3rem;">Rp <span
                                            id="totalHarga">{{ number_format($tproduk->harga, 0, ',', '.') }}</span></span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; font-weight: 600; padding: 0.8rem; transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 25px rgba(102, 126, 234, 0.4)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow=''">
                                    <i class="fas fa-shopping-cart me-2"></i>Pesan Sekarang
                                </button>

                                <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary btn-lg"
                                    style="font-weight: 600; padding: 0.8rem; transition: all 0.3s ease;"
                                    onmouseover="this.style.backgroundColor='#f0f0f0'"
                                    onmouseout="this.style.backgroundColor='transparent'">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Produk
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Produk Tambahan -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-header bg-white border-bottom" style="padding: 1.5rem;">
                        <h5 style="margin: 0; font-weight: 600; color: #333;">
                            <i class="fas fa-info-circle me-2" style="color: #667eea;"></i>Informasi Produk Lengkap
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p style="color: #666; margin: 0;">
                                    <strong style="color: #333;">ID Produk:</strong> #{{ $tproduk->id }}
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p style="color: #666; margin: 0;">
                                    <strong style="color: #333;">Status:</strong>
                                    <span class="badge bg-success" style="padding: 0.4rem 0.8rem;">Tersedia</span>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p style="color: #666; margin: 0;">
                                    <strong style="color: #333;">Kategori:</strong> Pakaian
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p style="color: #666; margin: 0;">
                                    <strong style="color: #333;">Ditambahkan:</strong>
                                    {{ $tproduk->created_at ? $tproduk->created_at->format('d M Y') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            transition: all 0.3s ease;
        }

        .btn {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .breadcrumb-item.active {
            color: #333;
            font-weight: 600;
        }
    </style>

    <script>
        const harga = {{ $tproduk->harga }};

        function hitungTotal() {
            const jumlah = parseInt(document.getElementById('jumlahBeli').value) || 1;
            const total = harga * jumlah;

            document.getElementById('subtotal').innerText = total.toLocaleString('id-ID');
            document.getElementById('totalHarga').innerText = total.toLocaleString('id-ID');
        }

        function increaseQty() {
            const input = document.getElementById('jumlahBeli');
            input.value = parseInt(input.value) + 1;
            hitungTotal();
        }

        function decreaseQty() {
            const input = document.getElementById('jumlahBeli');
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
                hitungTotal();
            }
        }

        document.getElementById('jumlahBeli').addEventListener('change', hitungTotal);
        document.getElementById('jumlahBeli').addEventListener('keyup', hitungTotal);
    </script>
@endsection