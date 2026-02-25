<?php
session_start();
require_once "../config/db.php";
require_once "auth_check.php";

if (!isset($_GET['id'])) {
    header("Location: view_events.php");
    exit();
}

$id = $_GET['id'];

// Optional: delete image file
$result = mysqli_query($conn, "SELECT image FROM events WHERE id=$id");
$event = mysqli_fetch_assoc($result);

if (!empty($event['image'])) {
    $image_path = "../images/" . $event['image'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }
}

// Delete event
$stmt = $conn->prepare("DELETE FROM events WHERE id=?");
$stmt->bind_param("i", $id);

$stmt->execute();
$stmt->close();

header("Location: view_events.php");
exit();
