<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Planify</title>
    <link rel="stylesheet" href="../css/style.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="admin-login-container">

    <div class="login-box">
        <h2>Admin Login</h2>
        <p>Planify Administration</p>

        <form action="admin_login_process.php" method="POST">

            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="login-btn">Login</button>

        </form>
    </div>

</div>

</body>
</html>
