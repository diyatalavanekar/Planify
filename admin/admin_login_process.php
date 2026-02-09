<?php
session_start();
include("../config/db.php"); // database connection

/* Allow only POST requests */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: admin_login.php");
    exit();
}

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

/* Check admin credentials */
$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {

    $admin = mysqli_fetch_assoc($result);

    /* ===== SET SESSION ===== */
    $_SESSION['admin_id'] = $admin['admin_id'];
    $_SESSION['admin_username'] = $admin['username'];

    /* ===== REDIRECT ===== */
    header("Location: dashboard.php");
    exit();

} else {
    header("Location: admin_login.php?error=invalid");
    exit();
}
?>
