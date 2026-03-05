<?php
require_once("db.php");

/* ==============================
   FETCH ALL BOOKINGS
============================== */
$query = "SELECT b.*, u.username, e.event_name 
          FROM bookings b
          JOIN users u ON b.user_id = u.id
          JOIN events e ON b.event_id = e.id
          ORDER BY b.event_date DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Booking Report</title>
    <link rel="stylesheet" href="../admin.css">
</head>

<body>

    <h2>Booking Report</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>Booking ID</th>
            <th>User</th>
            <th>Event</th>
            <th>Event Date</th>
            <th>Package</th>
            <th>Guests</th>
            <th>Total Amount</th>
            <th>Advance</th>
            <th>Remaining</th>
            <th>Status</th>
            <th>Booked On</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['event_name']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['event_date'])); ?></td>
                <td><?php echo $row['package_name']; ?></td>
                <td><?php echo $row['guests']; ?></td>
                <td>₹<?php echo $row['total_amount']; ?></td>
                <td>₹<?php echo $row['advance_amount']; ?></td>
                <td>₹<?php echo $row['remaining_amount']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['booking_date'])); ?></td>
            </tr>

        <?php
        }
        ?>

    </table>

</body>

</html>