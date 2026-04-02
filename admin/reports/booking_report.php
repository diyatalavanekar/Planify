<?php
require_once("db.php");
/* ==============================
   FETCH ALL BOOKINGS
============================== */
$query = "SELECT b.*, u.username, e.event_name 
          FROM bookings b
          JOIN users u ON b.user_id = u.id
          JOIN events e ON b.event_id = e.id
          ORDER BY b.booking_date DESC";

$result = mysqli_query($conn, $query);

/* ==============================
   DATE SETUP
============================== */
date_default_timezone_set("Asia/Kolkata");

$today = date("Y-m-d");
$yesterday = date("Y-m-d", strtotime("-1 day"));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Booking Report</title>
    <link rel="stylesheet" href="../admin.css">

    <style>
        h2 {
            color: rgb(48,47,81);
            text-align: center;
        }

        h3 {
            color: rgb(48,47,81);
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: rgb(48,47,81);
            color: white;
        }

        td, th {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

<?php include("../admin_header.php"); ?>
<?php include("../admin_sidebar.php"); ?>

<div class="main-content">

<h2>Booking Report</h2>

<?php
/* ==============================
   ARRAYS FOR GROUPING
============================== */
$today_data = [];
$yesterday_data = [];
$old_data = [];

while ($row = mysqli_fetch_assoc($result)) {

    $booking_date = date("Y-m-d", strtotime($row['booking_date']));

    if ($booking_date == $today) {
        $today_data[] = $row;
    } elseif ($booking_date == $yesterday) {
        $yesterday_data[] = $row;
    } else {
        $old_data[] = $row;
    }
}

/* ==============================
   FUNCTION TO DISPLAY TABLE
============================== */
function displayTable($data) {
    if (count($data) == 0) {
        echo "<p>No Records Found</p>";
        return;
    }

    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Event</th>
                <th>Date</th>
                <th>Package</th>
                <th>Guests</th>
                <th>Total</th>
                <th>Advance</th>
                <th>Remaining</th>
                <th>Status</th>
                <th>Booked On</th>
            </tr>";

    foreach ($data as $row) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['event_name']}</td>
                <td>" . date("d-m-Y", strtotime($row['event_date'])) . "</td>
                <td>{$row['package_name']}</td>
                <td>{$row['guests']}</td>
                <td>₹{$row['total_amount']}</td>
                <td>₹{$row['advance_amount']}</td>
                <td>₹{$row['remaining_amount']}</td>
                <td>{$row['status']}</td>
                <td>" . date("d-m-Y", strtotime($row['booking_date'])) . "</td>
              </tr>";
    }

    echo "</table>";
}
?>

<!-- ==============================
     TODAY BOOKINGS
============================== -->
<h3>Today's Bookings</h3>
<?php displayTable($today_data); ?>

<!-- ==============================
     YESTERDAY BOOKINGS
============================== -->
<h3>Yesterday's Bookings</h3>
<?php displayTable($yesterday_data); ?>

<!-- ==============================
     HISTORY BOOKINGS
============================== -->
<h3>Previous Bookings (History)</h3>
<?php displayTable($old_data); ?>

<?php include("../admin_footer.php"); ?>

</body>
</html>