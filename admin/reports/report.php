<?php
include("../../includes/admin_header.php");
?>

<div class="dashboard-container">

    <!-- Sidebar -->
    <?php include("../../includes/admin_sidebar.php"); ?>
    <!-- Main Content -->
    <div class="main-content">

        <h1 class="page-title">Reports</h1>

        <div class="report-container">

            <div class="report-card">
                <h3>User Report</h3>
                <p>View all registered users.</p>
                <a href="user_report.php" class="btn">View Report</a>
            </div>

            <div class="report-card">
                <h3>Booking Report</h3>
                <p>View all event bookings.</p>
                <a href="booking_report.php" class="btn">View Report</a>
            </div>

            <div class="report-card">
                <h3>Event Report</h3>
                <p>View all events available.</p>
                <a href="event_report.php" class="btn">View Report</a>
            </div>

            <div class="report-card">
                <h3>Package Report</h3>
                <p>View event packages.</p>
                <a href="package_report.php" class="btn">View Report</a>
            </div>

            <div class="report-card">
                <h3>Food Items Report</h3>
                <p>View all food items.</p>
                <a href="food_report.php" class="btn">View Report</a>
            </div>

            <div class="report-card">
                <h3>Contact Report</h3>
                <p>View contact enquiries.</p>
                <a href="contact_report.php" class="btn">View Report</a>
            </div>

        </div>

    </div>

</div>

<?php
include("../../includes/footer.php");
?>