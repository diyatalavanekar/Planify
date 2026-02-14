<?php
// header.php - common navbar for Planify

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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