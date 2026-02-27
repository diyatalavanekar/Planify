<?php
session_start();
require_once "config/db.php";

/* ================= LOGIN CHECK ================= */
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

/* ================= EVENT CHECK ================= */
if (!isset($_GET['event_id'])) {
    header("Location: events.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$event_id = intval($_GET['event_id']);

/* Fetch Event */
$event_query = mysqli_query($conn, "SELECT * FROM events WHERE id=$event_id");
$event = mysqli_fetch_assoc($event_query);

if (!$event) {
    echo "Event not found.";
    exit();
}

/* Fetch Packages */
$packages = mysqli_query($conn, "SELECT * FROM packages WHERE event_id=$event_id");

/* Fetch Food Prices */
$food_query = mysqli_query($conn, "SELECT * FROM food_prices LIMIT 1");
$food = mysqli_fetch_assoc($food_query);

$veg_price = $food['veg_price'];
$nonveg_price = $food['nonveg_price'];

/* ================= FORM SUBMIT ================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $package_price = floatval($_POST['package_price']);
    $guests = intval($_POST['guests']);
    $veg_qty = intval($_POST['veg_qty']);
    $nonveg_qty = intval($_POST['nonveg_qty']);

    if (($veg_qty + $nonveg_qty) > $guests) {
        echo "<script>alert('Plates cannot exceed guests');</script>";
    } else {

        $total = $package_price + ($veg_qty * $veg_price) + ($nonveg_qty * $nonveg_price);
        $advance = $total * 0.20;
        $remaining = $total - $advance;

        $insert = "INSERT INTO bookings 
            (user_id, event_id, package_name, package_price, guests, veg_qty, nonveg_qty, total_amount, advance_amount, remaining_amount) 
            VALUES 
            ('$user_id', '$event_id', '$package_name', '$package_price', '$guests', '$veg_qty', '$nonveg_qty', '$total', '$advance', '$remaining')";

        if (mysqli_query($conn, $insert)) {
            echo "<script>
                alert('Booking Submitted! Please visit office to pay advance.');
                window.location='my_bookings.php';
            </script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Book Event | Planify</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include("includes/header.php"); ?>

    <div class="event-header">
        <h1>Book <?php echo htmlspecialchars($event['event_name']); ?></h1>
    </div>

    <div class="booking-container">

        <form method="POST" class="booking-form">

            <!-- PACKAGE -->
            <label>Select Package</label>
            <select id="package_select" required>
                <option value="">Select Package</option>
                <?php while ($row = mysqli_fetch_assoc($packages)) { ?>
                    <option
                        data-name="<?php echo $row['package_name']; ?>"
                        data-price="<?php echo $row['package_price']; ?>">
                        <?php echo $row['package_name']; ?> (₹<?php echo $row['package_price']; ?>)
                    </option>
                <?php } ?>
            </select>

            <!-- Hidden Fields -->
            <input type="hidden" name="package_name" id="package_name">
            <input type="hidden" name="package_price" id="package_price">

            <!-- GUESTS -->
            <label>Number of Guests</label>
            <input type="number" name="guests" id="guests" min="1" required>

            <!-- VEG -->
            <label>Veg Plates (₹<?php echo $veg_price; ?> per plate)</label>
            <input type="number" name="veg_qty" id="veg_qty" min="0" value="0">

            <!-- NON VEG -->
            <label>Non-Veg Plates (₹<?php echo $nonveg_price; ?> per plate)</label>
            <input type="number" name="nonveg_qty" id="nonveg_qty" min="0" value="0">

            <!-- TOTAL DISPLAY -->
            <h3>Total: ₹<span id="total">0</span></h3>
            <h4>Advance (20%): ₹<span id="advance">0</span></h4>
            <h4>Remaining (80%): ₹<span id="remaining">0</span></h4>

            <button type="submit" class="btn">Submit Booking</button>

        </form>

    </div>

    <?php include("includes/footer.php"); ?>

    <script>
        const packageSelect = document.getElementById("package_select");
        const packageNameInput = document.getElementById("package_name");
        const packagePriceInput = document.getElementById("package_price");
        const guests = document.getElementById("guests");
        const veg = document.getElementById("veg_qty");
        const nonveg = document.getElementById("nonveg_qty");

        const totalSpan = document.getElementById("total");
        const advanceSpan = document.getElementById("advance");
        const remainingSpan = document.getElementById("remaining");

        const vegPrice = <?php echo $veg_price; ?>;
        const nonvegPrice = <?php echo $nonveg_price; ?>;

        function calculate() {

            const selected = packageSelect.options[packageSelect.selectedIndex];
            const packagePrice = parseFloat(selected.getAttribute("data-price")) || 0;

            packageNameInput.value = selected.getAttribute("data-name") || "";
            packagePriceInput.value = packagePrice;

            const guestCount = parseInt(guests.value) || 0;
            const vegQty = parseInt(veg.value) || 0;
            const nonvegQty = parseInt(nonveg.value) || 0;

            if ((vegQty + nonvegQty) > guestCount) {
                totalSpan.innerText = "0";
                advanceSpan.innerText = "0";
                remainingSpan.innerText = "0";
                return;
            }

            const total = packagePrice + (vegQty * vegPrice) + (nonvegQty * nonvegPrice);
            const advance = total * 0.20;
            const remaining = total - advance;

            totalSpan.innerText = total.toFixed(2);
            advanceSpan.innerText = advance.toFixed(2);
            remainingSpan.innerText = remaining.toFixed(2);
        }

        packageSelect.addEventListener("change", calculate);
        guests.addEventListener("input", calculate);
        veg.addEventListener("input", calculate);
        nonveg.addEventListener("input", calculate);
    </script>

</body>

</html>