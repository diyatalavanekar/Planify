<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['registered'])) {
    echo "<p style='color:green;text-align:center;'>Registration successful! Please login.</p>";
}
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
            <?php
            if (isset($_GET['error'])) {

                if ($_GET['error'] == "notregistered") {
                    echo "<script>alert('You are not registered. Please sign up first.');</script>";
                }

                if ($_GET['error'] == "wrongpassword") {
                    echo "<script>alert('Incorrect password. Please try again.');</script>";
                }
            }
            ?>

            <form action="login_process.php" method="POST" autocomplete="off">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required autocomplete="off">
                </div>

                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
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