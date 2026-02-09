<?php
// about.php - Planify : Managing Your Events
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planify | About Us</title>

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
            <a href="events.php">Events</a>
            <a href="about.php" class="active">About</a>
            <a href="contact.php">Contact</a>
            <a href="auth/login.php">Login</a>
        </div>

        <div class="menu-btn" onclick="toggleMenu()">☰</div>
    </div>

    <!-- SIDE NAVIGATION -->
    <div class="side-nav" id="sideNav">
        <a href="home.php">Home</a>
        <a href="events.php">Events</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="login.php">Login</a>
    </div>

    <!-- ABOUT SECTION -->
    <section class="about-section">
        <div class="about-container">

            <!-- UNIQUE ABOUT CENTER -->
<section class="about-center">
  <div class="about-card">

    <h1>About Planify</h1>
    <p class="tagline">Managing Your Events Made Simple</p>

    <div class="about-grid">

      <div class="info-box">
        <h3>📌 Project Overview</h3>
        <p>
          Planify is a web-based event management system that allows users
          to create, manage, and book events securely with admin approval.
        </p>
      </div>

      <div class="info-box">
        <h3>🎯 Our Objective</h3>
        <p>
          To provide a centralized platform that reduces manual work
          and improves efficiency in event planning and participation.
        </p>
      </div>

      <div class="info-box">
        <h3>⚙️ Key Features</h3>
        <ul>
          <li>User & Admin Login</li>
          <li>Event Creation & Approval</li>
          <li>Online Booking System</li>
          <li>Secure & Structured Design</li>
        </ul>
      </div>

      <div class="info-box">
        <h3>👩‍💻 Developed By</h3>
        <p><strong>Shital</strong> & <strong>Diya</strong></p>
        <span>Final Year Project</span>
      </div>

    </div>
  </div>
</section>

    </section>

    <?php include("includes/footer.php"); ?>

    <!-- JAVASCRIPT -->
    <script>
        function toggleMenu(){
            document.getElementById('sideNav').classList.toggle('active');
        }
    </script>

</body>
</html>
