<?php
    // Mulai session jika diperlukan
    session_start();
?>
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/templatemo-topic-listing.css" rel="stylesheet">
</head>
<body id="top">
    <main>

        <!-- navbar -->  
        <?php //session_start(); ?>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi-back"></i>
            <span>Topic</span>
        </a>

        <div class="d-lg-none ms-auto me-4">
            <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-5 me-lg-auto">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_2">Browse Topics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_3">How it works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_4">FAQs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="#section_5">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                        <li><a class="dropdown-item" href="topics-listing.php">Topics Listing</a></li>
                        <li><a class="dropdown-item" href="contact.php">Contact Form</a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-none d-lg-block">
                <a href="http://127.0.0.1:8000/login" class="navbar-icon bi-person smoothscroll"></a>
            </div>
        </div>
    </div>
</nav>
        <!--

-->
        <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto">
                        <h1 class="text-white text-center">Discover. Learn. Enjoy</h1>
                        <h6 class="text-center">Platform for creatives around the world</h6>
                        <form method="get" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bi-search"></span>
                                <input name="keyword" type="search" class="form-control" placeholder="Design, Code, Marketing, Finance ..." aria-label="Search">
                                <button type="submit" class="form-control">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

<!-- featured -->
        <?php
// featured.php
?>

<section class="featured-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 text-center">
                <h2 class="mb-4">Featured Topics</h2>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="featured-topic-block bg-white shadow-lg">
                    <img src="images/topics/web_design.jpg" class="featured-topic-image img-fluid" alt="Web Design">
                    <div class="featured-topic-content">
                        <h5><a href="#">Web Design Basics</a></h5>
                        <p>Learn the essentials of modern web design, including HTML, CSS, and UX principles.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="featured-topic-block bg-white shadow-lg">
                    <img src="images/topics/digital_marketing.jpg" class="featured-topic-image img-fluid" alt="Digital Marketing">
                    <div class="featured-topic-content">
                        <h5><a href="#">Digital Marketing</a></h5>
                        <p>Explore SEO, social media marketing, and email campaigns to grow your audience.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="featured-topic-block bg-white shadow-lg">
                    <img src="images/topics/coding.jpg" class="featured-topic-image img-fluid" alt="Coding for Beginners">
                    <div class="featured-topic-content">
                        <h5><a href="#">Coding for Beginners</a></h5>
                        <p>Start your coding journey with Python, JavaScript, and other beginner-friendly languages.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end contact

-->

 <!-- contact -->
<!--header-->
        <?php
// header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A comprehensive topic listing platform">
    <meta name="author" content="Your Name">
    <title>Topic Listing</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/templatemo-topic-listing.css" rel="stylesheet">
</head>
<!-- end header -->

<body class="topics-listing-page" id="top">

    <main>

        <?php include 'navbar.php'; ?>

        <header class="site-header d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Homepage</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Form</li>
                            </ol>
                        </nav>
                        <h2 class="text-white">Contact Form</h2>
                    </div>
                </div>
            </div>
        </header>

        <section class="section-padding section-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <h3 class="mb-4 pb-2">We'd love to hear from you</h3>
                    </div>

                    <div class="col-lg-6 col-12">
                        <?php if(isset($_GET['success']) && $_GET['success'] == 1): ?>
                            <div class="alert alert-success">Your message has been sent successfully!</div>
                        <?php elseif(isset($_GET['error'])): ?>
                            <div class="alert alert-danger">Error: <?php echo htmlspecialchars($_GET['error']); ?></div>
                        <?php endif; ?>

                        <form action="process_contact.php" method="post" class="custom-form contact-form" role="form">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                                        <label for="name">Name</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-floating">
                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>
                                        <label for="email">Email address</label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required>
                                        <label for="subject">Subject</label>
                                    </div>

                                    <div class="form-floating">
                                        <textarea class="form-control" id="message" name="message" placeholder="Tell us about your project" required></textarea>
                                        <label for="message">Tell us about your project</label>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12 ms-auto">
                                    <button type="submit" class="form-control">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-5 col-12 mx-auto mt-5 mt-lg-0">
                        <iframe class="google-map" src="https://www.google.com/maps/embed?..." width="100%" height="250" style="border:0;" allowfullscreen loading="lazy"></iframe>
                        <h5 class="mt-4 mb-2">Topic Listing Center</h5>
                        <p>Bay St & Larkin St, San Francisco, CA 94109, United States</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>
<!-- end footer -->

    </main>

    <?php //include 'footer.php'; ?>

</body>
</html>