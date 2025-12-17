<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "planify_db";

$connect = new mysqli($servername, $username, $password, $dbname);

if ($connect->connect_error) 
{
    die("Error! Connection Failed");
}
else 
{
    echo "Connection Successful";
}
?>
