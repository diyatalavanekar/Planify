<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Strong cache prevention */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: private, no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
