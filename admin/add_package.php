<?php
session_start();
require_once "../config/db.php";
require_once "auth_check.php";

$message = "";

// Fetch events
$events = mysqli_query($conn, "SELECT * FROM events");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $event_id = $_POST['event_id'];
    $package_name = trim($_POST['package_name']);
    $package_price = trim($_POST['package_price']);

    if (empty($event_id) || empty($package_name) || empty($package_price)) {
        $message = "All fields are required.";
    } elseif (!is_numeric($package_price) || $package_price <= 0) {
        $message = "Invalid package price.";
    } else {

        $stmt = $conn->prepare("INSERT INTO packages (event_id, package_name, package_price) VALUES (?, ?, ?)");
        $stmt->bind_param("isd", $event_id, $package_name, $package_price);

        if ($stmt->execute()) {
            $message = "Package added successfully!";
        } else {
            $message = "Error adding package.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Packages | Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>

    <div class="main-content">
        <div class="form-container">
            <h2>Add Package</h2>

            <?php if ($message != "") echo "<div class='form-message'>$message</div>"; ?>

            <form method="POST" class="admin-form">

                <label>Select Event</label>
                <select name="event_id" required>
                    <option value="">Select Event</option>
                    <?php while ($row = mysqli_fetch_assoc($events)) { ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['event_name']; ?>
                        </option>
                    <?php } ?>
                </select>

                <label>Package Name</label>
                <input type="text" name="package_name" required>

                <label>Package Price</label>
                <input type="number" name="package_price" min="1" required>

                <button type="submit" class="primary-btn">Add Package</button>

            </form>
        </div>
    </div>

    <?php include("admin_footer.php"); ?>

</body>

</html>