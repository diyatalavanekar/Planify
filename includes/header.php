<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Prevent browser caching */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!-- TOP NAVBAR -->
<div class="navbar">

    <div class="logo">
        <a href="/planify/home.php">
            <img src="/planify/images/logo.jpg" alt="Planify Logo">
        </a>
    </div>

    <div class="nav-links">
        <a href="/planify/home.php">Home</a>
        <a href="/planify/events.php">Events</a>
        <a href="/planify/about.php">About</a>
        <a href="/planify/contact.php">Contact</a>

        <?php if (isset($_SESSION['username'])): ?>

            <a href="/planify/user/dashboard.php" class="user-profile">
                <img src="/planify/images/user.png" alt="User" class="user-icon">
                <?php echo htmlspecialchars($_SESSION['username']); ?>
            </a>

            <a href="/planify/auth/logout.php">Logout</a>

        <?php else: ?>
            <a href="/planify/auth/login.php">Login</a>
        <?php endif; ?>
    </div>

</div>