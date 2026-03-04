<?php
require_once "../config/db.php";
require_once "auth_check.php";

/* DELETE PACKAGE */
if (isset($_GET['delete'])) {

    $id = intval($_GET['delete']);

    mysqli_query($conn, "DELETE FROM packages WHERE id=$id");

    echo "<script>
        alert('Package Deleted Successfully');
        window.location='view_packages.php';
    </script>";
    exit();
}

/* FETCH PACKAGES WITH EVENT NAME */
$query = "
    SELECT packages.*, events.event_name 
    FROM packages
    JOIN events ON packages.event_id = events.id
    ORDER BY packages.id DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Packages</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>

    <div class="admin-content">
        <div class="admin-card">

            <h2>All Packages</h2>

            <a href="add_package.php" class="btn">+ Add New Package</a>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Event</th>
                        <th>Package Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                            <td>₹<?php echo $row['package_price']; ?></td>
                            <td>
                                <?php
                                echo strlen($row['description']) > 50
                                    ? substr($row['description'], 0, 50) . "..."
                                    : $row['description'];
                                ?>
                            </td>
                            <td>
                                <a href="edit_package.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                                <a href="delete_package.php?id=<?php echo $row['id']; ?>"
                                    class="action-btn action-delete"
                                    onclick="return confirm('Are you sure you want to delete this package?');">
                                    Delete
                                </a>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>