<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/Planify/css/style.css">
</head>
<body>

<?php include("../includes/header.php"); ?>

<div class="dashboard-container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?> 👋</h2>
    <p>This is your dashboard.</p>
</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>
