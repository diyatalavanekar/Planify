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

    <?php include("includes/header.php"); ?>

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
<
    <div class="hero-content">
        <h1>Planify Your Events Effortlessly</h1>
        <p>Create, manage and discover events — all in one place.</p>
        <button onclick="location.href='events.php'">Explore Events</button>
    </div>

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
