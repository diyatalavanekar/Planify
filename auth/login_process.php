<?php
session_start();
include("../config/db.php");

if (isset($_POST['username'], $_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // First check if username exists
    $checkUser = "SELECT * FROM users WHERE username='$username'";
    $resultUser = mysqli_query($conn, $checkUser);

    if (mysqli_num_rows($resultUser) == 0) {

        // User not registered
        header("Location: login.php?error=notregistered");
        exit();
    }

    // Now check password
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        header("Location: ../home.php");
        exit();
    } 
    else {
        header("Location: login.php?error=wrongpassword");
        exit();
    }
}
?>
