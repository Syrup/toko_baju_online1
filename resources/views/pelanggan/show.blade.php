@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('pelanggan.index') }}" style="text-decoration: none; color: #667eea;">
                    <i class="fas fa-arrow-left" style="font-size: 1.5rem;"></i>
                </a>
                <div>
                    <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Detail Pelanggan</h1>
                    <p class="text-muted" style="margin: 0;">Informasi lengkap pelanggan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Profile Header -->
                    <div class="mb-4 pb-4" style="border-bottom: 1px solid #eee;">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user" style="font-size: 2.5rem; color: white;"></i>
                            </div>
                            <div>
                                <h2 style="color: #333; font-weight: 600; margin: 0;">{{ $pelanggan->nama_konsumen }}</h2>
                                <p style="color: #667eea; font-size: 0.9rem; margin: 0.25rem 0 0 0;">
                                    <i class="fas fa-user-circle me-1"></i>Pelanggan
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Information Grid -->
                    <div class="row mb-4">
                        <div class="col-12 col-md-6 mb-4">
                            <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                                <label style="font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-envelope me-2" style="color: #667eea;"></i>Email
                                </label>
                                <p style="color: #333; margin: 0;">
                                    <a href="mailto:{{ $pelanggan->email }}" style="color: #667eea; text-decoration: none;">
                                        {{ $pelanggan->email }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                                <label style="font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-phone me-2" style="color: #667eea;"></i>Nomor Telepon
                                </label>
                                <p style="color: #333; margin: 0;">
                                    <a href="tel:{{ $pelanggan->nomor_telepon }}" style="color: #667eea; text-decoration: none;">
                                        {{ $pelanggan->nomor_telepon }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                            <label style="font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">
                                <i class="fas fa-map-marker-alt me-2" style="color: #667eea;"></i>Alamat
                            </label>
                            <p style="color: #333; margin: 0;">
                                {{ $pelanggan->alamat ?? 'Tidak ada alamat' }}
                            </p>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="row" style="border-top: 1px solid #eee; padding-top: 1.5rem;">
                        <div class="col-12 col-md-6 mb-3">
                            <label style="font-weight: 600; color: #999; font-size: 0.85rem;">Dibuat pada:</label>
                            <p style="color: #666; margin: 0.25rem 0 0 0;">
                                {{ $pelanggan->created_at ? $pelanggan->created_at->format('d M Y H:i') : '-' }}
                            </p>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label style="font-weight: 600; color: #999; font-size: 0.85rem;">Diperbarui pada:</label>
                            <p style="color: #666; margin: 0.25rem 0 0 0;">
                                {{ $pelanggan->updated_at ? $pelanggan->updated_at->format('d M Y H:i') : '-' }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 pt-4" style="border-top: 1px solid #eee;">
                        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" 
                           class="btn btn-warning btn-lg flex-grow-1" 
                           style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; font-weight: 600; color: white; transition: all 0.3s ease;"
                           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(245, 158, 11, 0.5)';"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(245, 158, 11, 0.3)';">
                            <i class="fas fa-edit me-2"></i>Edit Pelanggan
                        </a>
                        <button type="button" 
                                class="btn btn-danger btn-lg" 
                                style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none; font-weight: 600; transition: all 0.3s ease; padding: 0.7rem 2rem;"
                                onclick="hapusPelanggan()"
                                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(239, 68, 68, 0.5)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(239, 68, 68, 0.3)';">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                        <a href="{{ route('pelanggan.index') }}" 
                           class="btn btn-outline-secondary btn-lg" 
                           style="border-color: #ddd; color: #666; font-weight: 600; transition: all 0.3s ease;"
                           onmouseover="this.style.backgroundColor='#f8f9fa';"
                           onmouseout="this.style.backgroundColor='transparent';">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none;">
                <h5 class="modal-title" style="font-weight: 600;">
                    <i class="fas fa-trash me-2"></i>Hapus Pelanggan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p style="color: #666; margin: 0;">
                    Apakah Anda yakin ingin menghapus pelanggan <strong>{{ $pelanggan->nama_konsumen }}</strong>?
                </p>
                <p style="color: #999; font-size: 0.9rem; margin-top: 0.5rem;">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer border-top" style="padding: 1rem;">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-color: #ddd;">Batal</button>
                <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" 
                            style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none;">
                        <i class="fas fa-trash me-2"></i>Hapus Pelanggan
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

    .btn-warning {
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-danger {
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .modal-content {
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    function hapusPelanggan() {
        const modal = new bootstrap.Modal(document.getElementById('modalHapus'));
        modal.show();
    }
</script>
@endsection
