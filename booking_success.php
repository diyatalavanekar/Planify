<?php
// =============================================
// booking_success.php
// Displays booking confirmation details
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
// VALIDATE BOOKING ID
// ===============================
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: events.php");
    exit();
}

$booking_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// ===============================
// FETCH BOOKING DETAILS
// ===============================
$stmt = $conn->prepare("
    SELECT b.*, e.event_name 
    FROM bookings b
    JOIN events e ON b.event_id = e.id
    WHERE b.id = ? AND b.user_id = ?
");

$stmt->bind_param("ii", $booking_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: events.php");
    exit();
}

$booking = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<?php include "header.php"; ?>

<style>
    /* ==========================================
   Booking Success Page Styling
   Theme Color: rgb(48,47,81)
   Clean professional confirmation layout
========================================== */

    .success-container {
        max-width: 800px;
        margin: 60px auto;
        padding: 40px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .success-title {
        color: rgb(48, 47, 81);
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 25px;
        text-align: center;
    }

    .booking-details p {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .highlight {
        font-weight: 600;
        color: rgb(48, 47, 81);
    }

    .info-box {
        margin-top: 25px;
        padding: 20px;
        background: #f4f4f8;
        border-left: 5px solid rgb(48, 47, 81);
        border-radius: 6px;
    }

    .btn-group {
        margin-top: 30px;
        text-align: center;
    }

    .btn-custom {
        padding: 10px 20px;
        margin: 5px;
        border-radius: 5px;
        text-decoration: none;
        background-color: rgb(48, 47, 81);
        color: #fff;
        transition: 0.3s;
    }

    .btn-custom:hover {
        background-color: #22204a;
    }
</style>

<div class="success-container">

    <div class="success-title">
        Booking Submitted Successfully!
    </div>

    <div class="booking-details">
        <p><span class="highlight">Booking ID:</span> #BK<?php echo $booking['id']; ?></p>
        <p><span class="highlight">Event:</span> <?php echo htmlspecialchars($booking['event_name']); ?></p>
        <p><span class="highlight">Event Date:</span> <?php echo date("d F Y", strtotime($booking['event_date'])); ?></p>
        <p><span class="highlight">Package:</span> <?php echo htmlspecialchars($booking['package_type']); ?></p>
        <p><span class="highlight">Veg Plates:</span> <?php echo $booking['veg_count']; ?></p>
        <p><span class="highlight">Non-Veg Plates:</span> <?php echo $booking['nonveg_count']; ?></p>
        <p><span class="highlight">Total Amount:</span> ₹<?php echo number_format($booking['total_amount']); ?></p>
        <p><span class="highlight">Payment Status:</span> <?php echo $booking['payment_status']; ?></p>
    </div>

    <div class="info-box">
        <p><strong>Payment Mode:</strong> Offline Advance Payment</p>
        <p>Please visit the Planify office within 24 hours to pay the advance amount.</p>
        <p>Your booking will be confirmed only after payment verification by the admin.</p>
    </div>

    <div class="btn-group">
        <a href="my_bookings.php" class="btn-custom">Go to My Bookings</a>
        <a href="home.php" class="btn-custom">Back to Home</a>
    </div>

</div>

<?php include "footer.php"; ?>