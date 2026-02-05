@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="login-card shadow-lg">

            <!-- Header -->
            <div class="text-center mb-4">
                <div class="logo mb-2">🛍️</div>
                <h3 class="fw-bold">ORIKAWE STORE</h3>
                <p class="text-muted small">Buat akun baru</p>
            </div>

            <!-- REGISTER FORM -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button class="btn btn-login w-100">
                    Daftar
                </button>
            </form>

            <div class="text-center mt-3">
                <p class="small text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="fw-bold">Masuk
                        disini</a></p>
            </div>

            <div class="text-center mt-4 small text-muted">
                © {{ date('Y') }} Toko Baju Online
            </div>

        </div>
    </div>

    <style>
        /* ===== FULL HEIGHT FIX ===== */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* Prevent body scroll, handle in login-page */
        }

        #app {
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* ===== PAGE BACKGROUND ===== */
        .login-page {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2000;
            /* Cover Navbar */

            background: linear-gradient(135deg, #e0f2fe, #bae6fd, #7dd3fc);

            /* Center Content with Scroll capability */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
            padding: 1rem;
        }

        /* ===== CARD ===== */
        .login-card {
            width: 100%;
            max-width: 400px;
            /* Sedikit lebih lebar untuk kenyamanan */
            padding: 2rem;
            border-radius: 1rem;

            /* Glassmorphism */
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);

            /* Ensure it doesn't get clipped at top when scrolling on small screens */
            margin: auto;
        }


        /* ===== UI ===== */
        .logo {
            font-size: 3rem;
            display: block;
        }

        .btn-login {
            background: #0f172a;
            color: white;
            font-weight: 600;
            border-radius: .75rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
        }

        .btn-login:hover {
            opacity: .9;
            color: white;
            transform: translateY(-1px);
        }

        .nav-pills .nav-link {
            border-radius: .75rem;
        }

        /* Fix for smaller screens to allow scrolling */
        @media (max-height: 600px) {
            .login-page {
                align-items: flex-start;
            }

            .login-card {
                margin-top: 2rem;
                margin-bottom: 2rem;
            }
        }
    </style>
@endsection