<?php
// register.php - Planify
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Planify</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="auth-body">

    <!-- Header -->
    <?php include("../includes/header.php"); ?>

    <section class="auth-container">
        <div class="auth-box">
            <h2>Create Account</h2>
            <p class="auth-subtext">Join Planify to manage and explore events</p>

            <form action="register_process.php" method="POST" onsubmit="return validateForm();">

                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-group">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="password"
                           placeholder="Password" required>
                </div>

                <div class="input-group">
                    <!-- confirm password is ONLY for JS validation -->
                    <input type="password" id="confirm_password"
                           placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="auth-btn">Register</button>
            </form>

            <p class="auth-footer">
                Already have an account?
                <a href="login.php">Login</a>
            </p>
        </div>
    </section>

    <!-- Footer -->
    <?php include("../includes/footer.php"); ?>

    <!-- Client-side validation -->
    <script>
        function validateForm() {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirm_password").value;

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
