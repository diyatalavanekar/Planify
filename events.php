<?php
// events.php - Planify Events Page
require_once "config/db.php";

// Fetch events from database
$query = "SELECT * FROM events ORDER BY id DESC";
$result = mysqli_query($conn, $query);
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

    <?php include("includes/header.php"); ?>

    <!-- ================= HERO SECTION ================= -->
    <div class="event-header">
        <h1>Plan Your Events</h1>
        <h4>Select your event type and customize your booking</h4>
    </div>

    <!-- ================= EVENTS CARDS SECTION ================= -->
    <div class="events-container">

        <?php if (mysqli_num_rows($result) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="event-card">

                    <!-- Event Image -->
                    <?php if (!empty($row['image'])) { ?>
                        <img src="images/<?php echo $row['image']; ?>"
                            alt="Event Image"
                            style="width:100%; border-radius:8px;">
                    <?php } ?>

                    <!-- Event Name -->
                    <h3><?php echo htmlspecialchars($row['event_name']); ?></h3>

                    <!-- Description -->
                    <p><?php echo htmlspecialchars($row['description']); ?></p>

                    <!-- Book Now Button -->
                    <a href="booking.php?event_id=<?php echo $row['id']; ?>" class="btn">
                        Book Now
                    </a>

                </div>

            <?php } ?>

        <?php } else { ?>

            <p style="text-align:center;">No events available at the moment.</p>

        <?php } ?>

    </div>

    <?php include("includes/footer.php"); ?>

</body>

</html>