<?php
/* Start session only if not already started */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Prevent caching of admin pages */
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

/* Check if admin is logged in */
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
