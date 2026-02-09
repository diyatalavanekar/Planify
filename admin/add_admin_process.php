<?php
require_once "auth_check.php";
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: dashboard.php");
    exit();
}

$username = trim($_POST['new_username']);
$password = trim($_POST['new_password']);

$stmt = $conn->prepare(
    "INSERT INTO admin (username, password) VALUES (?, ?)"
);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

header("Location: dashboard.php?admin_added=1");
exit();
?>
