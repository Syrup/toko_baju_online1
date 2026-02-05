@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.pesanan.index') }}" style="text-decoration: none; color: #667eea;">
                    <i class="fas fa-arrow-left" style="font-size: 1.5rem;"></i>
                </a>
                <div>
                    <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Detail Pesanan</h1>
                    <p class="text-muted" style="margin: 0;">ID Pesanan: <strong>#{{ $pesanan->id_pemesanan }}</strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Status Timeline -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px; padding: 2rem;">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Pending -->
                    <div class="text-center flex-grow-1">
                        <div style="width: 50px; height: 50px; margin: 0 auto 1rem; border-radius: 50%; background: {{ $pesanan->status === 'pending' || in_array($pesanan->status, ['diproses', 'dikirim', 'selesai']) ? 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)' : '#e5e7eb' }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <p style="color: #666; font-size: 0.9rem; margin: 0;">Pending</p>
                    </div>
                    <div style="flex-grow: 1; height: 3px; background: {{ in_array($pesanan->status, ['diproses', 'dikirim', 'selesai']) ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : '#e5e7eb' }}; margin: 0 1rem 1.5rem;"></div>

                    <!-- Diproses -->
                    <div class="text-center flex-grow-1">
                        <div style="width: 50px; height: 50px; margin: 0 auto 1rem; border-radius: 50%; background: {{ in_array($pesanan->status, ['diproses', 'dikirim', 'selesai']) ? 'linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%)' : '#e5e7eb' }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-cog"></i>
                        </div>
                        <p style="color: #666; font-size: 0.9rem; margin: 0;">Diproses</p>
                    </div>
                    <div style="flex-grow: 1; height: 3px; background: {{ in_array($pesanan->status, ['dikirim', 'selesai']) ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : '#e5e7eb' }}; margin: 0 1rem 1.5rem;"></div>

                    <!-- Dikirim -->
                    <div class="text-center flex-grow-1">
                        <div style="width: 50px; height: 50px; margin: 0 auto 1rem; border-radius: 50%; background: {{ in_array($pesanan->status, ['dikirim', 'selesai']) ? 'linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%)' : '#e5e7eb' }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-truck"></i>
                        </div>
                        <p style="color: #666; font-size: 0.9rem; margin: 0;">Dikirim</p>
                    </div>
                    <div style="flex-grow: 1; height: 3px; background: {{ $pesanan->status === 'selesai' ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : '#e5e7eb' }}; margin: 0 1rem 1.5rem;"></div>

                    <!-- Selesai -->
                    <div class="text-center flex-grow-1">
                        <div style="width: 50px; height: 50px; margin: 0 auto 1rem; border-radius: 50%; background: {{ $pesanan->status === 'selesai' ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : '#e5e7eb' }}; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p style="color: #666; font-size: 0.9rem; margin: 0;">Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Information -->
    <div class="row mb-4">
        <div class="col-12 col-md-6 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h6 style="color: #333; font-weight: 600; margin-bottom: 1.5rem; text-transform: uppercase; font-size: 0.85rem;">
                        <i class="fas fa-info-circle me-2" style="color: #667eea;"></i>Informasi Pesanan
                    </h6>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-weight: 600; color: #999; font-size: 0.85rem;">ID Pesanan:</label>
                        <p style="color: #333; margin: 0.5rem 0 0 0; font-weight: 600;">{{ $pesanan->id_pemesanan }}</p>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-weight: 600; color: #999; font-size: 0.85rem;">Tanggal Pesanan:</label>
                        <p style="color: #333; margin: 0.5rem 0 0 0;">
                            {{ $pesanan->tanggal ? \Carbon\Carbon::parse($pesanan->tanggal)->format('d M Y H:i') : '-' }}
                        </p>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-weight: 600; color: #999; font-size: 0.85rem;">Status Pesanan:</label>
                        <p style="color: #333; margin: 0.5rem 0 0 0;">
                            @switch($pesanan->status)
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
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <h6 style="color: #333; font-weight: 600; margin-bottom: 1.5rem; text-transform: uppercase; font-size: 0.85rem;">
                        <i class="fas fa-calculator me-2" style="color: #667eea;"></i>Ringkasan Biaya
                    </h6>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-weight: 600; color: #999; font-size: 0.85rem;">Total Biaya:</label>
                        <p style="color: #333; margin: 0.5rem 0 0 0; font-size: 1.5rem; font-weight: 700; color: #667eea;">
                            Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                        </p>
                    </div>
                    <div style="background-color: #f8f9fa; padding: 1rem; border-radius: 8px;">
                        <p style="color: #666; font-size: 0.85rem; margin: 0;">
                            <i class="fas fa-shield-alt me-1" style="color: #10b981;"></i>
                            Pembayaran aman dengan enkripsi SSL
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    @if($detailPesanan && count($detailPesanan) > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <h6 style="color: #333; font-weight: 600; margin-bottom: 1.5rem; text-transform: uppercase; font-size: 0.85rem;">
                            <i class="fas fa-boxes me-2" style="color: #667eea;"></i>Detail Produk
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-sm" style="margin-bottom: 0;">
                                <thead>
                                    <tr style="border-bottom: 2px solid #eee;">
                                        <th style="color: #666; font-weight: 600; padding: 1rem; border: none;">Produk</th>
                                        <th style="color: #666; font-weight: 600; padding: 1rem; border: none; text-align: center;">Jumlah</th>
                                        <th style="color: #666; font-weight: 600; padding: 1rem; border: none; text-align: right;">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($detailPesanan as $detail)
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <td style="color: #333; padding: 1rem; border: none; font-weight: 500;">
                                                {{ $detail->id_produk ?? 'Produk #' . $detail->id }}
                                            </td>
                                            <td style="color: #666; padding: 1rem; border: none; text-align: center;">
                                                {{ $detail->jumlah ?? '-' }}
                                            </td>
                                            <td style="color: #667eea; padding: 1rem; border: none; text-align: right; font-weight: 600;">
                                                Rp {{ number_format($detail->harga_satuan ?? 0, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ route('admin.pesanan.index') }}" 
                   class="btn btn-outline-secondary btn-lg" 
                   style="border-color: #ddd; color: #666; font-weight: 600; flex-grow-1; transition: all 0.3s ease;"
                   onmouseover="this.style.backgroundColor='#f8f9fa';"
                   onmouseout="this.style.backgroundColor='transparent';">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Pesanan
                </a>
                @if($pesanan->status === 'pending')
                    <button type="button" 
                            class="btn btn-danger btn-lg" 
                            style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none; font-weight: 600; transition: all 0.3s ease;"
                            onclick="batalkanPesanan()"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(239, 68, 68, 0.5)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(239, 68, 68, 0.3)';">
                        <i class="fas fa-trash me-2"></i>Batalkan Pesanan
                    </button>
                @endif
            </div>
        </div>
    </div>
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
                    Apakah Anda yakin ingin membatalkan pesanan <strong>#{{ $pesanan->id_pemesanan }}</strong>?
                </p>
                <p style="color: #999; font-size: 0.9rem; margin-top: 0.5rem;">Pesanan yang dibatalkan tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer border-top" style="padding: 1rem;">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-color: #ddd;">Tidak</button>
                <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}" method="POST" style="display: inline;">
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
    }

    .badge {
        display: inline-block;
        font-weight: 500;
    }

    .modal-content {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    function batalkanPesanan() {
        const modal = new bootstrap.Modal(document.getElementById('modalBatalkan'));
        modal.show();
    }
</script>
@endsection
