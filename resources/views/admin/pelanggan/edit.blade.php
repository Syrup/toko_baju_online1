@extends('layouts.app')

@section('content')
    <div style="max-width: 800px; margin: 0 auto;">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Edit Pelanggan</h1>
                <p class="text-muted" style="margin: 0;">Perbarui informasi pelanggan</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.pelanggan.update', $pelanggan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nama Pelanggan -->
                            <div class="mb-4">
                                <label for="nama_konsumen"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-user me-2" style="color: #667eea;"></i>Nama Pelanggan
                                    <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="text"
                                    class="form-control form-control-lg @error('nama_konsumen') is-invalid @enderror"
                                    id="nama_konsumen" name="nama_konsumen" placeholder="Masukkan nama pelanggan"
                                    value="{{ old('nama_konsumen', $pelanggan->nama_konsumen) }}" required
                                    style="border-color: #ddd; border-radius: 8px;">
                                @error('nama_konsumen')
                                    <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-envelope me-2" style="color: #667eea;"></i>Email
                                    <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Masukkan email pelanggan"
                                    value="{{ old('email', $pelanggan->email) }}" required
                                    style="border-color: #ddd; border-radius: 8px;">
                                @error('email')
                                    <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="mb-4">
                                <label for="nomor_telepon"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-phone me-2" style="color: #667eea;"></i>Nomor Telepon
                                    <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="text"
                                    class="form-control form-control-lg @error('nomor_telepon') is-invalid @enderror"
                                    id="nomor_telepon" name="nomor_telepon" placeholder="Masukkan nomor telepon"
                                    value="{{ old('nomor_telepon', $pelanggan->nomor_telepon) }}" required
                                    style="border-color: #ddd; border-radius: 8px;">
                                @error('nomor_telepon')
                                    <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div class="mb-4">
                                <label for="alamat"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-map-marker-alt me-2" style="color: #667eea;"></i>Alamat
                                </label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" rows="4" placeholder="Masukkan alamat pelanggan (opsional)"
                                    style="border-color: #ddd; border-radius: 8px;">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 pt-3">
                                <button type="submit" class="btn btn-primary btn-lg flex-grow-1"
                                    style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; font-weight: 600; transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.5)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3)';">
                                    <i class="fas fa-save me-2"></i>Perbarui Pelanggan
                                </button>
                                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary btn-lg"
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
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-control-lg {
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }

        .btn-primary {
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .card {
            border-radius: 12px;
        }
    </style>
@endsection