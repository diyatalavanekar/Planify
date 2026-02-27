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

    <h1>Manage Events 🎉</h1>
    <p>Control all event-related operations from here</p>

    <div class="cards">

        <!-- Add Event -->
        <a href="add_event.php" class="card-link">
            <div class="card">
                <h3>Add Event</h3>
                <p>Create a new event type</p>
            </div>
        </a>

        <!-- View Events -->
        <a href="view_events.php" class="card-link">
            <div class="card">
                <h3>View Events</h3>
                <p>See all existing events</p>
            </div>
        </a>

        <!-- Edit Event -->
        <a href="view_events.php" class="card-link">
            <div class="card">
                <h3>Edit Event</h3>
                <p>Modify existing event details</p>
            </div>
        </a>

        <!-- Delete Event -->
        <a href="view_events.php" class="card-link">
            <div class="card">
                <h3>Delete Event</h3>
                <p>Remove unwanted events</p>
            </div>
        </a>

        <a href="add_package.php" class="card-link">
            <div class="card">
                <h3>Add Packages</h3>
                <p>Add packages for each event</p>
            </div>
        </a>

        <a href="set_food_price.php" class="card-link">
            <div class="card">
                <h3>Set Food Prices</h3>
                <p>Update Veg and Non-Veg rates</p>
            </div>
        </a>

        <a href="food_items.php" class="card-link">
            <div class="card">
                <h3>Manage Food Items</h3>
                <p>View and manage food items</p>
            </div>
        </a>
    </div>

</div>

<?php include("admin_footer.php"); ?>