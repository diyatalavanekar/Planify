<?php
session_start();
require_once "../config/db.php";
require_once "auth_check.php";

$message = "";

// Fetch current prices
$food = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM food_prices LIMIT 1"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $veg = $_POST['veg_price'];
    $nonveg = $_POST['nonveg_price'];

    if (!is_numeric($veg) || !is_numeric($nonveg)) {
        $message = "Invalid price.";
    } else {

        $stmt = $conn->prepare("UPDATE food_prices SET veg_price=?, nonveg_price=? WHERE id=?");
        $stmt->bind_param("ddi", $veg, $nonveg, $food['id']);

        if ($stmt->execute()) {
            $message = "Food prices updated!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Set Food Prices</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>

    <div class="main-content">
        <div class="form-container">

            <h2>Update Food Prices</h2>

            <?php if ($message != "") echo "<div class='form-message'>$message</div>"; ?>

            <form method="POST" class="admin-form">

                <label>Veg Price</label>
                <input type="number" name="veg_price" value="<?php echo $food['veg_price']; ?>" required>

                <label>Non-Veg Price</label>
                <input type="number" name="nonveg_price" value="<?php echo $food['nonveg_price']; ?>" required>

                <button type="submit" class="primary-btn">Update</button>

            </form>

        </div>
    </div>

    <?php include("admin_footer.php"); ?>

</body>

</html>