<?php
require_once "../config/db.php";
require_once "auth_check.php";

if (!isset($_GET['id'])) {
    header("Location: view_packages.php");
    exit();
}

$id = intval($_GET['id']);

/* OPTIONAL: Check if package has bookings */
$check = mysqli_query($conn, "
    SELECT id FROM bookings 
    WHERE package_name IN (
        SELECT package_name FROM packages WHERE id=$id
    )
");

if (mysqli_num_rows($check) > 0) {
    echo "<script>
        alert('Cannot delete! Package is used in bookings.');
        window.location='view_packages.php';
    </script>";
    exit();
}

/* DELETE */
mysqli_query($conn, "DELETE FROM packages WHERE id=$id");

echo "<script>
    alert('Package Deleted Successfully');
    window.location='view_packages.php';
</script>";
exit();
