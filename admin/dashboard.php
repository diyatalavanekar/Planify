<?php
include '../config/db.php';

// Fetch existing info
$query = "SELECT * FROM contact_info LIMIT 1";
$result = mysqli_query($conn, $query);
$contact = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard | Contact Info</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2 style="color:rgb(48,47,81); text-align:center;">Update Contact Information</h2>

<form action="update_contact.php" method="post" class="admin-form">

    <label>Email</label>
    <input type="email" name="email" value="<?= $contact['email']; ?>" required>

    <label>Phone</label>
    <input type="text" name="phone" pattern="[0-9]{10}" value="<?= $contact['phone']; ?>" required>

    <label>Address</label>
    <textarea name="address" required><?= $contact['address']; ?></textarea>

    <button type="submit">Update</button>

</form>

</body>
</html>
