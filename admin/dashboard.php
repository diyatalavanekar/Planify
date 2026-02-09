<?php
session_start();

/* Block cache */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

/* Session check */
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Planify</title>

    <!-- Admin Dashboard CSS -->
    <link rel="stylesheet" href="admin.css">
</head>
    <script>
    // Prevent back button access after logout
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>

<body onload="noBack();" onpageshow="if (event.persisted) noBack();">


<div class="dashboard-container">

    <!-- ================= SIDEBAR ================= -->
    <div class="sidebar">
        <h2>Planify Admin</h2>

        <a href="dashboard.php">Dashboard</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_bookings.php">Manage Bookings</a>
        <a href="manage_contact.php">Contact Page Content</a>
        <a href="settings.php">Settings</a>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div class="main-content">
        <h1>Welcome, Admin 👋</h1>
        <p>Manage Planify from here</p>

        <div class="cards">
            <div class="card">
                <h3>Total Users</h3>
                <p>View & manage registered users</p>
            </div>

            <div class="card">
                <h3>Bookings</h3>
                <p>View and manage bookings</p>
            </div>

            <div class="card">
                <h3>Contact Page</h3>
                <p>Edit contact information</p>
            </div>

            <div class="card">
                <h3>Website Settings</h3>
                <p>Update website content</p>
            </div>
        </div>
    </div>

</div>

</body>
</html>
