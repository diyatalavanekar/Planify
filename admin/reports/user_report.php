<?php
require_once("db.php");

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Report</title>
    <link rel="stylesheet" href="../admin.css">
</head>

<body>

    <h2>User Report</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Account Created</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>

        <?php
        }
        ?>

    </table>

</body>

</html>