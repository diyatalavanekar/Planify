<?php
require_once "auth_check.php";   // session + admin validation
require_once "../config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['new_username']);
    $password = trim($_POST['new_password']);

    if (!empty($username) && !empty($password)) {

        /* Hash password */
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        /* Insert admin */
        $stmt = $conn->prepare(
            "INSERT INTO admin (username, password) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            $message = "New admin added successfully!";
        } else {
            $message = "Username already exists!";
        }

    } else {
        $message = "All fields are required!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Admin | Planify</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="main-content">
    <h1>Add New Admin</h1>

    <?php if (!empty($message)) { ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php } ?>

    <!-- IMPORTANT: autocomplete OFF + NEW input names -->
    <form method="POST" autocomplete="off">

        <input type="text"
               name="new_username"
               placeholder="Admin Username"
               autocomplete="off"
               required>

        <input type="password"
               name="new_password"
               placeholder="Admin Password"
               autocomplete="new-password"
               required>

        <button type="submit">Add Admin</button>

    </form>
</div>

</body>
</html>
