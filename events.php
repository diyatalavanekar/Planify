<?php
// events.php - Planify Events Page
// This page dynamically displays events added by admin (Rasika Prakshale)

include("database/connection.php");
include("includes/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Planify | Events</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- ================= EVENTS PAGE ================= -->
<section class="events-section">
    <div class="container">

        <!-- Page Heading -->
        <h1 class="page-title">Our Events</h1>
        <p class="page-subtitle">
            Choose from a variety of events hosted at our venue
        </p>

        <!-- Events Grid -->
        <div class="events-grid">

            <?php
            // Fetch only active events
            $query = "SELECT * FROM events WHERE status = 'Active'";
            $result = mysqli_query($connect, $query);

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>
                <!-- Event Card -->
                <div class="event-card">

                    <!-- Event Image -->
                    <div class="event-image">
                        <img src="images/events/<?php echo $row['image']; ?>" alt="<?php echo $row['event_name']; ?>">
                    </div>

                    <!-- Event Content -->
                    <div class="event-content">
                        <h3><?php echo $row['event_name']; ?></h3>

                        <p class="event-desc">
                            <?php echo substr($row['description'], 0, 90); ?>...
                        </p>

                        <ul class="event-details">
                            <li><strong>Price:</strong> ₹<?php echo $row['price']; ?></li>
                            <li><strong>Capacity:</strong> <?php echo $row['capacity']; ?> People</li>
                            <li><strong>Duration:</strong> <?php echo $row['duration']; ?></li>
                        </ul>

                        <!-- Buttons -->
                        <div class="event-buttons">
                            <a href="event_details.php?id=<?php echo $row['event_id']; ?>" class="btn-outline">
                                View Details
                            </a>
                            <a href="book_event.php?id=<?php echo $row['event_id']; ?>" class="btn-primary">
                                Book Now
                            </a>
                        </div>
                    </div>

                </div>
                <!-- End Event Card -->
            <?php
                }
            } else {
                echo "<p class='no-events'>No events available at the moment.</p>";
            }
            ?>

        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>

</body>
</html>
