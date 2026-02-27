<?php
require_once "auth_check.php";
require_once "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type = $_POST['type'];
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $price = floatval($_POST['price']);

    mysqli_query($conn, "INSERT INTO food_items (type, item_name, price) 
                         VALUES ('$type','$item_name','$price')");

    header("Location: food_items.php");
    exit();
}
?>

<?php include("admin_header.php"); ?>
<?php include("admin_sidebar.php"); ?>

<div class="form-wrapper">

    <div class="form-card">

        <h2>Add Food Item</h2>

        <form method="POST">

            <div class="form-group">
                <label>Type</label>
                <select name="type">
                    <option value="Veg">Veg</option>
                    <option value="NonVeg">NonVeg</option>
                </select>
            </div>

            <div class="form-group">
                <label>Item Name</label>
                <input type="text" name="item_name" required>
            </div>

            <div class="form-group">
                <label>Price (₹)</label>
                <input type="number" name="price" required>
            </div>

            <button type="submit" class="btn-primary">Add Item</button>
            <a href="food_items.php" class="btn-back">View Food Items</a><br>
        </form>
    </div>
</div>

<?php include("admin_footer.php"); ?>