@extends('layouts.app')

@section('content')
    <div style="max-width: 800px; margin: 0 auto;">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Edit Profil</h1>
                <p class="text-muted" style="margin: 0;">Perbarui informasi profil Anda</p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if($errors->any())
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-danger d-flex align-items-center"
                        style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 8px;">
                        <i class="fas fa-exclamation-circle me-2" style="color: #ef4444; font-size: 1.1rem;"></i>
                        <div>
                            <strong style="color: #333;">Terjadi kesalahan:</strong>
                            <ul style="color: #666; margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <form action="{{ route('user.profil.update') }}" method="POST">
                            @csrf

                            <!-- Nama Lengkap -->
                            <div class="mb-4">
                                <label for="name"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-user me-2" style="color: #667eea;"></i>Nama Lengkap
                                    <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Masukkan nama lengkap"
                                    value="{{ old('name', $user->name) }}" required
                                    style="border-color: #ddd; border-radius: 8px;">
                                @error('name')
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
                                    name="email" placeholder="Masukkan email" value="{{ old('email', $user->email) }}"
                                    required style="border-color: #ddd; border-radius: 8px;">
                                @error('email')
                                    <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="mb-4">
                                <label for="nomor_telepon"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-phone me-2" style="color: #667eea;"></i>Nomor Telepon
                                </label>
                                <input type="text"
                                    class="form-control form-control-lg @error('nomor_telepon') is-invalid @enderror"
                                    id="nomor_telepon" name="nomor_telepon" placeholder="Masukkan nomor telepon"
                                    value="{{ old('nomor_telepon', $user->detail->nomor_telepon ?? '') }}"
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
                                <textarea class="form-control form-control-lg @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                                    style="border-color: #ddd; border-radius: 8px;">{{ old('alamat', $user->detail->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role Info (Read Only) -->
                            <div class="mb-4">
                                <label for="role"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-tag me-2" style="color: #667eea;"></i>Role
                                </label>
                                <input type="text" class="form-control form-control-lg" id="role" placeholder="Role"
                                    value="{{ ucfirst($user->role) }}" disabled
                                    style="border-color: #ddd; border-radius: 8px; background-color: #f8f9fa; color: #999;">
                                <small style="color: #999; font-size: 0.85rem; margin-top: 0.5rem; display: block;">Role
                                    tidak dapat diubah melalui form ini</small>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 pt-3">
                                <button type="submit" class="btn btn-primary btn-lg flex-grow-1"
                                    style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; font-weight: 600; transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.5)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3)';">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                                </button>
                                <a href="{{ route('user.profil.index') }}" class="btn btn-outline-secondary btn-lg"
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

        .form-control:disabled {
            background-color: #f8f9fa;
            cursor: not-allowed;
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