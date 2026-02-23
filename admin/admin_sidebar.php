<div class="sidebar">
    <h2>Planify Admin</h2>

    <a href="dashboard.php">Admin Page</a>

    <?php if ($_SESSION['admin_id'] == 1) { ?>
        <a href="add_admin.php">Add Admin</a>
    <?php } ?>

    <a href="manage_users.php">Manage Users</a>
    <a href="manage_bookings.php">Manage Bookings</a>
    <a href="admin_event.php">Your Events</a>
    <a href="update_about.php">About Page Content</a>
    <a href="update_contact.php">Contact Page Content</a>

    <a href="logout.php" class="logout-btn">Logout</a>
</div>