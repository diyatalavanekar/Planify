<?php
require_once "../config/db.php";
require_once "auth_check.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $event_id = intval($_POST['event_id']);
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $package_price = floatval($_POST['package_price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $query = "INSERT INTO packages (event_id, package_name, package_price, description)
              VALUES ('$event_id', '$package_name', '$package_price', '$description')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Package Added Successfully'); window.location='view_packages.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Package</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>

    <div class="package-form-wrapper">
        <div class="package-form-card">

            <h2>Add New Package</h2>

            <form method="POST" class="package-form">

                <div class="package-group">
                    <label>Select Event</label>
                    <select name="event_id" required>
                        <?php
                        $events = mysqli_query($conn, "SELECT * FROM events");
                        while ($event = mysqli_fetch_assoc($events)) {
                        ?>
                            <option value="<?php echo $event['id']; ?>">
                                <?php echo $event['event_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="package-group">
                    <label>Package Name</label>
                    <input type="text" name="package_name" required>
                </div>

                <div class="package-group">
                    <label>Package Price</label>
                    <input type="number" name="package_price" step="0.01" required>
                </div>

                <div class="package-group">
                    <label>Package Description</label>
                    <textarea name="description" rows="4" required></textarea>
                </div>

                <button type="submit" class="package-btn">Add Package</button>

            </form>

        </div>
    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>