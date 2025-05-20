<?php include 'header.php'; ?>

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
