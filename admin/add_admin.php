<?php
require_once "auth_check.php";
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

        <form action="add_admin_process.php" method="POST" autocomplete="off">

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

</body>

</html>