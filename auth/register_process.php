<?php
include("../config/db.php");

if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Check if user already exists
    $check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "User already registered. <a href='login.php'>Login here</a>";
        exit();
    }

    // Insert user
    $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php?registered=success");
        exit();
    } else {
        echo "Registration failed.";
    }

} else {
    echo "All fields are required.";
}
?>
