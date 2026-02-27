<?php
require_once "auth_check.php";
require_once "../config/db.php";

$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM food_items WHERE id=$id");

header("Location: food_items.php");
exit();
