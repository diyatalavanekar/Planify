<?php
include 'config/db.php';

$query = "SELECT * FROM contact_info LIMIT 1";
$result = mysqli_query($conn, $query);
$contact = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Planify | Contact Us</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("includes/header.php"); ?>

<section class="contact-section">
    <div class="contact-container">

        <h1>Contact Us</h1>
        <p class="contact-tagline">
            Reach out to us for any queries related to event management.
        </p>

        <div class="contact-box">

            <!-- LEFT: STATIC INFORMATION -->
            <div class="contact-static">
                <h3>Get in Touch</h3>
                <p>
                    If you have any questions regarding events, bookings, or
                    platform usage, feel free to reach out using the contact
                    details provided.
                </p>

                
            </div>

            <!-- RIGHT: DYNAMIC CONTACT INFO -->
            <div class="contact-info">
                <h3>Official Contact</h3>

                <p><strong>Email:</strong> <?= htmlspecialchars($contact['email']); ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($contact['phone']); ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($contact['address']); ?></p>
                <p><strong>Owner:</strong> Rasika Prakshale</p>
            </div>

        </div>

    </div>
</section>

<?php include("includes/footer.php"); ?>

</body>
</html>
