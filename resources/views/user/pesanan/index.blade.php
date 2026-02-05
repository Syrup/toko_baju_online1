@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <!-- Header -->
    <div class="row mb-4 align-items-center">
        <div class="col-12 col-md-6">
            <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Pesanan Saya</h1>
            <p class="text-muted" style="margin: 0;">Kelola dan pantau status pesanan Anda</p>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; padding: 1.5rem;">
                <form method="GET" action="{{ route('user.pesanan.index') }}" class="row g-3">
                    <div class="col-12 col-md-4">
                        <input type="text" name="search" class="form-control form-control-lg" 
                               placeholder="Cari ID pesanan atau total biaya..." 
                               value="{{ $search ?? '' }}"
                               style="border-color: #ddd; border-radius: 8px;">
                    </div>
                    <div class="col-12 col-md-4">
                        <select name="status" class="form-select form-select-lg" style="border-color: #ddd; border-radius: 8px;">
                            <option value="semua" {{ $status === 'semua' || !$status ? 'selected' : '' }}>Semua Status</option>
                            <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses" {{ $status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="dikirim" {{ $status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="selesai" {{ $status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ $status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg flex-grow-1" 
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                        @if($search || ($status && $status !== 'semua'))
                            <a href="{{ route('user.pesanan.index') }}" class="btn btn-outline-secondary btn-lg" 
                               style="border-color: #ddd; color: #666;">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Status Summary Cards -->
    <div class="row mb-4 g-3">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white;">
                <div class="card-body p-3 text-center">
                    <i class="fas fa-shopping-cart" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                    <h6 class="mb-1" style="font-weight: 600;">Total Pesanan</h6>
                    <h3 style="margin: 0; font-weight: 700;">{{ count($pesanan) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                <div class="card-body p-3 text-center">
                    <i class="fas fa-clock" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                    <h6 class="mb-1" style="font-weight: 600;">Pending</h6>
                    <h3 style="margin: 0; font-weight: 700;">{{ $pesanan->where('status', 'pending')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white;">
                <div class="card-body p-3 text-center">
                    <i class="fas fa-boxes" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                    <h6 class="mb-1" style="font-weight: 600;">Dikirim</h6>
                    <h3 style="margin: 0; font-weight: 700;">{{ $pesanan->where('status', 'dikirim')->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                <div class="card-body p-3 text-center">
                    <i class="fas fa-check-circle" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                    <h6 class="mb-1" style="font-weight: 600;">Selesai</h6>
                    <h3 style="margin: 0; font-weight: 700;">{{ $pesanan->where('status', 'selesai')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders List -->
    @if($pesanan && count($pesanan) > 0)
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="background-color: white;">
                            <thead>
                                <tr style="background: linear-gradient(135deg, #f8f9fa 0%, #f0f1f3 100%); border-bottom: 2px solid #ddd;">
                                    <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">ID Pesanan</th>
                                    <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">Tanggal</th>
                                    <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">Total Biaya</th>
                                    <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">Status</th>
                                    <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $p)
                                    <tr style="border-bottom: 1px solid #eee; transition: all 0.3s ease;"
                                        onmouseover="this.style.backgroundColor='#f8f9fa';"
                                        onmouseout="this.style.backgroundColor='white';">
                                        <td style="color: #333; font-weight: 500; padding: 1.2rem; border: none;">
                                            <i class="fas fa-hashtag me-2" style="color: #667eea;"></i>
                                            {{ $p->id_pemesanan }}
                                        </td>
                                        <td style="color: #666; padding: 1.2rem; border: none;">
                                            {{ $p->tanggal ? \Carbon\Carbon::parse($p->tanggal)->format('d M Y H:i') : '-' }}
                                        </td>
                                        <td style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">
                                            Rp {{ number_format($p->total_biaya, 0, ',', '.') }}
                                        </td>
                                        <td style="color: #666; padding: 1.2rem; border: none;">
                                            @switch($p->status)
                                                @case('pending')
                                                    <span class="badge" style="background: #f59e0b; color: white; padding: 0.5rem 1rem; border-radius: 20px;">
                                                        <i class="fas fa-clock me-1"></i>Pending
                                                    </span>
                                                    @break
                                                @case('diproses')
                                                    <span class="badge" style="background: #8b5cf6; color: white; padding: 0.5rem 1rem; border-radius: 20px;">
                                                        <i class="fas fa-cog me-1"></i>Diproses
                                                    </span>
                                                    @break
                                                @case('dikirim')
                                                    <span class="badge" style="background: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 20px;">
                                                        <i class="fas fa-truck me-1"></i>Dikirim
                                                    </span>
                                                    @break
                                                @case('selesai')
                                                    <span class="badge" style="background: #10b981; color: white; padding: 0.5rem 1rem; border-radius: 20px;">
                                                        <i class="fas fa-check-circle me-1"></i>Selesai
                                                    </span>
                                                    @break
                                                @case('dibatalkan')
                                                    <span class="badge" style="background: #ef4444; color: white; padding: 0.5rem 1rem; border-radius: 20px;">
                                                        <i class="fas fa-times-circle me-1"></i>Dibatalkan
                                                    </span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td style="color: #666; padding: 1.2rem; border: none; text-align: center;">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('pesanan.show', $p->id) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   style="border-color: #667eea; color: #667eea; font-weight: 500; transition: all 0.3s ease; padding: 0.4rem 0.8rem;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if($p->status === 'pending')
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            style="border-color: #ef4444; color: #ef4444; font-weight: 500; transition: all 0.3s ease; padding: 0.4rem 0.8rem;"
                                                            onclick="batalkanPesanan({{ $p->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-5 text-center">
                        <i class="fas fa-inbox" style="font-size: 3rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                        <h5 style="color: #666; margin-bottom: 0.5rem;">Tidak Ada Pesanan</h5>
                        <p class="text-muted">Anda belum memiliki pesanan. Mulai berbelanja sekarang!</p>
                        <a href="{{route('user.katalog.index')}}" class="btn btn-primary mt-3" 
                           style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none;">
                            <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Modal Konfirmasi Batalkan -->
<div class="modal fade" id="modalBatalkan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none;">
                <h5 class="modal-title" style="font-weight: 600;">
                    <i class="fas fa-trash me-2"></i>Batalkan Pesanan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p style="color: #666; margin: 0;">
                    Apakah Anda yakin ingin membatalkan pesanan <strong id="idPesananBatalkan"></strong>?
                </p>
                <p style="color: #999; font-size: 0.9rem; margin-top: 0.5rem;">Pesanan yang dibatalkan tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer border-top" style="padding: 1rem;">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-color: #ddd;">Tidak</button>
                <form id="formBatalkan" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none;">
                        <i class="fas fa-check me-2"></i>Ya, Batalkan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4) !important;
    }

    .btn-outline-primary:hover {
        background-color: #667eea;
        color: white !important;
    }

    .btn-outline-danger:hover {
        background-color: #ef4444;
        color: white !important;
    }

    .modal-content {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .badge {
        display: inline-block;
        font-weight: 500;
    }
</style>

<script>
    let idPesananBatalkan = null;

    function batalkanPesanan(id) {
        idPesananBatalkan = id;
        document.getElementById('idPesananBatalkan').innerText = '#' + id;

        const modal = new bootstrap.Modal(document.getElementById('modalBatalkan'));
        modal.show();
    }

    document.getElementById('formBatalkan').addEventListener('submit', function(e) {
        if (idPesananBatalkan) {
            this.action = `/pesanan/${idPesananBatalkan}`;
        }
    });
</script>
@endsection
