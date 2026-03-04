<?php
session_start();
include("../includes/db_connect.php");

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include("../includes/header.php"); ?>

<div class="dashboard-container">

    <?php include(__DIR__ . "/../includes/user_sidebar.php"); ?>
    <div class="main-content">

        <h2 class="page-title">My Profile</h2>

        <?php
        if(isset($_GET['success'])){
            echo "<p style='color:green;'>Profile updated successfully!</p>";
        }
        ?>

        <form action="update_profile.php" method="POST" id="profileForm">

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

            <button type="submit" class="btn">Update Profile</button>

        </form>

    </div>

</div>

<?php include("../includes/footer.php"); ?>

<script>
// Extra client-side validation
document.getElementById("profileForm").addEventListener("submit", function(e){

    let phone = document.querySelector("input[name='phone']").value;

    if(!/^[0-9]{10}$/.test(phone)){
        alert("Phone number must be exactly 10 digits.");
        e.preventDefault();
    }

});
</script>

</body>
</html>