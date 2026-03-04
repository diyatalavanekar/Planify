<?php
session_start();
include("../config/db.php");

/* ------------------ SECURITY CHECK ------------------ */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Planify</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- HEADER -->
<?php include("../includes/header.php"); ?>

<div class="dashboard-container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Planify</h2>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="my_profile.php">My Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="change_password.php">Change Password</a>
        <a href="../auth/logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <h1 class="main-heading">Welcome to Your Dashboard</h1>

        <div class="cards">

            <div class="card">
                <h3>My Profile</h3>
                <p>View and manage your profile information.</p>
            </div>

            <div class="card">
                <h3>My Bookings</h3>
                <p>Check your event booking details.</p>
            </div>

            <div class="card">
                <h3>Change Password</h3>
                <p>Update your account password securely.</p>
            </div>

        </div>
    </div>

</div>

<!-- FOOTER -->
<?php include("../includes/footer.php"); ?>

</body>
</html>