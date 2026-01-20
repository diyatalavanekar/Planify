<?php
include 'config/db.php';

// Fetch contact info
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

            <!-- STATIC FORM -->
            <form class="contact-form">
                <input type="text" placeholder="Your Name" required>
                <input type="email" placeholder="Your Email" required>
                <textarea placeholder="Your Message" required></textarea>
                <button disabled>Send Message</button>
                <small>* Message feature coming soon</small>
            </form>

            <!-- DYNAMIC CONTACT INFO -->
            <div class="contact-info">
                <h3>Official Contact</h3>
                <p><strong>Email:</strong> <?= $contact['email']; ?></p>
                <p><strong>Phone:</strong> <?= $contact['phone']; ?></p>
                <p><strong>Address:</strong> <?= $contact['address']; ?></p>
                <p><strong>Owner:</strong> Rasika Prakshale</p>
            </div>

        </div>
    </div>
</section>

<?php include("includes/footer.php"); ?>

</body>
</html>
