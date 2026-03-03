<?php
require_once "../config/db.php";
require_once "auth_check.php";

if (!isset($_GET['id'])) {
    header("Location: view_packages.php");
    exit();
}

$id = intval($_GET['id']);

/* FETCH PACKAGE */
$result = mysqli_query($conn, "SELECT * FROM packages WHERE id=$id");
$package = mysqli_fetch_assoc($result);

if (!$package) {
    echo "Package not found.";
    exit();
}

/* UPDATE LOGIC */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $event_id = intval($_POST['event_id']);
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $package_price = floatval($_POST['package_price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $update = "
        UPDATE packages SET
            event_id = '$event_id',
            package_name = '$package_name',
            package_price = '$package_price',
            description = '$description'
        WHERE id = $id
    ";

    if (mysqli_query($conn, $update)) {
        echo "<script>
            alert('Package Updated Successfully');
            window.location='view_packages.php';
        </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Package</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>

    <div class="package-form-wrapper">
        <div class="package-form-card">

            <h2>Edit Package</h2>

            <form method="POST">

                <div class="package-group">
                    <label>Select Event</label>
                    <select name="event_id" required>
                        <?php
                        $events = mysqli_query($conn, "SELECT * FROM events");
                        while ($event = mysqli_fetch_assoc($events)) {
                        ?>
                            <option value="<?php echo $event['id']; ?>"
                                <?php if ($event['id'] == $package['event_id']) echo "selected"; ?>>
                                <?php echo htmlspecialchars($event['event_name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="package-group">
                    <label>Package Name</label>
                    <input type="text" name="package_name"
                        value="<?php echo htmlspecialchars($package['package_name']); ?>" required>
                </div>

                <div class="package-group">
                    <label>Package Price</label>
                    <input type="number" name="package_price"
                        value="<?php echo $package['package_price']; ?>"
                        step="0.01" required>
                </div>

                <div class="package-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" required><?php echo htmlspecialchars($package['description']); ?></textarea>
                </div>

                <button type="submit" class="package-btn">Update Package</button>

            </form>

        </div>
    </div>
    <?php include("admin_footer.php"); ?>
</body>

</html>