<?php
session_start();
include '../config/db.php';

/* ===== SESSION CHECK ===== */
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

/* ===== VALIDATE REQUEST ===== */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: dashboard.php");
    exit();
}

/* ===== SANITIZE INPUT ===== */
$email   = mysqli_real_escape_string($conn, $_POST['email']);
$phone   = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);

/* ===== UPDATE QUERY ===== */
$query = "UPDATE contact_info 
          SET email='$email', phone='$phone', address='$address'
          WHERE id=1";

mysqli_query($conn, $query);

/* ===== REDIRECT ===== */
header("Location: dashboard.php");
exit();
?>
