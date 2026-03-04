<?php
session_start();
include("../includes/db_connect.php");

/* ===============================
   LOGIN CHECK
   =============================== */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Error variables */
$current_error = "";
$new_error = "";
$confirm_error = "";
$success = "";

/* Keep values */
$current_password = "";
$new_password = "";
$confirm_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch password
    $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $isValid = true;

    /* Current password check */
    if (empty($current_password)) {
        $current_error = "Current password is required";
        $isValid = false;
    } elseif ($current_password != $user['password']) {
        $current_error = "Current password is incorrect";
        $isValid = false;
    }

    /* New password check */
    if (strlen($new_password) < 6) {
        $new_error = "Password must be at least 6 characters";
        $isValid = false;
    }

    /* Confirm password check */
    if ($new_password != $confirm_password) {
        $confirm_error = "Passwords do not match";
        $isValid = false;
    }

    /* If all valid → Update */
    if ($isValid) {

        $update = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $update->bind_param("si", $new_password, $user_id);
        $update->execute();

        $success = "Password updated successfully!";

        // Clear fields after success
        $current_password = "";
        $new_password = "";
        $confirm_password = "";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Change Password - Planify</title>
    <link rel="stylesheet" href="user.css">
</head>

<body>

    <div class="dashboard-container">

        <?php include("user_sidebar.php"); ?>

        <div class="main-content">

            <h2 style="color: rgb(48,47,81);">Change Password</h2>

            <?php if ($success) { ?>
                <p style="color:green;"><?php echo $success; ?></p>
            <?php } ?>

            <form method="POST" class="profile-form" id="passwordForm">

                <label>Current Password</label>
                <input type="password" name="current_password"
                    value="<?php echo htmlspecialchars($current_password); ?>">
                <small class="error"><?php echo $current_error; ?></small>

                <label>New Password</label>
                <input type="password" name="new_password"
                    value="<?php echo htmlspecialchars($new_password); ?>">
                <small class="error"><?php echo $new_error; ?></small>

                <label>Confirm New Password</label>
                <input type="password" name="confirm_password"
                    value="<?php echo htmlspecialchars($confirm_password); ?>">
                <small class="error"><?php echo $confirm_error; ?></small>

                <button type="submit" class="btn-save">Update Password</button>

            </form>

        </div>

    </div>

    <script>
        document.getElementById("passwordForm").addEventListener("submit", function(e) {

            let current = document.querySelector("input[name='current_password']");
            let newPass = document.querySelector("input[name='new_password']");
            let confirm = document.querySelector("input[name='confirm_password']");

            let isValid = true;

            document.querySelectorAll(".error").forEach(el => el.innerText = "");

            if (current.value.trim() === "") {
                current.nextElementSibling.innerText = "Current password is required";
                isValid = false;
            }

            if (newPass.value.length < 6) {
                newPass.nextElementSibling.innerText = "Password must be at least 6 characters";
                isValid = false;
            }

            if (newPass.value !== confirm.value) {
                confirm.nextElementSibling.innerText = "Passwords do not match";
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>

</body>

</html>