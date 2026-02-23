<?php
session_start();

/* Block cache */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

/* Session check */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard | Planify</title>
    <link rel="stylesheet" href="user.css">
</head>

<body>

    <div class="dashboard-container">

        <!-- Include Sidebar -->
        <?php include("../includes/user_sidebar.php"); ?>

        <!-- ================= MAIN CONTENT ================= -->
        <div class="main-content">
            <h1>
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋
            </h1>
            <p>Manage your Planify account here</p>

            <div class="cards">

                <div class="card">
                    <h3>Edit Profile</h3>
                    <p>Update your account information</p>
                </div>

                <div class="card">
                    <h3>My Bookings</h3>
                    <p>View your event bookings</p>
                </div>

                <div class="card">
                    <h3>Security</h3>
                    <p>Change your password</p>
                </div>

            </div>
        </div>

    </div>

</body>
</html>