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
    <link href="{{ asset('css/bootstrap.min.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/templatemo-topic-listing.css')  }}" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(to bottom, #527ae8, #1e40af);
        }

        .featured-section {
            background-color: #ffffff;
        }

    </style>
</head>
<body id="top">

    <nav class="navbar navbar-expand-lg" style="background-color: #fff">
        <div class="container">
            <div class="navbar-brand">
                <span style="color: #1e40af">E-Alumni</span>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-5 me-lg-auto"></ul>
                <div class="d-none d-lg-block">
                    <a href="{{ route('login') }}" class="smoothscroll" style="color: #1e40af">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-20 mx-auto ">
                    <h1 class="text-white text-center">Sistem Informasi Alumni Politeknik Negeri Cilacap</h1>
                    <h6 class="text-center text-white">Platform for creatives around the world</h6>
                </div>
            </div>
        </div>
    </section>

     <section class="featured-section section-padding" style="border-radius: 0;">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col-lg-12 col-12 text-center" style="margin-top: 40px">
                    <h2 class="mb-4 ">Seputar PNC</h2>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4 card">
                    <div class="featured-topic-block shadow-lg">
                        <img src="{{ asset('images/topics/colleagues-working-cozy-office-medium-shot.png') }}" class="featured-topic-image img-fluid" alt="Web Design">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4 card">
                    <div class="featured-topic-block shadow-lg">
                        <img src="{{ asset('images/topics/undraw_happy_music_g6wc.png') }}" class="featured-topic-image img-fluid" alt="Digital Marketing">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4 card">
                    <div class="featured-topic-block shadow-lg">
                        <img src="{{ asset('images/topics/undraw_Compose_music_re_wpiw.png') }}" class="featured-topic-image img-fluid" alt="Coding for Beginners">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT FILES -->
    <script src="{{ asset('js/jquery.min.js')  }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sticky.js') }}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
</body>
</html>
