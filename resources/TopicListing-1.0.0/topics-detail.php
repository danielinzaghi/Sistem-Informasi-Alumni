<?php
// navbar.php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Topic Detail Page</title>
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
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <i class="bi-back"></i>
                    <span>Topic</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php#section_1">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php#section_2">Browse Topics</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php#section_3">How it works</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php#section_4">FAQs</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php#section_5">Contact</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="topics-listing.php">Topics Listing</a></li>
                                <li><a class="dropdown-item" href="contact.php">Contact Form</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </main>
</body>
</html>
