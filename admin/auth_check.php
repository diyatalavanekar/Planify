<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Prevent caching */
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

/* Check login */
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
