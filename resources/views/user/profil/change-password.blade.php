@extends('layouts.app')

@section('content')
    <div style="max-width: 800px; margin: 0 auto;">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('user.profil.index') }}" style="text-decoration: none; color: #667eea;">
                        <i class="fas fa-arrow-left" style="font-size: 1.5rem;"></i>
                    </a>
                    <div>
                        <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Ubah Password</h1>
                        <p class="text-muted" style="margin: 0;">Perbarui password akun Anda</p>
                    </div>
                </div>
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
                        <form action="{{ route('user.profil.update-password') }}" method="POST">
                            @csrf

                            <!-- Password Saat Ini -->
                            <div class="mb-4">
                                <label for="current_password"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-lock me-2" style="color: #667eea;"></i>Password Saat Ini
                                    <span style="color: #ef4444;">*</span>
                                </label>
                                <div style="position: relative;">
                                    <input type="password"
                                        class="form-control form-control-lg @error('current_password') is-invalid @enderror"
                                        id="current_password" name="current_password"
                                        placeholder="Masukkan password saat ini" required
                                        style="border-color: #ddd; border-radius: 8px;">
                                    <i class="fas fa-eye"
                                        style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #999; cursor: pointer;"
                                        onclick="togglePassword('current_password', this)"></i>
                                </div>
                                @error('current_password')
                                    <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Baru -->
                            <div class="mb-4">
                                <label for="password"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-key me-2" style="color: #667eea;"></i>Password Baru
                                    <span style="color: #ef4444;">*</span>
                                </label>
                                <div style="position: relative;">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="password" name="password"
                                        placeholder="Masukkan password baru (minimal 8 karakter)" required
                                        style="border-color: #ddd; border-radius: 8px;">
                                    <i class="fas fa-eye"
                                        style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #999; cursor: pointer;"
                                        onclick="togglePassword('password', this)"></i>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                                @enderror
                                <small style="color: #999; font-size: 0.85rem; margin-top: 0.5rem; display: block;">Password
                                    minimal 8 karakter</small>
                            </div>

                            <!-- Konfirmasi Password Baru -->
                            <div class="mb-4">
                                <label for="password_confirmation"
                                    style="font-weight: 600; color: #333; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-lock me-2" style="color: #667eea;"></i>Konfirmasi Password Baru
                                    <span style="color: #ef4444;">*</span>
                                </label>
                                <div style="position: relative;">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Masukkan ulang password baru" required
                                        style="border-color: #ddd; border-radius: 8px;">
                                    <i class="fas fa-eye"
                                        style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #999; cursor: pointer;"
                                        onclick="togglePassword('password_confirmation', this)"></i>
                                </div>
                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block" style="color: #ef4444;">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Info Box -->
                            <div class="mb-4 p-3"
                                style="background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #667eea;">
                                <p style="color: #666; margin: 0; font-size: 0.9rem;">
                                    <i class="fas fa-info-circle me-1" style="color: #667eea;"></i>
                                    <strong>Tips Keamanan:</strong> Gunakan password yang kuat dengan kombinasi huruf besar,
                                    huruf kecil, angka, dan simbol.
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 pt-3">
                                <button type="submit" class="btn btn-primary btn-lg flex-grow-1"
                                    style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; font-weight: 600; transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.5)';"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3)';">
                                    <i class="fas fa-save me-2"></i>Ubah Password
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

    <script>
        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                icon.style.color = '#667eea';
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                icon.style.color = '#999';
            }
        }
    </script>
@endsection