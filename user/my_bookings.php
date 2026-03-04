<?php
session_start();
include(__DIR__ . "/../includes/db_connect.php");
/* ------------------ SECURITY CHECK ------------------ */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* ------------------ FETCH USER BOOKINGS ------------------ */
$query = "SELECT * FROM bookings WHERE user_id = ? ORDER BY booking_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings | Planify</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- HEADER -->
<?php include("../includes/header.php"); ?>

<div class="dashboard-container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Planify</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="dashboard.php">My Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="my_bookings.php" class="active">My Bookings</a>
        <a href="change_password.php">Change Password</a>
        <a href="../auth/logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <h1 class="main-heading">My Bookings</h1>

        <?php if ($result->num_rows > 0) { ?>
            <div class="table-container">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Event Type</th>
                        <th>Event Date</th>
                        <th>Venue</th>
                        <th>Guests</th>
                        <th>Status</th>
                    </tr>

                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['booking_id']; ?></td>
                            <td><?php echo htmlspecialchars($row['event_type']); ?></td>
                            <td><?php echo date("d-m-Y", strtotime($row['event_date'])); ?></td>
                            <td><?php echo htmlspecialchars($row['venue']); ?></td>
                            <td><?php echo $row['guests']; ?></td>
                            <td class="status"><?php echo $row['booking_status']; ?></td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        <?php } else { ?>
            <p class="no-booking">You have not made any bookings yet.</p>
        <?php } ?>
    </div>
</div>

<!-- FOOTER -->
<?php include("../includes/footer.php"); ?>

</body>
</html>