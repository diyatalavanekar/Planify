<?php
session_start();
include("../config/db.php");

/* Allow only POST */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: admin_login.php");
    exit();
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$stmt = $conn->prepare(
    "SELECT admin_id, username FROM admin WHERE username = ? AND password = ?"
);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $admin = $result->fetch_assoc();

    $_SESSION['admin_id'] = $admin['admin_id'];
    $_SESSION['admin_username'] = $admin['username'];

    header("Location: dashboard.php");
    exit();

} else {
    header("Location: admin_login.php?error=invalid");
    exit();
}
?>
