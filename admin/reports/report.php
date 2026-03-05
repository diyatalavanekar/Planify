<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reports | Admin Panel</title>
    <link rel="stylesheet" href="../admin.css">
</head>

<body>

    <?php include("../admin_header.php"); ?>
    <?php include("../admin_sidebar.php"); ?>

    <div class="main-content">

        <div class="main-content">

            <h1 class="page-title">Reports</h1>

            <div class="cards">

                <div class="card">
                    <h3>User Report</h3>
                    <p>View all registered users.</p>
                    <a href="user_report.php" class="btn">View Report</a>
                </div>

                <div class="card">
                    <h3>Booking Report</h3>
                    <p>View all event bookings.</p>
                    <a href="booking_report.php" class="btn">View Report</a>
                </div>

                <div class="card">
                    <h3>Package Report</h3>
                    <p>View event packages.</p>
                    <a href="package_report.php" class="btn">View Report</a>
                </div>

                <div class="card">
                    <h3>Food Items Report</h3>
                    <p>View all food items.</p>
                    <a href="food_report.php" class="btn">View Report</a>
                </div>

                <div class="card">
                    <h3>Contact Report</h3>
                    <p>View contact enquiries.</p>
                    <a href="contact_report.php" class="btn">View Report</a>
                </div>

            </div>

        </div>

    </div>

    <?php include("../admin_footer.php"); ?>

</body>

</html>