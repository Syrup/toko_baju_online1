@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Edit Status Pesanan</h1>
            <p class="text-muted" style="margin: 0;">Ubah status pesanan #{{ $pesanan->id_pemesanan }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-body p-4">
                    <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                <i class="fas fa-info-circle me-2" style="color: #667eea;"></i>Status Pesanan
                                <span style="color: #ef4444;">*</span>
                            </label>
                            <select class="form-select form-select-lg @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required
                                    style="border-color: #ddd; border-radius: 8px;">
                                <option value="">-- Pilih Status --</option>
                                <option value="pending" {{ $pesanan->status === 'pending' ? 'selected' : '' }}>
                                    <i class="fas fa-clock"></i> Pending
                                </option>
                                <option value="diproses" {{ $pesanan->status === 'diproses' ? 'selected' : '' }}>
                                    <i class="fas fa-cog"></i> Diproses
                                </option>
                                <option value="dikirim" {{ $pesanan->status === 'dikirim' ? 'selected' : '' }}>
                                    <i class="fas fa-truck"></i> Dikirim
                                </option>
                                <option value="selesai" {{ $pesanan->status === 'selesai' ? 'selected' : '' }}>
                                    <i class="fas fa-check-circle"></i> Selesai
                                </option>
                                <option value="dibatalkan" {{ $pesanan->status === 'dibatalkan' ? 'selected' : '' }}>
                                    <i class="fas fa-times-circle"></i> Dibatalkan
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Info -->
                        <div class="mb-4 p-3" style="background-color: #f8f9fa; border-radius: 8px;">
                            <p style="color: #666; margin: 0;">
                                <strong>Status saat ini:</strong>
                                @switch($pesanan->status)
                                    @case('pending')
                                        <span class="badge" style="background: #f59e0b; color: white; padding: 0.4rem 0.8rem; border-radius: 20px; margin-left: 0.5rem;">Pending</span>
                                        @break
                                    @case('diproses')
                                        <span class="badge" style="background: #8b5cf6; color: white; padding: 0.4rem 0.8rem; border-radius: 20px; margin-left: 0.5rem;">Diproses</span>
                                        @break
                                    @case('dikirim')
                                        <span class="badge" style="background: #3b82f6; color: white; padding: 0.4rem 0.8rem; border-radius: 20px; margin-left: 0.5rem;">Dikirim</span>
                                        @break
                                    @case('selesai')
                                        <span class="badge" style="background: #10b981; color: white; padding: 0.4rem 0.8rem; border-radius: 20px; margin-left: 0.5rem;">Selesai</span>
                                        @break
                                    @case('dibatalkan')
                                        <span class="badge" style="background: #ef4444; color: white; padding: 0.4rem 0.8rem; border-radius: 20px; margin-left: 0.5rem;">Dibatalkan</span>
                                        @break
                                @endswitch
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 pt-3">
                            <button type="submit" 
                                    class="btn btn-primary btn-lg flex-grow-1" 
                                    style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; font-weight: 600; transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.5)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3)';">
                                <i class="fas fa-save me-2"></i>Perbarui Status
                            </button>
                            <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" 
                               class="btn btn-outline-secondary btn-lg" 
                               style="border-color: #ddd; color: #666; font-weight: 600; transition: all 0.3s ease;"
                               onmouseover="this.style.backgroundColor='#f8f9fa';"
                               onmouseout="this.style.backgroundColor='transparent';">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .form-select-lg {
        padding: 0.75rem 1rem;
        border-radius: 8px;
    }

    .btn-primary {
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .card {
        border-radius: 12px;
    }

    .badge {
        display: inline-block;
        font-weight: 500;
    }
</style>
@endsection
