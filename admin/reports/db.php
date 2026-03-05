<?php
$conn = mysqli_connect("localhost","root","","planify");

if(!$conn){
    die("Connection Failed".mysqli_connect_error());
}
?>