<?php
session_start();
require_once "config/db.php";

// LOGIN CHECK
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

// VALIDATE BOOKING ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: events.php");
    exit();
}

$booking_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// FETCH BOOKING DETAILS
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

<div class="success-container">

    <div class="success-title">
        Booking Submitted Successfully!
        Please Pay the Advance Amount to Confirm Your Booking.
    </div>

    <div class="booking-details">
        <p><span class="highlight">Booking ID:</span> #BK<?php echo $booking['id']; ?></p>

        <p><span class="highlight">Event:</span>
            <?php echo htmlspecialchars($booking['event_name']); ?>
        </p>

        <p><span class="highlight">Event Date:</span>
            <?php echo date("d F Y", strtotime($booking['event_date'])); ?>
        </p>

        <p><span class="highlight">Package:</span>
            <?php echo htmlspecialchars($booking['package_name']); ?>
        </p>

        <p><span class="highlight">Guests:</span>
            <?php echo $booking['guests']; ?>
        </p>

        <p><span class="highlight">Veg Plates:</span>
            <?php echo $booking['veg_qty']; ?>
        </p>

        <p><span class="highlight">Non-Veg Plates:</span>
            <?php echo $booking['nonveg_qty']; ?>
        </p>

        <p><span class="highlight">Total Amount:</span>
            ₹<?php echo number_format($booking['total_amount']); ?>
        </p>

        <p><span class="highlight">Advance Amount:</span>
            ₹<?php echo number_format($booking['advance_amount']); ?>
        </p>

        <p><span class="highlight">Remaining Amount:</span>
            ₹<?php echo number_format($booking['remaining_amount']); ?>
        </p>

        <p><span class="highlight">Status:</span>
            <?php echo $booking['status']; ?>
        </p>
    </div>

    <div class="info-box">
        <p><strong>Payment Mode:</strong> Offline Advance Payment</p>
        <p>Please visit the office within 24 hours to confirm your booking.</p>
    </div>

    <div class="btn-group">
        <a href="user/my_bookings.php" class="btn-custom">Go to My Bookings</a>
        <a href="home.php" class="btn-custom">Back to Home</a>
    </div>

</div>

<?php include "footer.php"; ?>