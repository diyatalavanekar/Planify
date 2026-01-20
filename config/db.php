<?php
// db.php - Database Connection

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "planify_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
