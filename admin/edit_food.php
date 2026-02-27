<?php
require_once "auth_check.php";
require_once "../config/db.php";

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM food_items WHERE id=$id");
$item = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type = $_POST['type'];
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $price = floatval($_POST['price']);

    mysqli_query($conn, "UPDATE food_items 
                         SET type='$type', item_name='$item_name', price='$price' 
                         WHERE id=$id");

    header("Location: food_items.php");
    exit();
}
?>

<?php include("admin_header.php"); ?>
<?php include("admin_sidebar.php"); ?>

<div class="form-wrapper">

    <div class="form-card">

        <h2>Edit Food Item</h2>

        <form method="POST">

            <div class="form-group">
                <label>Type</label>
                <select name="type">
                    <option value="Veg" <?php if ($item['type'] == "Veg") echo "selected"; ?>>Veg</option>
                    <option value="NonVeg" <?php if ($item['type'] == "NonVeg") echo "selected"; ?>>NonVeg</option>
                </select>
            </div>

            <div class="form-group">
                <label>Item Name</label>
                <input type="text" name="item_name"
                    value="<?php echo $item['item_name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Price (₹)</label>
                <input type="number" name="price"
                    value="<?php echo $item['price']; ?>" required>
            </div>

            <button type="submit" class="btn-primary">Update Item</button>
            <a href="food_items.php" class="btn-back">View Food Items</a>
        </form>

    </div>

</div>

<?php include("admin_footer.php"); ?>