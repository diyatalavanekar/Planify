<?php
// home.php - Planify : Managing Your Events
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planify | Home</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    
</head>
<body>

    <!-- TOP NAVBAR -->
    <div class="navbar">
        <div class="logo">
            <img src="images/logo.jpg" alt="Planify Logo">
        </div>

        <div class="nav-links">
            <a href="home.php">Home</a>
            <a href="#events">Events</a>
            <a href="about.php">About</a>
            <a href="#contact">Contact</a>
            <a href="login.php">Login</a>
        </div>

        <div class="menu-btn" onclick="toggleMenu()">☰</div>
    </div>

    <!-- SIDE NAVIGATION -->
    <div class="side-nav" id="sideNav">
        <a href="home.php">Home</a>
        <a href="#events">Events</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
        <a href="login.php">Login</a>
    </div>

    <!-- HERO SECTION -->
    <section class="hero hero-video">
    
    <video autoplay muted loop playsinline class="hero-bg-video">
        <source src="videos/hero.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="hero-content">
        <h1>Planify Your Events Effortlessly</h1>
        <p>Create, manage and discover events — all in one place.</p>
        <button onclick="location.href='events.php'">Explore Events</button>
    </div>

</section>


    <!-- Footer -->
  <footer class="footer">
    <div class="footer-container">
      
      <!-- Branding -->
      <div class="footer-section">
        <img src="images/logo.jpg" alt="Logo" class="footer-logo">
        <p class="footer-brand">By Diya & Shital</p>
      </div>

      <!-- Quick Links -->
      <div class="footer-section">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="payment.php">Payment</a></li>
          <li><a href="ratings.php">Ratings</a></li>
          <li><a href="about.php">About Us</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="footer-section">
        <h4>Contact</h4>
        <p>Email: diyashital@gmail.com</p>
        <p>Phone: +91 7756053060</p>
        <ul>
          <li><a href="#">Admin</a></li>
      </ul>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom">
      <p>© 2025 Your Website. All Rights Reserved.</p>
    </div>
  </footer>

    <!-- JAVASCRIPT -->
    <script>
        function toggleMenu(){
            document.getElementById('sideNav').classList.toggle('active');
        }
    </script>

</body>
</html>
