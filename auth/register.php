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

    <?php include("../includes/header.php"); ?>

    <section class="auth-container">
        <div class="auth-box">
            <h2>Create Account</h2>
            <p class="auth-subtext">Join Planify to manage and explore events</p>

            <form action="register_process.php" method="POST" onsubmit="return validateForm();">

                <div class="input-group">
                    <input type="text" name="username" id="username"
                        placeholder="Username" required>
                </div>

                <div class="input-group">
                    <input type="email" name="email" id="email"
                        placeholder="Email Address" required>
                </div>

                <div class="input-group">
                    <input type="tel" name="phone" id="phone"
                        placeholder="Phone Number (10 digits)"
                        required>
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="password"
                        placeholder="Password (min 6 characters)" required>
                </div>

                <div class="input-group">
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

    <?php include("../includes/footer.php"); ?>

    <script>
        function validateForm() {

            let username = document.getElementById("username").value.trim();
            let phone = document.getElementById("phone").value.trim();
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirm_password").value;

            if (username.length < 3) {
                alert("Username must be at least 3 characters.");
                return false;
            }

            let phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(phone)) {
                alert("Phone number must be exactly 10 digits.");
                return false;
            }

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