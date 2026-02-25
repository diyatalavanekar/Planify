<?php
session_start();
require_once "../config/db.php";
require_once "auth_check.php";

$message = "";

// ================= FORM SUBMISSION =================
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $event_name = trim($_POST['event_name']);
    $description = trim($_POST['description']);

    // ================= VALIDATION =================
    if (empty($event_name) || empty($description)) {
        $message = "All fields are required.";
    } else {

        $image = "";

        if (!empty($_FILES['image']['name'])) {

            $target_dir = "../images/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $image = time() . "_" . basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $image;

            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }

        $stmt = $conn->prepare("INSERT INTO events (event_name, description, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $event_name, $description, $image);

        if ($stmt->execute()) {
            $message = "Event added successfully!";
        } else {
            $message = "Error adding event.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Event | Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>

    <div class="main-content">

        <div class="form-container">

            <h2>Add Event Type</h2>

            <?php if ($message != "") { ?>
                <div class="form-message">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form method="POST" enctype="multipart/form-data" class="admin-form">

                <label>Event Name</label>
                <input type="text" name="event_name" required>

                <label>Description</label>
                <textarea name="description" rows="4" required></textarea>

                <label>Upload Image</label>
                <input type="file" name="image">

                <button type="submit" class="primary-btn">Add Event</button>

            </form>

        </div>

    </div>

    <?php include("admin_footer.php"); ?>

</body>

</html>