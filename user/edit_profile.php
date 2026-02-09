<?php
session_start();
include("../config/db.php"); // database connection

/* Block cache */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

/* Session check */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

/* Fetch user data from database */
$user_id = $_SESSION['user_id'];

$query = "SELECT username, email, phone FROM users WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile | Planify</title>
    <link rel="stylesheet" href="user.css">
</head>

<script>
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
</script>

<body onload="noBack();" onpageshow="if (event.persisted) noBack();">

<div class="dashboard-container">

    <!-- ============ SIDEBAR ============ -->
    <div class="sidebar">
        <h2>Planify</h2>
        <a href="user_dashboard.php">Dashboard</a>
        <a href="my_profile.php">My Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="my_bookings.php">My Bookings</a>
        <a href="change_password.php">Change Password</a>
        <a href="../auth/logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- ============ MAIN CONTENT ============ -->
    <div class="main-content">
        <h1 style="color: rgb(48,47,81);">Edit Profile</h1>

        <form action="update_profile.php" method="POST" class="profile-form">

            <label>Username</label>
            <input type="text" name="username"
                   value="<?php echo htmlspecialchars($user['username']); ?>"
                   required>

            <label>Email</label>
            <input type="email" name="email"
                   value="<?php echo htmlspecialchars($user['email']); ?>"
                   required>

            <label>Phone</label>
            <input type="text" name="phone"
                   value="<?php echo htmlspecialchars($user['phone']); ?>"
                   pattern="[0-9]{10}"
                   title="Enter 10 digit phone number"
                   required>

            <button type="submit" class="btn-save">Update Profile</button>
        </form>
    </div>

</div>

</body>
</html>
