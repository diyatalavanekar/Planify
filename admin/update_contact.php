<?php
include '../config/db.php';

$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$query = "UPDATE contact_info 
          SET email='$email', phone='$phone', address='$address'
          WHERE id=1";

mysqli_query($conn, $query);

header("Location: dashboard.php");
exit();
?>
