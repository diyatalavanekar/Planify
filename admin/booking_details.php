<?php
// =====================================================
// Admin - Booking Details Page
// =====================================================

session_start();
require_once "../config/db.php";
require_once "auth_check.php"; // ADMIN SECURITY

if (!isset($_GET['id'])) {
    header("Location: manage_bookings.php");
    exit();
}

$booking_id = intval($_GET['id']);

// ==========================================
// FETCH BOOKING MAIN DETAILS
// ==========================================
$stmt = $conn->prepare("
    SELECT 
        b.*,
        u.username,
        u.email,
        e.event_name
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN events e ON b.event_id = e.id
    WHERE b.id = ?
");

$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();
$stmt->close();

if (!$booking) {
    echo "Booking not found.";
    exit();
}

// ==========================================
// FETCH SELECTED FOOD ITEMS
// ==========================================
$food_stmt = $conn->prepare("
    SELECT bf.type, f.item_name, bf.price
    FROM booking_food_items bf
    JOIN food_items f ON bf.food_item_id = f.id
    WHERE bf.booking_id = ?
");

$food_stmt->bind_param("i", $booking_id);
$food_stmt->execute();
$food_result = $food_stmt->get_result();

$veg_items = [];
$nonveg_items = [];

while ($row = $food_result->fetch_assoc()) {
    if ($row['type'] == "Veg") {
        $veg_items[] = $row;
    } else {
        $nonveg_items[] = $row;
    }
}

$food_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>

    <div class="main-content">

        <h2 class="page-title">Booking Details</h2>

        <div class="details-card">

            <h3>Basic Information</h3>
            <p><strong>User:</strong> <?php echo htmlspecialchars($booking['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($booking['email']); ?></p>
            <p><strong>Event:</strong> <?php echo htmlspecialchars($booking['event_name']); ?></p>
            <p><strong>Event Date:</strong> <?php echo date("d M Y", strtotime($booking['event_date'])); ?></p>
            <p><strong>Package:</strong> <?php echo htmlspecialchars($booking['package_name']); ?></p>

            <hr>

            <h3>Plate Details</h3>
            <p><strong>Veg Plates:</strong> <?php echo $booking['veg_qty']; ?></p>
            <p><strong>Non-Veg Plates:</strong> <?php echo $booking['nonveg_qty']; ?></p>

            <hr>

            <h3>Selected Veg Dishes</h3>
            <?php if (!empty($veg_items)) { ?>
                <ul>
                    <?php foreach ($veg_items as $item) { ?>
                        <li>
                            <?php echo htmlspecialchars($item['item_name']); ?>
                            (₹<?php echo $item['price']; ?> per plate)
                        </li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p>No Veg items selected.</p>
            <?php } ?>

            <h3>Selected Non-Veg Dishes</h3>
            <?php if (!empty($nonveg_items)) { ?>
                <ul>
                    <?php foreach ($nonveg_items as $item) { ?>
                        <li>
                            <?php echo htmlspecialchars($item['item_name']); ?>
                            (₹<?php echo $item['price']; ?> per plate)
                        </li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p>No Non-Veg items selected.</p>
            <?php } ?>

            <hr>

            <h3>Payment Details</h3>
            <p><strong>Total Amount:</strong> ₹<?php echo number_format($booking['total_amount']); ?></p>
            <p><strong>Advance (20%):</strong> ₹<?php echo number_format($booking['advance_amount']); ?></p>
            <p><strong>Remaining:</strong> ₹<?php echo number_format($booking['remaining_amount']); ?></p>
            <p><strong>Status:</strong>
                <?php if ($booking['status'] == 'Pending') { ?>
                    <span class="status-pending">Pending</span>
                <?php } elseif ($booking['status'] == 'Confirmed') { ?>
                    <span class="status-confirmed">Confirmed</span>
                <?php } else { ?>
                    <span class="status-cancelled">Cancelled</span>
                <?php } ?>
            </p>

            <br>
            <a href="manage_bookings.php" class="btn">← Back to Manage Bookings</a>

        </div>

    </div>

    <?php include("admin_footer.php"); ?>

</body>

</html>