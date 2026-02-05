<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        * {
            scrollbar-gutter: stable;
        }

        html, body {
            height: 100%;
            overflow-y: scroll;
        }

        body {
            margin: 0;
            padding: 0;
        }

        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            width: 100%;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 70px;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 999;
            transition: all 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 1.5rem;
        }

        .sidebar-brand h5 {
            color: white;
            font-weight: 700;
            margin: 0;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin: 0.5rem 0;
        }

        .sidebar-nav a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-nav a:hover {
            background-color: rgba(255,255,255,0.15);
            border-left-color: white;
            color: white;
        }

        .sidebar-nav a.active {
            background-color: rgba(255,255,255,0.25);
            border-left-color: white;
            color: white;
            font-weight: 600;
        }

        .sidebar-nav i {
            width: 30px;
            margin-right: 0.75rem;
            text-align: center;
        }

        .main-content {
            flex: 1;
            margin-left: 260px;
            margin-top: 70px;
            width: calc(100% - 260px);
            transition: none;
        }

        main {
            padding: 2rem;
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 260px;
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .toggle-sidebar {
                display: block !important;
            }
        }

        .toggle-sidebar {
            display: none;
            background: none;
            border: none;
            color: #333;
            font-size: 1.5rem;
            cursor: pointer;
            margin-left: 1rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <button class="toggle-sidebar d-md-none" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-shopping-bag me-2"></i>{{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        @auth
            <aside class="sidebar" id="sidebar">
                <div class="sidebar-brand">
                    <h5><i class="fas fa-tshirt me-2"></i>Toko Baju</h5>
                </div>
                <ul class="sidebar-nav">
                    @if(Auth::user()->role === 'user')
                        <li>
                            <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">
                                <i class="fas fa-shopping-bag"></i>
                                <span>Produk</span>
                            </a>
                        </li>
                        <li>
                            <a href="#pesanan" onclick="alert('Fitur Pesanan akan segera tersedia')">
                                <i class="fas fa-receipt"></i>
                                <span>Pesanan Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="#profil" onclick="alert('Fitur Profil akan segera tersedia')">
                                <i class="fas fa-user-circle"></i>
                                <span>Profil</span>
                            </a>
                        </li>
                    @elseif(Auth::user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#produk" onclick="alert('Fitur Manajemen Produk akan segera tersedia')">
                                <i class="fas fa-box"></i>
                                <span>Manajemen Produk</span>
                            </a>
                        </li>
                        <li>
                            <a href="#pesanan" onclick="alert('Fitur Manajemen Pesanan akan segera tersedia')">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Manajemen Pesanan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#pelanggan" onclick="alert('Fitur Manajemen Pelanggan akan segera tersedia')">
                                <i class="fas fa-users"></i>
                                <span>Manajemen Pelanggan</span>
                            </a>
                        </li>
                        <li>
                            <a href="#laporan" onclick="alert('Fitur Laporan akan segera tersedia')">
                                <i class="fas fa-chart-bar"></i>
                                <span>Laporan</span>
                            </a>
                        </li>
                    @endif
                    <li style="border-top: 1px solid rgba(255,255,255,0.2); margin-top: 2rem; padding-top: 2rem;">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </aside>
        @endauth

        <div class="main-content @auth w-80 @endauth">
            <main class="@auth @endauth">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // Close sidebar when clicking on a link (mobile)
        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    document.getElementById('sidebar').classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
