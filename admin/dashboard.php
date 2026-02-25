<?php
require_once "auth_check.php";

/* Extra safety: prevent caching */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>

<?php include("admin_header.php"); ?>
<?php include("admin_sidebar.php"); ?>

<div class="main-content">

    <h1>
        Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?> 👋
    </h1>

    <p>Manage Planify from here</p>

    <div class="cards">

        <a href="manage_users.php" class="card-link">
            <div class="card">
                <h3>Total Users</h3>
                <p>View & manage registered users</p>
            </div>
        </a>

        <a href="admin_event.php" class="card-link">
            <div class="card">
                <h3>Events</h3>
                <p>View and manage events</p>
            </div>
        </a>

        <a href="update_contact.php" class="card-link">
            <div class="card">
                <h3>Contact Page</h3>
                <p>Edit contact information</p>
            </div>
        </a>

        <a href="settings.php" class="card-link">
            <div class="card">
                <h3>View Admin</h3>
                <p>View and edit admins</p>
            </div>
        </a>

    </div>

</div>

<?php include("admin_footer.php"); ?>