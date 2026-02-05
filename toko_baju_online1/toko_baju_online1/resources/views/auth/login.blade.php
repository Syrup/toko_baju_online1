@extends('layouts.app')

@section('content')
<div class="login-page">
    <div class="login-card shadow-lg">

        <!-- Header -->
        <div class="text-center mb-4">
            <div class="logo mb-2">🛍️</div>
            <h3 class="fw-bold">ORIKAWE STORE</h3>
            <p class="text-muted small">Admin / Staff Panel</p>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-pills nav-fill mb-4" id="authTab">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#login">
                    Login
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#register">
                    Register
                </button>
            </li>
        </ul>

        <div class="tab-content">

            <!-- LOGIN -->
            <div class="tab-pane fade show active" id="login">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input">
                            <label class="form-check-label">Ingat Saya</label>
                        </div>

                        <a href="{{ route('password.request') }}" class="small">
                            Lupa Password?
                        </a>
                    </div>

                    <button class="btn btn-login w-100">
                        Masuk
                    </button>
                </form>
            </div>

            <!-- REGISTER -->
            <div class="tab-pane fade" id="register">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                               class="form-control" required>
                    </div>

                    <button class="btn btn-login w-100">
                        Daftar
                    </button>
                </form>
            </div>

        </div>

        <div class="text-center mt-4 small text-muted">
            © {{ date('Y') }} Toko Baju Online
        </div>

    </div>
</div>

<style>
/* ===== FULL HEIGHT FIX ===== */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

#app {
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

/* ===== PAGE BACKGROUND ===== */
.login-page {
    min-height: 100vh;
    width: 100%;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: 0;
    padding: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    background: linear-gradient(135deg, #e0f2fe, #bae6fd, #7dd3fc);
}

/* ===== CARD ===== */
.login-card {
    width: 100%;
    max-width: 320px; /* ukuran default kecil */
    padding: 1.2rem;  /* lebih ramping */
    border-radius: 1rem;
    margin-top: 3rem;

    background: rgba(255, 255, 255, 0.88);
    backdrop-filter: blur(12px);
}


/* ===== UI ===== */
.logo {
    font-size: 3rem;
}

.btn-login {
    background: #0f172a;
    color: white;
    font-weight: 600;
    border-radius: .75rem;
}

.btn-login:hover {
    opacity: .9;
}

.nav-pills .nav-link {
    border-radius: .75rem;
}
</style>
@endsection
