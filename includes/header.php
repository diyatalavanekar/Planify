<?php
// header.php - common navbar for Planify

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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

        <?php if (isset($_SESSION['username'])): ?>
            <!-- If user is logged in -->
            <a href="/planify/user/dashboard.php">
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </a>
            <a href="/planify/auth/logout.php">Logout</a>
        <?php else: ?>
            <!-- If user is NOT logged in -->
            <a href="/planify/auth/login.php">Login</a>
        <?php endif; ?>
    </div>

    <div class="menu-btn" onclick="toggleMenu()">☰</div>
</div>

<!-- SIDE NAVIGATION -->
<div class="side-nav" id="sideNav">
    <a href="/planify/home.php">Home</a>
    <a href="/planify/events.php">Events</a>
    <a href="/planify/about.php">About</a>
    <a href="/planify/contact.php">Contact</a>

    <?php if (isset($_SESSION['username'])): ?>
        <a href="/planify/user/dashboard.php">
            <?php echo htmlspecialchars($_SESSION['username']); ?>
        </a>
        <a href="/planify/auth/logout.php">Logout</a>
    <?php else: ?>
        <a href="/planify/auth/login.php">Login</a>
    <?php endif; ?>
</div>

<script>
function toggleMenu()
{
    document.getElementById('sideNav').classList.toggle('active');
}
</script>
