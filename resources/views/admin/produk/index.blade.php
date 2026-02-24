@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <!-- Header -->
    <div class="row mb-4 align-items-center">
        <div class="col-12 col-md-6">
            <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Produk</h1>
            <p class="text-muted" style="margin: 0;">Lihat koleksi lengkap baju kami</p>
        </div>
        <div class="col-12 col-md-6 text-end">
            <a href="{{route('admin.produk.create')}}" class="btn btn-primary btn-lg" 
               style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; font-weight: 600; padding: 0.7rem 2rem; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); transition: all 0.3s ease;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.5)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3)';">
                <i class="fas fa-plus me-2"></i>Tambah Produk
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <form method="GET" action="{{ route('admin.produk.index') }}" class="d-flex gap-2">
                <div class="flex-grow-1">
                    <input type="text" name="search" class="form-control form-control-lg" 
                           placeholder="Cari produk berdasarkan nama atau deskripsi..." 
                           value="{{ $search ?? '' }}"
                           style="border-color: #ddd; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); transition: all 0.3s ease;"
                           onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 2px 12px rgba(102, 126, 234, 0.3)';"
                           onblur="this.style.borderColor='#ddd'; this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.05)';">
                </div>
                <button type="submit" class="btn btn-primary btn-lg" 
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; font-weight: 600; padding: 0.7rem 1.5rem; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); transition: all 0.3s ease; white-space: nowrap;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.5)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(102, 126, 234, 0.3)';">
                    <i class="fas fa-search me-2"></i>Cari
                </button>
                @if($search)
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary btn-lg" 
                       style="border-color: #ddd; color: #666; font-weight: 600; padding: 0.7rem 1.5rem; transition: all 0.3s ease;"
                       onmouseover="this.style.backgroundColor='#f8f9fa';"
                       onmouseout="this.style.backgroundColor='transparent';">
                        <i class="fas fa-times me-2"></i>Reset
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Search Results Info -->
    @if($search)
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-info d-flex align-items-center" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border: 1px solid rgba(102, 126, 234, 0.3); border-radius: 8px;">
                    <i class="fas fa-search me-2" style="color: #667eea; font-size: 1.1rem;"></i>
                    <span style="color: #333;">
                        Hasil pencarian untuk <strong>"{{ $search }}"</strong> 
                        <span style="color: #667eea; font-weight: 600;">({{ count($produk) }} produk ditemukan)</span>
                    </span>
                </div>
            </div>
        </div>
    @endif

    @if($produk && count($produk) > 0)
        <!-- Products Grid -->
        <div class="row g-4">
            @foreach ($produk as $p)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card border-0 shadow-sm h-100" style="transition: all 0.3s ease; cursor: pointer;" 
                         onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0, 0, 0, 0.15)';"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='';">
                        <!-- Product Image -->
                        <div style="height: 250px; overflow: hidden; background-color: #f0f0f0;">
                            @php
                                $imgUrl = null;
                                if($p->foto) {
                                    $storagePath = public_path('storage/' . $p->foto);
                                    $directPath = public_path($p->foto);

                                    if (file_exists($storagePath)) {
                                        $imgUrl = asset('storage/' . $p->foto);
                                    } elseif (file_exists($directPath)) {
                                        $imgUrl = asset($p->foto);
                                    } else {
                                        // If the DB already stores a full URL
                                        if (filter_var($p->foto, FILTER_VALIDATE_URL)) {
                                            $imgUrl = $p->foto;
                                        }
                                    }
                                }
                            @endphp

                            @if($imgUrl)
                                <img src="{{ $imgUrl }}"
                                     class="card-img-top"
                                     alt="{{ $p->nama_produk }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #e9ecef;">
                                    <i class="fas fa-image" style="font-size: 3rem; color: #999;"></i>
                                </div>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column" style="padding: 1.2rem;">
                            <!-- Product Name -->
                            <h6 class="mb-2" style="font-weight: 600; color: #333; height: 2.4em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                {{ $p->nama_produk }}
                            </h6>

                            <!-- Product Description -->
                            <p class="text-muted small mb-3" style="flex-grow: 1; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                {{ $p->deskripsi ?? 'Produk berkualitas dari toko kami' }}
                            </p>

                            <!-- Price -->
                            <div class="mb-3">
                                <p class="mb-0" style="font-size: 0.9rem; color: #667eea; font-weight: 600;">
                                    Rp {{ number_format($p->harga, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Action Buttons (aligned right) -->
                            <div class="d-flex justify-content-end align-items-center" style="gap: .5rem;">
                                <a href="{{ route('admin.produk.show', $p->id) }}" 
                                   class="btn btn-sm btn-outline-primary" 
                                   style="border-color: #667eea; color: #667eea; font-weight: 500; transition: all 0.3s ease;">
                                    <i class="fas fa-eye me-1"></i>Lihat Detail
                                </a>

                                <button class="btn btn-sm btn-primary" 
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; font-weight: 500; transition: all 0.3s ease;"
                                        onclick="tambahPesanan({{ $p->id }}, '{{ addslashes($p->nama_produk) }}', {{ $p->harga }})">
                                    <i class="fas fa-shopping-cart me-1"></i>Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class="fas fa-box-open" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                        <h5 style="color: #666; margin-bottom: 0.5rem;">Tidak Ada Produk</h5>
                        <p class="text-muted">Produk akan segera tersedia. Silakan cek kembali nanti.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<div class="modal fade" id="modalPesanan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <form action="{{ route('user.pesanan.create') }}" method="GET">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
                    <h5 class="modal-title" style="font-weight: 600;">
                        <i class="fas fa-shopping-cart me-2"></i>Pesan Produk
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="id_produk" id="form_id_produk">
                    <div class="mb-3">
                        <label style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">Produk</label>
                        <p id="modalProdukNama" style="color: #666; margin: 0;"></p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">Harga</label>
                                <p id="modalProdukHarga" style="color: #667eea; font-weight: 600; margin: 0;"></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="jumlahBeli" style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">Jumlah</label>
                                <input type="number" id="jumlahBeli" name="jumlah" class="form-control" value="1" min="1" style="border-color: #ddd;">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">Keterangan (Opsional)</label>
                        <textarea id="keterangan" name="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan pesanan Anda..." style="border-color: #ddd;"></textarea>
                    </div>
                    <div style="background-color: #f8f9fa; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                        <p style="font-size: 0.9rem; color: #666; margin: 0;">
                            <strong style="color: #333;">Total:</strong> Rp <span id="totalHarga">0</span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-top" style="padding: 1rem;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-color: #ddd;">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnKonfirmasi" 
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                        <i class="fas fa-check me-2"></i>Lanjutkan Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .card {
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4) !important;
    }

    .btn-outline-primary:hover {
        background-color: #667eea;
        color: white !important;
    }

    .modal-content {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    let produkPesanan = {
        id: null,
        nama: null,
        harga: null
    };

    function tambahPesanan(id, nama, harga) {
        produkPesanan = { id, nama, harga };
        
        document.getElementById('form_id_produk').value = id;
        document.getElementById('modalProdukNama').innerText = nama;
        document.getElementById('modalProdukHarga').innerText = 'Rp ' + harga.toLocaleString('id-ID');
        document.getElementById('jumlahBeli').value = 1;
        document.getElementById('keterangan').value = '';
        
        hitungTotal();
        
        const modal = new bootstrap.Modal(document.getElementById('modalPesanan'));
        modal.show();
    }

    function hitungTotal() {
        const jumlah = parseInt(document.getElementById('jumlahBeli').value) || 0;
        const total = produkPesanan.harga * jumlah;
        document.getElementById('totalHarga').innerText = total.toLocaleString('id-ID');
    }

    document.getElementById('jumlahBeli').addEventListener('change', hitungTotal);
    document.getElementById('jumlahBeli').addEventListener('keyup', hitungTotal);
</script>
@endsection
