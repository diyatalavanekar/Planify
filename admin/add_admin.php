<?php
require_once "auth_check.php";
require_once "../config/db.php";

/* Allow only owner */
if ($_SESSION['admin_username'] !== 'Rasika Prakshale') {
    header("Location: dashboard.php");
    exit();
}

$message = "";

/* Handle form submission */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['new_username']);
    $password = trim($_POST['new_password']);

    if (!empty($username) && !empty($password)) {

        $stmt = $conn->prepare(
            "INSERT INTO admin (username, password) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $message = "New admin added successfully!";
        } else {
            $message = "Username already exists!";
        }

        $stmt->close();
    } else {
        $message = "All fields are required!";
    }
}
?>

<?php include("admin_header.php"); ?>
<?php include("admin_sidebar.php"); ?>

<div class="main-content">

    <h1>Add New Admin</h1>

    <?php if (!empty($message)) { ?>
        <p style="color:green;"><?php echo htmlspecialchars($message); ?></p>
    <?php } ?>

    <form method="POST" autocomplete="off">

        <input type="text"
            name="new_username"
            placeholder="Admin Username"
            required>

        <input type="password"
            name="new_password"
            placeholder="Admin Password"
            required>

        <button type="submit">Add Admin</button>

    </form>

</div>

<?php include("admin_footer.php"); ?>