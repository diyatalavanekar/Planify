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
  <?php include("includes/header.php"); ?>

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
              <h3>📅 Founded</h3>
              <p>
                Planify was founded in 2025 as a Final Year Project with the
                vision of simplifying event planning and booking through a
                centralized digital platform.
              </p>
            </div>

            <div class="info-box">
              <h3>👩‍💼 Founder & Owner</h3>
              <p>
                Planify is owned and managed by <strong>Rasika Prakshale</strong>.
                The platform was developed by Shital and Diya under her guidance.
              </p>
            </div>

            <div class="info-box">
              <h3>🎯 Our Mission</h3>
              <p>
                Our mission is to provide a secure, user-friendly, and efficient
                event management system that reduces manual work and enhances
                booking convenience.
              </p>
            </div>

            <div class="info-box">
              <h3>🌍 Our Vision</h3>
              <p>
                To become a trusted digital solution for event planning and
                management, enabling seamless coordination between users and administrators.
              </p>
            </div>

            <div class="info-box">
              <h3>⚙️ What We Offer</h3>
              <ul>
                <li>User & Admin Authentication</li>
                <li>Secure Event Booking</li>
                <li>Admin Approval System</li>
                <li>Structured Database Management</li>
              </ul>
            </div>

            <div class="info-box">
              <h3>🚀 Why Choose Planify?</h3>
              <p>
                Planify ensures transparency, security, and ease of use.
                With admin-controlled management and dynamic content updates,
                it provides a reliable event handling experience.
              </p>
            </div>

          </div>


        </div>
    </div>
  </section>

  </section>

  <?php include("includes/footer.php"); ?>

  <!-- JAVASCRIPT -->
  <script>
    function toggleMenu() {
      document.getElementById('sideNav').classList.toggle('active');
    }
  </script>

</body>

</html>