<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

/* Prevent caching of protected pages */
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$user_id = $_SESSION['user_id'];

/* Fetch username securely */
$query = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<link rel="stylesheet" href="user.css">

<!-- DASHBOARD CONTAINER -->
<div class="dashboard-container">

    <?php include("user_sidebar.php"); ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <h1>
            Welcome, <?php echo htmlspecialchars($user['username']); ?> 👋
        </h1>

        <p>Manage your bookings and profile from here</p>

        <div class="cards">

            <a href="my_profile.php" class="card-link">
                <div class="card">
                    <h3>My Profile</h3>
                    <p>View your profile information</p>
                </div>
            </a>

            <a href="edit_profile.php" class="card-link">
                <div class="card">
                    <h3>Edit Profile</h3>
                    <p>Update your personal details</p>
                </div>
            </a>

            <a href="my_bookings.php" class="card-link">
                <div class="card">
                    <h3>My Bookings</h3>
                    <p>View your event booking history</p>
                </div>
            </a>

            <a href="change_password.php" class="card-link">
                <div class="card">
                    <h3>Change Password</h3>
                    <p>Update your account password securely</p>
                </div>
            </a>

        </div>

    </div>

</div>