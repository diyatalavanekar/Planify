<?php
require_once "auth_check.php";

/* Extra safety: prevent caching again */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Planify</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <div class="dashboard-container">

        <!-- ================= SIDEBAR ================= -->
        <div class="sidebar">
            <h2>Planify Admin</h2>

            <?php
            $adminName = $_SESSION['admin_username'] ?? '';
            if ($adminName === 'Rasika Prakshale') {
                echo '<a href="add_admin.php">Add Admin</a>';
            }
            ?>

            <a href="manage_users.php">Manage Users</a>
            <a href="manage_bookings.php">Manage Bookings</a>
            <a href="update_about.php">About Page Content</a>
            <a href="update_contact.php">Contact Page Content</a>
            <a href="settings.php">Settings</a>

            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <!-- ================= MAIN CONTENT ================= -->
        <div class="main-content">

            <h1>
                Welcome, <?php echo htmlspecialchars($adminName); ?> 👋
            </h1>

            <p>Manage Planify from here</p>

            <div class="cards">

                <div class="card">
                    <h3>Total Users</h3>
                    <p>View & manage registered users</p>
                    <a href="manage_users.php" class="card-btn">Open</a>
                </div>

                <div class="card">
                    <h3>Bookings</h3>
                    <p>View and manage bookings</p>
                    <a href="manage_bookings.php" class="card-btn">Open</a>
                </div>

                <div class="card">
                    <h3>Contact Page</h3>
                    <p>Edit contact information</p>
                    <a href="update_contact.php" class="card-btn">Open</a>
                </div>

                <div class="card">
                    <h3>Website Settings</h3>
                    <p>Update website content</p>
                    <a href="settings.php" class="card-btn">Open</a>
                </div>

            </div>

        </div>

    </div>

</body>

</html>