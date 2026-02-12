<?php
session_start();

/* If already logged in, go to dashboard */
if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit();
}

/* Prevent caching */
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login | Planify</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <div class="admin-login-container">
        <div class="login-box">
            <h2>Admin Login</h2>
            <p>Planify Administration</p>

            <form method="post" action="admin_login_process.php" autocomplete="off">
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" autocomplete="off" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" autocomplete="new-password" required>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>

</body>

</html>