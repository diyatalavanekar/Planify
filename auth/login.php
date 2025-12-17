<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Planify</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="auth-body">

    <!-- header -->
    <?php include("../includes/header.php"); ?>

    <section class="auth-container">
        <div class="auth-box">
            <h2>Login to Planify</h2>
            <p class="auth-subtext">Manage and explore events seamlessly</p>

            <form action="login_process.php" method="POST">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="auth-btn">Login</button>
            </form>

            <p class="auth-footer">
                Don’t have an account?
                <a href="register.php">Sign Up</a>
            </p>
        </div>
    </section>
    <?php include("../includes/footer.php"); ?>
</body>
</html>
