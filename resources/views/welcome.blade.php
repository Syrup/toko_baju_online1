<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORIKAWE STORE - Toko Baju Online</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #0b0b0f 0%, #060809 100%);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-brand i {
            margin-right: 0.5rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .btn-nav {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 254, 254, 0.3);
            color: white;
            border-radius: 0.5rem;
            padding: 0.5rem 1.2rem;
            transition: all 0.3s ease;
            margin-left: 0.5rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-nav:hover {
            background: white;
            color: #667eea;
            border-color: white;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 100px 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,144C960,149,1056,139,1152,128C1248,117,1344,107,1392,101.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-repeat: repeat-x;
            background-size: cover;
            opacity: 0.1;
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
        }

        .hero-image {
            position: relative;
            z-index: 1;
        }

        .hero-image i {
            font-size: 150px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: float 3s ease-in-out infinite;
            display: inline-block;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* CTA Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border: none;
            color: white;
            padding: 0.8rem 2.5rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            display: inline-block;
            text-decoration: none;
            margin-right: 1rem;
            margin-bottom: 1rem;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
            color: white;
            text-decoration: none;
        }

        .btn-secondary-custom {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            padding: 0.8rem 2.5rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            margin-bottom: 1rem;
        }

        .btn-secondary-custom:hover {
            background: white;
            color: #2563eb;
            border-color: white;
            text-decoration: none;
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background: white;
        }

        .feature-card {
            text-align: center;
            padding: 2rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            border-color: #2563eb;
        }

        .feature-icon {
            font-size: 3rem;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .feature-card h5 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        .feature-card p {
            color: #666;
            font-size: 0.95rem;
        }

        /* Products Preview */
        .products-preview {
            padding: 80px 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #333;
            margin-bottom: 1rem;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #666;
        }

        .product-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }

        .product-body {
            padding: 1.5rem;
        }

        .product-body h6 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .product-body p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 1rem;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
        }

        .cta-text {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 3rem 0 1rem;
        }

        footer h6 {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        footer a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: #2563eb;
        }

        footer p {
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-title h2 {
                font-size: 1.8rem;
            }

            .btn-primary-custom,
            .btn-secondary-custom {
                display: block;
                text-align: center;
                width: 100%;
                margin-right: 0;
            }
        }

        .scroll-animation {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-lg">
            <a class="navbar-brand" href="/">
                <i class="fas fa-shopping-bag"></i>ORIKAWE STORE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#produk">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-nav">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-nav">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Koleksi Baju Terbaik</h1>
                    <p class="hero-subtitle">Temukan gaya fashion terbaru dengan harga terjangkau. Kualitas premium,
                        desain eksklusif, dan kenyamanan maksimal.</p>
                    <div>
                        <a href="{{ route('login') }}" class="btn-primary-custom">
                            <i class="fas fa-shopping-cart me-2"></i>Belanja Sekarang
                        </a>
                        <a href="#fitur" class="btn-secondary-custom">
                            <i class="fas fa-arrow-down me-2"></i>Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 hero-image text-center">
                    <i class="fas fa-shopping-bags"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="fitur">
        <div class="container-lg">
            <div class="section-title">
                <h2>Mengapa Memilih Kami?</h2>
                <p>Kami menyediakan pengalaman berbelanja yang terbaik untuk Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h5>Pengiriman Cepat</h5>
                        <p>Pengiriman ke seluruh Indonesia dengan jaminan barang sampai dengan aman dan cepat.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h5>Pembayaran Aman</h5>
                        <p>Sistem pembayaran terenkripsi dengan berbagai metode pilihan untuk keamanan Anda.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <h5>Garansi Kualitas</h5>
                        <p>Jaminan kualitas produk 100%. Jika tidak puas, uang kembali tanpa pertanyaan.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5>Dukungan 24/7</h5>
                        <p>Tim customer service kami siap membantu Anda kapan saja, setiap hari.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Preview -->
    <section class="products-preview" id="produk">
        <div class="container-lg">
            <div class="section-title">
                <h2>Koleksi Produk</h2>
                <p>Jelajahi berbagai pilihan baju berkualitas dari kami</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <i class="fas fa-shirt"></i>
                        </div>
                        <div class="product-body">
                            <h6>Kaos Premium</h6>
                            <p>Kaos katun 100% dengan kenyamanan maksimal untuk sehari-hari.</p>
                            <div class="product-price">Rp 79.000</div>
                            <a href="{{ route('login') }}" class="btn-primary-custom"
                                style="width: 100%; text-align: center;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <div class="product-body">
                            <h6>Kemeja Casual</h6>
                            <p>Kemeja kasual dengan desain modern cocok untuk berbagai acara.</p>
                            <div class="product-price">Rp 149.000</div>
                            <a href="{{ route('login') }}" class="btn-primary-custom"
                                style="width: 100%; text-align: center;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <i class="fas fa-vest"></i>
                        </div>
                        <div class="product-body">
                            <h6>Jaket Stylish</h6>
                            <p>Jaket trendy dengan material berkualitas tinggi untuk tampilan sempurna.</p>
                            <div class="product-price">Rp 249.000</div>
                            <a href="{{ route('login') }}" class="btn-primary-custom"
                                style="width: 100%; text-align: center;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <i class="fas fa-pants"></i>
                        </div>
                        <div class="product-body">
                            <h6>Celana Jeans</h6>
                            <p>Celana jeans premium dengan potongan yang pas dan nyaman dipakai.</p>
                            <div class="product-price">Rp 189.000</div>
                            <a href="{{ route('login') }}" class="btn-primary-custom"
                                style="width: 100%; text-align: center;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="btn-primary-custom" style="font-size: 1.1rem;">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container-lg">
            <h2 class="cta-title">Siap Berbelanja?</h2>
            <p class="cta-text">Jangan lewatkan kesempatan untuk mendapatkan koleksi baju terbaik dengan harga spesial
            </p>
            <a href="{{ route('login') }}" class="btn-primary-custom" style="background: white; color: #2563eb;">
                <i class="fas fa-shopping-cart me-2"></i>Mulai Berbelanja Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container-lg">
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <h6>Tentang Kami</h6>
                    <p>ORIKAWE STORE adalah toko online terpercaya yang menyediakan koleksi baju berkualitas dengan
                        harga terjangkau.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <h6>Navigasi</h6>
                    <ul class="list-unstyled">
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#fitur">Fitur</a></li>
                        <li><a href="#produk">Produk</a></li>
                        <li><a href="{{ route('login') }}">Belanja Sekarang</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <h6>Dukungan</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Bantuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kontak Kami</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <h6>Ikuti Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="#" style="font-size: 1.5rem;"><i class="fab fa-facebook"></i></a>
                        <a href="#" style="font-size: 1.5rem;"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="font-size: 1.5rem;"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-divider">
                <div class="text-center">
                    <p>&copy; 2026 ORIKAWE STORE. Semua hak dilindungi. Dibuat dengan <i class="fas fa-heart"
                            style="color: #2563eb;"></i> untuk Anda.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });

        // Add scroll animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('scroll-animation');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .product-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>