<?php
session_start();
require_once "../config/db.php";
require_once "auth_check.php";

$result = mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Events | Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>

    <div class="main-content">

        <h2>All Events</h2>

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Event Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>

                    <td>
                        <?php if (!empty($row['image'])) { ?>
                            <img src="../images/<?php echo $row['image']; ?>" width="80">
                        <?php } else { ?>
                            No Image
                        <?php } ?>
                    </td>

                    <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>

                    <td>
                        <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                        <a href="delete_event.php?id=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are you sure?')"
                            class="delete-btn">Delete</a>
                    </td>
                </tr>
            <?php } ?>

        </table>

    </div>

    <?php include("admin_footer.php"); ?>

</body>

</html>