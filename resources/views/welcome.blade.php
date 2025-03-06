<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Topic Listing Bootstrap 5 Template</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css')  }}" rel="stylesheet">
    <link href="{{ asset('css/templatemo-topic-listing.css')  }}" rel="stylesheet">
</head>
<body id="top">

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <span>E-Alumni</span>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-5 me-lg-auto">
                    
                </ul>

                <div class="d-none d-lg-block">
                    <a href="{{ route('login') }}" class=" smoothscroll">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-20 mx-auto ">
                    <h1 class="text-white text-center">Sistem Informasi Alumni Politeknik Negeri Cilacap</h1>
                    <h6 class="text-center">Platform for creatives around the world</h6>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-section section-padding" style="border-radius: 0;">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col-lg-12 col-12 text-center">
                    <h2 class="mb-4">Featured Topics</h2>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4 card">
                    <div class="featured-topic-block shadow-lg">
                        <img src="{{ asset('images/topics/colleagues-working-cozy-office-medium-shot.png') }}" class="featured-topic-image img-fluid" alt="Web Design">
                        <div class="featured-topic-content">
                            <!-- <h5><a href="#">Web Design Basics</a></h5>
                            <p>Learn the essentials of modern web design, including HTML, CSS, and UX principles.</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4 card">
                    <div class="featured-topic-block shadow-lg">
                        <img src="{{ asset('images/topics/undraw_happy_music_g6wc.png') }}" class="featured-topic-image img-fluid" alt="Digital Marketing">
                        <div class="featured-topic-content">
                            <!-- <h5><a href="#">Digital Marketing</a></h5>
                            <p>Explore SEO, social media marketing, and email campaigns to grow your audience.</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4 card">
                    <div class="featured-topic-block shadow-lg">
                        <img src="{{ asset('images/topics/undraw_Compose_music_re_wpiw.png') }}" class="featured-topic-image img-fluid" alt="Coding for Beginners">
                        <div class="featured-topic-content">
                            <!-- <h5><a href="#">Coding for Beginners</a></h5>
                            <p>Start your coding journey with Python, JavaScript, and other beginner-friendly languages.</p> -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-4 card">
                    <div class="featured-topic-block shadow-lg">
                        <img src="{{ asset('images/topics/undraw_Compose_music_re_wpiw.png') }}" class="featured-topic-image img-fluid" alt="Coding for Beginners">
                        <div class="featured-topic-content">
                            <!-- <h5><a href="#">Coding for Beginners</a></h5>
                            <p>Start your coding journey with Python, JavaScript, and other beginner-friendly languages.</p> -->
                        </div>
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