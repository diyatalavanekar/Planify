<?php
session_start();
include("../config/db.php");

if (isset($_POST['username'], $_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        // Redirect after login
        header("Location: ../home.php");
        exit();

    } else {
        echo "Invalid username or password.";
    }

} else {
    echo "Please fill all fields.";
}

$conn->close();
?>
