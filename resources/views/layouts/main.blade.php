<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>E - Alumni</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/templatemo-topic-listing.css') }}" rel="stylesheet">

    <style>
        .hero-section {
            background: linear-gradient(to bottom, #61d07d, #1e40af);
        }

        .featured-section {
            background-color: #ffffff;
        }

        .navbar {
            padding: 10px 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            font-weight: 500;
            font-size: 1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #f8f9fa;
        }

        .btn-login {
            background-color: #1e40af;
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 0.9rem;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn-login:hover {
            background-color: #61d07d;
            color: #fff;
        }
    </style>
</head>

<body id="top">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #b1f7c1; box-shadow: 0 4px 15px rgba(253, 40, 40, 0.1);">
        <div class="container">
            <a href="{{ route('index') }}" class="navbar-brand" style="font-size: 1.5rem; font-weight: 700; color: #4336d2;">
                E-Alumni
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-5 me-lg-auto">
                    <!-- Tambahkan link navbar lain jika perlu -->
                </ul>

                <div class="d-none d-lg-block">
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-20 mx-auto">
                    <h1 class="text-white text-center">Sistem Informasi Alumni Politeknik Negeri Cilacap</h1>
                    <h6 class="text-center text-white">Platform for creatives around the world</h6>
                </div>
            </div>
        </div>

        <div class="berita-mt-5 bg-light py-5">
            {{-- <p class="text-center mt-4">Lorem ipsum dolor sit amet...</p> --}}
        </div>
    </section>




    @yield('content')





    <footer class="mt-5">
        <div class="footer-top bg-dark text-white py-5">
            <div class="container">
                <div class="row">
                    <!-- Bagian 1: Tentang Sekolah -->
                    <div class="col-md-3 col-sm-6 mb-4">
                        <h5 class="fw-bold">Tentang SDN Bulupayung 04</h5>
                        <p>
                            SDN Bulupayung 04 menyediakan pendidikan berkualitas dan membentuk siswa menjadi pribadi cerdas dan berkarakter.
                        </p>
                        <p class="mb-1"><strong>WhatsApp:</strong> 088232649021</p>
                        <p class="mb-0"><strong>Email:</strong> ameisya20@gmail.com</p>
                    </div>
    
                    <!-- Bagian 2: Navigasi -->
                    <div class="col-md-3 col-sm-6 mb-4">
                        <h5 class="fw-bold">Navigasi</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none"><i class="fa fa-chevron-right me-1"></i> Home</a></li>
                            <li><a href="#" class="text-white text-decoration-none"><i class="fa fa-chevron-right me-1"></i> About</a></li>
                            <li><a href="#" class="text-white text-decoration-none"><i class="fa fa-chevron-right me-1"></i> Prestasi</a></li>
                            <li><a href="#" class="text-white text-decoration-none"><i class="fa fa-chevron-right me-1"></i> Galeri</a></li>
                            <li><a href="#" class="text-white text-decoration-none"><i class="fa fa-chevron-right me-1"></i> Berita</a></li>
                            <li><a href="#" class="text-white text-decoration-none"><i class="fa fa-chevron-right me-1"></i> Contact</a></li>
                            <li><a href="#" class="text-white text-decoration-none"><i class="fa fa-chevron-right me-1"></i> PPDB</a></li>
                        </ul>
                    </div>
    
                    <!-- Bagian 3: Artikel Terbaru -->
                    <div class="col-md-3 col-sm-6 mb-4">
                        <h5 class="fw-bold">Artikel Terbaru</h5>
                        <ul class="list-unstyled">
                            @php
                                $latestArticles = App\Models\Article::latest()->take(4)->get();
                            @endphp
                            @foreach($latestArticles as $article)
                                <li class="mb-2">
                                    <a href="{{ url('/p/' . $article->slug) }}" class="text-white text-decoration-none">
                                        <i class="fa fa-chevron-right me-1"></i> {{ $article->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
    
                    <!-- Bagian 4: Sosial Media -->
                    <div class="col-md-3 col-sm-6 mb-4">
                        <h5 class="fw-bold">Ikuti Kami</h5>
                        <p>Temukan kami di media sosial:</p>
                        <div class="d-flex gap-3">
                            {{-- Ubah link dan icon sesuai kebutuhan --}}
                            <a href="https://facebook.com" target="_blank" class="text-white fs-4"><i class="fab fa-facebook"></i></a>
                            <a href="https://instagram.com" target="_blank" class="text-white fs-4"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com" target="_blank" class="text-white fs-4"><i class="fab fa-twitter"></i></a>
                            <a href="https://youtube.com" target="_blank" class="text-white fs-4"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Footer bawah -->
        <div class="footer-bottom bg-secondary text-white text-center py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-md-start">
                        &copy; {{ date('Y') }} <strong>SDN Bulupayung 04</strong>. All Rights Reserved.
                    </div>
                    <div class="col-md-6 text-md-end">
                        Designed by <strong>Meisya Anggraeni</strong>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    
    
    
    
    <!-- To Top Button -->
    <a href="#" class="btn-to-top">
        <i class="fa fa-chevron-up"></i>
    </a>
    
    <!-- JavaScript Files -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
