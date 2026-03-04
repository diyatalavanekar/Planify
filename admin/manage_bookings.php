<?php
// =====================================================
// Admin - Manage Bookings
// Allows admin to confirm / cancel bookings
// =====================================================

session_start();
require_once "../config/db.php";
require_once "auth_check.php"; // ADMIN SECURITY

// ==========================================
// HANDLE STATUS UPDATE (CONFIRM / CANCEL)
// ==========================================
if (isset($_GET['action']) && isset($_GET['id'])) {

    $booking_id = intval($_GET['id']);
    $action     = $_GET['action'];

    if ($action == "confirm") {

        $stmt = $conn->prepare("
            UPDATE bookings 
            SET status = 'Confirmed'
            WHERE id = ?
        ");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $stmt->close();
    }

    if ($action == "cancel") {

        $stmt = $conn->prepare("
            UPDATE bookings 
            SET status = 'Cancelled'
            WHERE id = ?
        ");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: manage_bookings.php");
    exit();
}

// ==========================================
// FETCH ALL BOOKINGS
// ==========================================
$query = "
SELECT 
    b.id,
    b.package_name,
    b.booking_date,
    b.total_amount,
    b.status,
    u.username AS user_name,
    e.event_name
FROM bookings b
JOIN users u ON b.user_id = u.id
JOIN events e ON b.event_id = e.id
ORDER BY b.id DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Bookings</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>
    <div class="container">

        <h2 class="page-title">Manage Bookings</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Package</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>Booking <?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                        <td><?php echo date("d M Y", strtotime($row['booking_date'])); ?></td>
                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                        <td>₹<?php echo number_format($row['total_amount']); ?></td>

                        <td>
                            <?php if ($row['status'] == 'Pending') { ?>
                                <span class="status-pending">Pending</span>
                            <?php } elseif ($row['status'] == 'Confirmed') { ?>
                                <span class="status-confirmed">Confirmed</span>
                            <?php } else { ?>
                                <span class="status-cancelled">Cancelled</span>
                            <?php } ?>
                        </td>

                        <td>
                            <?php if ($row['status'] == 'Pending') { ?>
                                <a href="?action=confirm&id=<?php echo $row['id']; ?>"
                                    class="btn confirm"
                                    onclick="return confirm('Confirm this booking?');">
                                    Confirm
                                </a>

                                <a href="?action=cancel&id=<?php echo $row['id']; ?>"
                                    class="btn cancel"
                                    onclick="return confirm('Cancel this booking?');">
                                    Cancel
                                </a>
                            <?php } else { ?>
                                -
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>

    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>