<?php
session_start();
require_once "../config/db.php";
require_once "auth_check.php";

$message = "";

// Get event ID
if (!isset($_GET['id'])) {
    header("Location: view_events.php");
    exit();
}

$id = $_GET['id'];

// Fetch event data
$result = mysqli_query($conn, "SELECT * FROM events WHERE id=$id");
$event = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $event_name = trim($_POST['event_name']);
    $description = trim($_POST['description']);
    $image = $event['image'];

    if (!empty($_FILES['image']['name'])) {

        $target_dir = "../images/";
        $image = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;

        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    $stmt = $conn->prepare("UPDATE events SET event_name=?, description=?, image=? WHERE id=?");
    $stmt->bind_param("sssi", $event_name, $description, $image, $id);

    if ($stmt->execute()) {
        $message = "Event updated successfully!";
    } else {
        $message = "Error updating event.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Event | Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <?php include("admin_header.php"); ?>
    <?php include("admin_sidebar.php"); ?>

    <div class="main-content">

        <div class="form-container">
            <h2>Edit Event</h2>

            <?php if ($message != "") echo "<div class='form-message'>$message</div>"; ?>

            <form method="POST" enctype="multipart/form-data" class="admin-form">

                <label>Event Name</label>
                <input type="text" name="event_name"
                    value="<?php echo htmlspecialchars($event['event_name']); ?>" required>

                <label>Description</label>
                <textarea name="description" rows="4" required>
<?php echo htmlspecialchars($event['description']); ?>
            </textarea>

                <label>Current Image</label><br>
                <?php if (!empty($event['image'])) { ?>
                    <img src="../images/<?php echo $event['image']; ?>" width="100"><br><br>
                <?php } ?>

                <label>Change Image</label>
                <input type="file" name="image">

                <button type="submit" class="primary-btn">Update Event</button>

            </form>
        </div>

    </div>

    <?php include("admin_footer.php"); ?>

</body>

</html>