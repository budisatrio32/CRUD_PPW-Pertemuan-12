<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScoreZone - All Matches, All Goals, All in One Place</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_index.css">
</head>
<body>
    <?php
    include_once("config.php");
    requireLogin();
    ?>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: rgba(13,13,13,0.95); backdrop-filter: blur(10px);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#home">
                <img src="Asset\logo.png" alt="ScoreZone Logo" style="width: 80px; height: 65px;" class="me-2">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <a href="daftar_tim.php" class="btn btn-primary-custom ms-3">Lihat Daftar Tim</a>
            </div>
            <div class="navbar-nav ms-3">
                <a href="logout.php" onclick="return confirm('Yakin logout?')">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center hero-content">
                    <h1 class="hero-title">
                        All Matches, All Goals,<br>
                        All in One Place.
                    </h1>
                    <p class="hero-subtitle">
                        Stay updated with real-time football schedules<br>
                        and scores. Your gateway to every game,<br>
                        everywhere.
                    </p>
                    <a href="daftar_tim.php" class="btn btn-primary-custom">
                        Lihat Daftar Tim
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- League Logos Section -->
    <section class="league-logos">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-2 col-md-1 text-center mb-3">
                    <div class="league-logo">
                        <i class="bi bi-award text-white fs-4"></i>
                    </div>
                </div>
                <div class="col-2 col-md-1 text-center mb-3">
                    <div class="league-logo">
                        <i class="bi bi-shield-check text-white fs-4"></i>
                    </div>
                </div>
                <div class="col-2 col-md-1 text-center mb-3">
                    <div class="league-logo">
                        <i class="bi bi-trophy text-white fs-4"></i>
                    </div>
                </div>
                <div class="col-2 col-md-1 text-center mb-3">
                    <div class="league-logo">
                        <i class="bi bi-star-fill text-white fs-4"></i>
                    </div>
                </div>
                <div class="col-2 col-md-1 text-center mb-3">
                    <div class="league-logo">
                        <i class="bi bi-gem text-white fs-4"></i>
                    </div>
                </div>
                <div class="col-2 col-md-1 text-center mb-3">
                    <div class="league-logo">
                        <i class="bi bi-hexagon-fill text-white fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="section-title">
                        Ready to Accompany<br>
                        Every Match!
                    </h2>
                    <p class="about-text">
                        We're here to make sure you never miss a moment on the field. With real-time match schedules and complete information from various leagues, ScoreZone is ready to bring you every goal, every attack, and every victory.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="video-container">
                        <div class="ratio ratio-16x9">
                            <video class="rounded-3 shadow-lg" controls autoplay muted>
                                <source src="Asset\videoAbout.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <div class="video-overlay">
                            <div class="play-button">
                                <i class="bi bi-play-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">What Our Fans Say?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            "ScoreZone makes it so easy to track my favorite team's matches. The real-time updates are spot on!"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <strong>Michael A.</strong><br>
                                <small>Football Enthusiast</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            "Best platform for football schedules! Never missed a match since I started using ScoreZone."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <strong>Sarah K.</strong><br>
                                <small>Sports Fan</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            "The interface is clean and user-friendly. Perfect for keeping up with multiple leagues!"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <strong>David L.</strong><br>
                                <small>League Follower</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">
                            "Accurate scores and detailed team information. Everything I need in one place!"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <strong>Emma R.</strong><br>
                                <small>Match Analyst</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-logo d-flex align-items-center">
                        <img src="Asset\logo.png" alt="ScoreZone Logo" style="width: 80px; height: 65px;" class="me-2">
                    </div>
                    <p class="footer-text">
                        At ScoreZone, we are dedicated to bringing you closer to the sport you love - football. From local matches to international championships, we provide real-time match schedules, live scores, and so much more, all in one place.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Contact Information</h5>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-geo-alt-fill text-danger me-3"></i>
                            <div>
                                <strong>ScoreZone HQ</strong><br>
                                Jl. Sudirman No. 45, Senayan, Yogyakarta,<br>
                                Indonesia
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-telephone-fill text-danger me-3"></i>
                            <span>+62 812 3456-7890</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope-fill text-danger me-3"></i>
                            <span>info@scorezone.com</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-section">
                        <h5>Quick Links</h5>
                        <a href="#" class="footer-link">
                            <i class="bi bi-shield-check me-2"></i>Privacy Policy
                        </a>
                        <a href="#" class="footer-link">
                            <i class="bi bi-file-text me-2"></i>Terms & Conditions
                        </a>
                        <a href="#" class="footer-link">
                            <i class="bi bi-book me-2"></i>Match Schedule Guide
                        </a>
                        <a href="daftar_tim.php" class="footer-link">
                            <i class="bi bi-list-ul me-2"></i>Team Directory
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">
                    © 2024 ScoreZone. All Rights Reserved.<br>
                    "Bringing every match closer to you, one score at a time."
                </p>
            </div>
        </div>
    </footer>
</body>
</html>