<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

/* Prevent caching of protected pages */
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$user_id = $_SESSION['user_id'];

/* Fetch user data securely */
$stmt = $conn->prepare("SELECT username, email, phone, created_at FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Profile - Planify</title>
    <link rel="stylesheet" href="user.css">
</head>

<body>

    <div class="dashboard-container">

        <?php include("user_sidebar.php"); ?>

        <div class="main-content">

            <h2 class="page-title">My Profile</h2>

            <?php
            if (isset($_GET['success'])) {
                echo "<p style='color:green;'>Profile updated successfully!</p>";
            }
            ?>

            <form action="update_profile.php" method="POST" id="profileForm" class="profile-form">

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

                <label>Account Created On</label>
                <input type="text"
                    value="<?php echo $user['created_at']; ?>"
                    readonly>

                <button type="submit" class="btn-save">Update Profile</button>

            </form>

        </div>

    </div>

    <script>
        document.getElementById("profileForm").addEventListener("submit", function(e) {

            let phone = document.querySelector("input[name='phone']").value;

            if (!/^[0-9]{10}$/.test(phone)) {
                alert("Phone number must be exactly 10 digits.");
                e.preventDefault();
            }

        });
    </script>

</body>

</html>