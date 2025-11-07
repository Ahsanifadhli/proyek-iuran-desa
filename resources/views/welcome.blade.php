<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Iuran Warga</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>

        :root {
            --warna-navbar: #2c3e50; /* Warna navbar (bisa diganti) */
            --warna-hero: #3498db; /* Warna hero section */
        }

        body {
            padding-top: 70px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* NAVBAR FIXED */
        .navbar {
            background-color: var(--warna-navbar) !important;
            height: 70px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* HERO SECTION */
        .hero-section {
            background-color: var(--warna-hero);
            color: white;
            padding: 100px 0;
            margin-top: -70px;
            min-height: 100vh;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        /* NAVBAR CUSTOM */
        .navbar {
            background-color: #2c3e50 !important;
            padding: 15px 0;
        }

        /* TOGGLER CUSTOM */
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* MENU MOBILE */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #1a2a3a;
                padding: 1rem;
                margin-top: 1rem;
                border-radius: 5px;
            }

            .nav-item {
                margin-bottom: 0.5rem;
            }

            .btn-login-mobile {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-hand-holding-usd me-2"></i> IURAN DESA BENGLE
            </a>

            <!-- Toggler Mobile -->
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Items -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                    <li class="nav-item d-lg-none mt-2">
                        <a class="btn btn-outline-light" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                </ul>

                <!-- Login Button (Desktop) -->
                <div class="ms-lg-3 d-none d-lg-block">
                    <a class="btn btn-outline-light" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- SPACER UNTUK NAVBAR FIXED -->
    <div style="height: 70px;"></div>

    <!-- KONTEN UTAMA -->
    <!-- HERO SECTION -->
    <section id="home" class="hero-section d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Sistem Iuran Warga</h1>
                    <p class="lead mb-4">Kelola iuran warga dengan mudah dan transparan</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4">
                            <i class="fas fa-sign-in-alt me-2"></i> Mulai Sekarang
                        </a>
                        <a href="#fitur" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-search me-2"></i> Pelajari Fitur
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">

                </div>
            </div>
        </div>
    </section>

     <!-- Features Section -->
    <section id="features" class="features-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title fw-bold">Fitur Unggulan</h2>
                <div class="divider mx-auto my-3"></div>
                <p class="section-subtitle">Solusi lengkap untuk manajemen iuran warga</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Manajemen Data Warga</h3>
                        <p>Kelola data warga secara digital dengan sistem terpusat dan mudah diupdate</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Pencatatan Iuran</h3>
                        <p>Catat pembayaran iuran secara real-time dengan notifikasi otomatis</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="feature-icon mb-4">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Laporan Keuangan</h3>
                        <p>Generate laporan keuangan otomatis dengan visualisasi data yang jelas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">

                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Tentang Sistem Kami</h2>
                    <p class="mb-4">SIM Iuran Warga adalah sistem berbasis web yang dirancang khusus untuk membantu pengelolaan iuran warga di Desa Sukamaju. Sistem ini dikembangkan dengan tujuan:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Meningkatkan transparansi keuangan</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Memudahkan proses administrasi</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Mengurangi kesalahan pencatatan manual</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Memberikan akses informasi yang mudah bagi warga</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title fw-bold">Hubungi Kami</h2>
                <div class="divider mx-auto my-3"></div>
                <p class="section-subtitle">Butuh bantuan atau memiliki pertanyaan?</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-card p-4 p-md-5 shadow">
                        <div class="row">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <h4 class="fw-bold mb-4">Informasi Kontak</h4>
                                <div class="contact-info">
                                    <div class="contact-item mb-3">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <span>Perumahan Citra Kebun Mas, Desa Bengle, Kecamatan Majalaya, Kabupaten Karawang</span>
                                    </div>
                                    <div class="contact-item mb-3">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <span>ahsani.fadhli@gmail.com</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-phone-alt text-primary me-3"></i>
                                        <span>0821-2350-3751</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold mb-4">Kirim Pesan</h4>
                                <form action="{{ route('kirim-kontak') }}" method="post">

                                @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Nama Anda" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email Anda" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" rows="3" placeholder="Pesan Anda" name="body" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-4 bg-dark text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-hand-holding-usd fs-3 me-2 text-primary"></i>
                        <span class="fs-5 fw-bold">Sistem IURAN WARGA</span>
                    </div>
                    <p class="mb-0 mt-2">Sistem Informasi Manajemen Iuran Warga Desa Sukamaju</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/ahsanifadhli_official" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="wa.me/6282123503751" class="text-white"><i class="fab fa-whatsapp"></i></a>
                    </div>
                    <p class="mb-0 mt-2">&copy; 2025 | Sistem Iuran Warga. By: Ahsani Fadhli Ilahi.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Animasi Toggler Icon
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
            this.classList.toggle('active');
        });
    </script>
</body>
</html>
