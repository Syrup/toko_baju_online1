@extends('layouts.app')

@section('content')
    <div style="max-width: 900px; margin: 0 auto;">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Profil Saya</h1>
                <p class="text-muted" style="margin: 0;">Kelola informasi akun Anda</p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if($message = Session::get('success'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-success d-flex align-items-center"
                        style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px;">
                        <i class="fas fa-check-circle me-2" style="color: #10b981; font-size: 1.1rem;"></i>
                        <span style="color: #333;">{{ $message }}</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Profile Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <!-- Profile Header -->
                        <div class="mb-4 pb-4" style="border-bottom: 1px solid #eee;">
                            <div class="d-flex align-items-center gap-4">
                                <div
                                    style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-user" style="font-size: 3rem; color: white;"></i>
                                </div>
                                <div style="flex-grow: 1;">
                                    <h2 style="color: #333; font-weight: 600; margin: 0 0 0.5rem 0;">{{ $user->name }}</h2>
                                    <p style="color: #667eea; font-size: 0.95rem; margin: 0 0 0.5rem 0;">
                                        <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                                    </p>
                                    <p style="color: #999; font-size: 0.85rem; margin: 0;">
                                        <i class="fas fa-tag me-1"></i>Role: <strong
                                            style="color: #333;">{{ ucfirst($user->role) }}</strong>
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('user.profil.edit') }}" class="btn btn-primary"
                                        style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; font-weight: 600; transition: all 0.3s ease;"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.5)';"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3)';">
                                        <i class="fas fa-edit me-2"></i>Edit Profil
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                                    <label
                                        style="font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">
                                        <i class="fas fa-user me-2" style="color: #667eea;"></i>Nama Lengkap
                                    </label>
                                    <p style="color: #333; margin: 0; font-weight: 500;">{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                                    <label
                                        style="font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">
                                        <i class="fas fa-envelope me-2" style="color: #667eea;"></i>Email
                                    </label>
                                    <p style="color: #333; margin: 0; font-weight: 500;">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                                    <label
                                        style="font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">
                                        <i class="fas fa-phone me-2" style="color: #667eea;"></i>Nomor Telepon
                                    </label>
                                    <p style="color: #333; margin: 0; font-weight: 500;">
                                        {{ $user->detail->nomor_telepon ?? 'Belum tersedia' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                                    <label
                                        style="font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">
                                        <i class="fas fa-map-marker-alt me-2" style="color: #667eea;"></i>Alamat
                                    </label>
                                    <p style="color: #333; margin: 0; font-weight: 500;">
                                        {{ $user->detail->alamat ?? 'Belum tersedia' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Account Status -->
                        <div class="mb-4">
                            <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
                                <label
                                    style="font-weight: 600; color: #666; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">
                                    <i class="fas fa-info-circle me-2" style="color: #667eea;"></i>Status Akun
                                </label>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <span class="badge"
                                        style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 0.5rem 1rem; border-radius: 20px; font-weight: 600;">
                                        <i class="fas fa-check-circle me-1"></i>Aktif
                                    </span>
                                    <p style="color: #666; margin: 0; font-size: 0.9rem;">Akun Anda dalam kondisi baik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <h5
                            style="color: #333; font-weight: 600; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #eee;">
                            <i class="fas fa-lock me-2" style="color: #ef4444;"></i>Keamanan
                        </h5>

                        <!-- Password -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between p-3"
                                    style="background-color: #f8f9fa; border-radius: 8px;">
                                    <div>
                                        <p style="color: #333; font-weight: 600; margin: 0;">Password</p>
                                        <p style="color: #999; font-size: 0.9rem; margin: 0.5rem 0 0 0;">Ubah password akun
                                            Anda secara berkala untuk keamanan</p>
                                    </div>
                                    <a href="{{ route('user.profil.change-password') }}" class="btn btn-outline-warning"
                                        style="border-color: #f59e0b; color: #f59e0b; font-weight: 600; transition: all 0.3s ease;"
                                        onmouseover="this.style.backgroundColor='#f59e0b'; this.style.color='white';"
                                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#f59e0b';">
                                        <i class="fas fa-key me-2"></i>Ubah Password
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Two Factor -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between p-3"
                                    style="background-color: #f8f9fa; border-radius: 8px;">
                                    <div>
                                        <p style="color: #333; font-weight: 600; margin: 0;">Verifikasi Dua Faktor</p>
                                        <p style="color: #999; font-size: 0.9rem; margin: 0.5rem 0 0 0;">Tingkatkan keamanan
                                            akun dengan verifikasi dua faktor</p>
                                    </div>
                                    <span class="badge"
                                        style="background: #e5e7eb; color: #666; padding: 0.5rem 1rem; border-radius: 20px; font-weight: 600;">
                                        <i class="fas fa-times-circle me-1"></i>Nonaktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <h5
                            style="color: #333; font-weight: 600; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #eee;">
                            <i class="fas fa-history me-2" style="color: #667eea;"></i>Informasi Akun
                        </h5>

                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label style="font-weight: 600; color: #999; font-size: 0.85rem;">Akun Dibuat:</label>
                                <p style="color: #333; margin: 0.5rem 0 0 0;">
                                    {{ $user->created_at ? $user->created_at->format('d M Y H:i') : '-' }}
                                </p>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label style="font-weight: 600; color: #999; font-size: 0.85rem;">Terakhir
                                    Diperbarui:</label>
                                <p style="color: #333; margin: 0.5rem 0 0 0;">
                                    {{ $user->updated_at ? $user->updated_at->format('d M Y H:i') : '-' }}
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
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .badge {
            display: inline-block;
            font-weight: 600;
        }
    </style>
@endsection