<div class="sidebar">
    <h2>Planify Admin</h2>

    <a href="/Planify/admin/dashboard.php">Admin Page</a>

    <?php if ($_SESSION['admin_id'] == 1) { ?>
        <a href="/Planify/admin/add_admin.php">Add Admin</a>
    <?php } ?>

    <a href="/Planify/admin/manage_users.php">Manage Users</a>
    <a href="/Planify/admin/manage_bookings.php">Manage Bookings</a>
    <a href="/Planify/admin/admin_event.php">Your Events</a>
    <a href="/Planify/admin/reports/report.php">Reports</a>
    <a href="/Planify/admin/update_contact.php">Contact Page Content</a>

    <a href="/Planify/admin/logout.php" class="logout-btn">Logout</a>
</div>