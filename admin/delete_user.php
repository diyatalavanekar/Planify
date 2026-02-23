<?php
require_once "auth_check.php";
require_once "../config/db.php";

/* Validate ID */
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: manage_users.php");
exit();
