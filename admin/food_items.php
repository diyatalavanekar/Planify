<?php
require_once "auth_check.php";
require_once "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM food_items ORDER BY type");
?>

<?php include("admin_header.php"); ?>
<?php include("admin_sidebar.php"); ?>

<div class="admin-content">
    <div class="admin-card">

        <h2>Manage Food Items</h2>
        <a href="add_food.php" class="btn">+ Add Food Item</a>

        <table class="admin-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Item Name</th>
                    <th>Price (₹)</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['item_name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td>
                            <a href="edit_food.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="delete_food.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-danger"
                                onclick="return confirm('Delete this item?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>

    </div>
</div>

<?php include("admin_footer.php"); ?>