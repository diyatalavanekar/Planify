<?php
// header.php - common navbar for Planify
?>

<!-- TOP NAVBAR -->
<div class="navbar">
    <div class="logo">
        <img src="/planify/images/logo.jpg" alt="Planify Logo">
    </div>

    <div class="nav-links">
        <a href="/planify/home.php">Home</a>
        <a href="/planify/events.php">Events</a>
        <a href="/planify/about.php">About</a>
        <a href="/planify/contact.php">Contact</a>
        <a href="/planify/auth/login.php">Login</a>
    </div>

    <div class="menu-btn" onclick="toggleMenu()">☰</div>
</div>

<!-- SIDE NAVIGATION -->
<div class="side-nav" id="sideNav">
    <a href="/planify/home.php">Home</a>
    <a href="/planify/events.php">Events</a>
    <a href="/planify/about.php">About</a>
    <a href="/planify/contact.php">Contact</a>
    <a href="/planify/auth/login.php">Login</a>
</div>

<script>
function toggleMenu()
{
    document.getElementById('sideNav').classList.toggle('active');
}
</script>
