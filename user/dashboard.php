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

    <!-- User Dashboard CSS -->
    <link rel="stylesheet" href="user.css">
</head>

<script>
    // Prevent back button after logout
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
</script>

<body onload="noBack();" onpageshow="if (event.persisted) noBack();">

<div class="dashboard-container">

    <!-- ================= SIDEBAR ================= -->
    <div class="sidebar">
        <h2>Planify</h2>

        <a href="user_dashboard.php">Dashboard</a>
        <a href="my_profile.php">My Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="change_password.php">Change Password</a>

        <a href="../auth/logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div class="main-content">
        <h1>
            Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋
        </h1>
        <p>Manage your Planify account here</p>

        <div class="cards">
            <div class="card">
                <h3>My Profile</h3>
                <p>View your personal details</p>
            </div>

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
