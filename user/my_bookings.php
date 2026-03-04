<?php
session_start();
include("../config/db.php");

// ===============================
// LOGIN CHECK
// ===============================
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ===============================
// FETCH USER BOOKINGS
// ===============================
$stmt = $conn->prepare("
    SELECT 
        b.id,
        b.package_name,
        b.event_date,
        b.total_amount,
        b.advance_amount,
        b.remaining_amount,
        b.status,
        e.event_name
    FROM bookings b
    JOIN events e ON b.event_id = e.id
    WHERE b.user_id = ?
    ORDER BY b.id DESC
");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<link rel="stylesheet" href="user.css">

<!-- DASHBOARD WRAPPER -->
<div class="dashboard-wrapper">

    <!-- SIDEBAR (LEFT) -->
    <?php include("../includes/user_sidebar.php"); ?>

    <!-- MAIN CONTENT (RIGHT) -->
    <div class="main-content">

        <div class="my-bookings-container">

            <h2 class="my-bookings-title">My Bookings</h2>

            <?php if ($result->num_rows > 0) { ?>

                <div class="my-bookings-table-wrapper">
                    <table class="my-bookings-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Package</th>
                                <th>Total</th>
                                <th>Advance</th>
                                <th>Remaining</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td>Booking <?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                                    <td><?php echo date("d M Y", strtotime($row['event_date'])); ?></td>
                                    <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                                    <td>₹<?php echo number_format($row['total_amount']); ?></td>
                                    <td>₹<?php echo number_format($row['advance_amount']); ?></td>
                                    <td>₹<?php echo number_format($row['remaining_amount']); ?></td>

                                    <td>
                                        <?php if ($row['status'] == 'Pending') { ?>
                                            <span class="status-pending">Pending</span>
                                        <?php } elseif ($row['status'] == 'Confirmed') { ?>
                                            <span class="status-confirmed">Confirmed</span>
                                        <?php } else { ?>
                                            <span class="status-cancelled">Cancelled</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            <?php } else { ?>

                <p class="no-bookings">You have not made any bookings yet.</p>
                <button onclick="location.href='../events.php'" class="btn-save">
                    Explore Events
                </button>
            <?php } ?>

        </div>

    </div>
</div>

<?php
$stmt->close();
$conn->close();
?>