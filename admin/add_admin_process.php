<?php
require_once "auth_check.php";
require_once "../config/db.php";

/* Allow only POST */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: dashboard.php");
    exit();
}

$username = trim($_POST['new_username']);
$password = trim($_POST['new_password']);

if (!empty($username) && !empty($password)) {

    $stmt = $conn->prepare(
        "INSERT INTO admin (username, password) VALUES (?, ?)"
    );
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: dashboard.php?admin_added=1");
        exit();
    } else {
        header("Location: dashboard.php?error=exists");
        exit();
    }
} else {
    header("Location: dashboard.php?error=empty");
    exit();
}
