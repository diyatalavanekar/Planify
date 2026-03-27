<?php
// =============================================
// booking_process.php
// Handles booking form submission securely
// =============================================

session_start();
require_once "config/db.php";

// ===============================
// LOGIN CHECK
// ===============================
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

// ===============================
// CHECK POST REQUEST
// ===============================
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: booking_success.php?id=" . $booking_id);
    exit();
}

// ===============================
// FETCH & SANITIZE INPUT
// ===============================
$user_id      = $_SESSION['user_id'];
$event_id     = intval($_POST['event_id']);
$package_name = trim($_POST['package_type']); // from form
$veg_qty      = intval($_POST['veg_count']);
$nonveg_qty   = intval($_POST['nonveg_count']);
$event_date   = $_POST['event_date'];

// ===============================
// BASIC VALIDATION
// ===============================
if (empty($event_id) || empty($package_name) || empty($event_date)) {
    die("Invalid booking details.");
}

if ($veg_qty < 0 || $nonveg_qty < 0) {
    die("Plate quantity cannot be negative.");
}

// ===============================
// FUTURE DATE CHECK
// ===============================
if (strtotime($event_date) <= strtotime(date("Y-m-d"))) {
    die("Please select a future date.");
}

// ===============================
// CHECK DATE AVAILABILITY
// ===============================
$stmt = $conn->prepare("
    SELECT id 
    FROM bookings 
    WHERE event_date = ?
    AND status != 'Cancelled'
");

$stmt->bind_param("s", $event_date);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Sorry, this date is already booked.");
}

$stmt->close();

// ===============================
// PACKAGE PRICES (SERVER SIDE)
// ===============================
$package_prices = [
    "Basic"   => 50000,
    "Premium" => 100000,
    "Luxury"  => 150000
];

$veg_price    = 300;
$nonveg_price = 400;

// Validate package
if (!array_key_exists($package_name, $package_prices)) {
    die("Invalid package selected.");
}

$package_price = $package_prices[$package_name];

// ===============================
// CALCULATE TOTAL & ADVANCE
// ===============================
$guests = $veg_qty + $nonveg_qty;

$total_amount = $package_price
    + ($veg_qty * $veg_price)
    + ($nonveg_qty * $nonveg_price);

// 30% advance rule
$advance_amount   = $total_amount * 0.30;
$remaining_amount = $total_amount - $advance_amount;

// ===============================
// INSERT BOOKING
// ===============================
$stmt = $conn->prepare("
    INSERT INTO bookings
    (user_id, event_id, package_name, package_price,
     guests, veg_qty, nonveg_qty,
     event_date, total_amount,
     advance_amount, remaining_amount, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')
");

$stmt->bind_param(
    "iisdiiisddd",
    $user_id,
    $event_id,
    $package_name,
    $package_price,
    $guests,
    $veg_qty,
    $nonveg_qty,
    $event_date,
    $total_amount,
    $advance_amount,
    $remaining_amount
);

if ($stmt->execute()) {

    $booking_id = $stmt->insert_id;

    header("Location: booking_success.php?id=" . $booking_id);
    exit();
} else {
    echo "Something went wrong. Please try again.";
}

$stmt->close();
$conn->close();
