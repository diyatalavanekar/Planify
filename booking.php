<?php
session_start();
require_once "config/db.php";

/* LOGIN CHECK */
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

/* EVENT CHECK */
if (!isset($_GET['event_id'])) {
    header("Location: events.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$event_id = intval($_GET['event_id']);

/* FETCH EVENT */
$event = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM events WHERE id=$event_id")
);

if (!$event) {
    echo "Event not found.";
    exit();
}

/* FETCH PACKAGES */
$packages = mysqli_query($conn, "SELECT * FROM packages WHERE event_id=$event_id");

/* FETCH FOOD ITEMS */
$veg_items = mysqli_query($conn, "SELECT * FROM food_items WHERE type='Veg'");
$nonveg_items = mysqli_query($conn, "SELECT * FROM food_items WHERE type='NonVeg'");

/* ================= FORM SUBMIT ================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $package_price = floatval($_POST['package_price']);
    $guests = intval($_POST['guests']);
    $veg_qty = intval($_POST['veg_qty']);
    $nonveg_qty = intval($_POST['nonveg_qty']);
    // Validate total plates = guests
    if (($veg_qty + $nonveg_qty) != $guests) {
        echo "<script>
        alert('Total Veg and Non-Veg plates must be equal to number of guests.');
        window.history.back();
    </script>";
        exit();
    }
    $event_date = $_POST['event_date'];

    $selected_food = $_POST['food_items'] ?? [];

    $food_total = 0;

    foreach ($selected_food as $food_id) {
        $food_id = intval($food_id);
        $food = mysqli_fetch_assoc(
            mysqli_query($conn, "SELECT * FROM food_items WHERE id=$food_id")
        );

        if ($food) {
            if ($food['type'] == "Veg") {
                $food_total += $food['price'] * $veg_qty;
            } else {
                $food_total += $food['price'] * $nonveg_qty;
            }
        }
    }

    $total = $package_price + $food_total;
    $advance = $total * 0.20;
    $remaining = $total - $advance;

    $insert_booking = "INSERT INTO bookings
        (user_id, event_id, event_date, package_name, package_price, guests, veg_qty, nonveg_qty, total_amount, advance_amount, remaining_amount)
        VALUES
        ('$user_id', '$event_id', '$event_date', '$package_name', '$package_price', '$guests', '$veg_qty', '$nonveg_qty', '$total', '$advance', '$remaining')";

    if (mysqli_query($conn, $insert_booking)) {

        $booking_id = mysqli_insert_id($conn);

        foreach ($selected_food as $food_id) {

            $food_id = intval($food_id);

            $food = mysqli_fetch_assoc(
                mysqli_query($conn, "SELECT * FROM food_items WHERE id=$food_id")
            );

            if ($food) {
                mysqli_query($conn, "INSERT INTO booking_food_items
                    (booking_id, food_item_id, type, price)
                    VALUES
                    ('$booking_id', '$food_id', '{$food['type']}', '{$food['price']}')");
            }
        }

        echo "<script>
            alert('Booking Submitted Successfully!');
            window.location='user/my_bookings.php';
        </script>";
        exit();
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

            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
            <!-- PACKAGE -->
            <label>Select Package</label>
            <select id="package_select" name="package_select" required>
                <option value="">Select Package</option>
                <?php while ($row = mysqli_fetch_assoc($packages)) { ?>
                    <option
                        value="<?php echo $row['package_name']; ?>"
                        data-price="<?php echo $row['package_price']; ?>"
                        data-description="<?php echo htmlspecialchars($row['description']); ?>">
                        <?php echo $row['package_name']; ?> (₹<?php echo $row['package_price']; ?>)
                    </option>
                <?php } ?>
            </select>

            <p id="package_description" style="margin:8px 0 15px 0; color:#444;"></p>

            <input type="hidden" name="package_name" id="package_name">
            <input type="hidden" name="package_price" id="package_price">

            <!-- GUESTS -->
            <label>Number of Guests</label>
            <input type="number" name="guests" id="guests" min="1" required>

            <!-- VEG ITEMS -->
            <h3>Choose Items For Veg Thali</h3>

            <table class="food-table">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Item Name</th>
                        <th>Price (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($veg = mysqli_fetch_assoc($veg_items)) { ?>
                        <tr>
                            <td>
                                <input type="checkbox"
                                    name="food_items[]"
                                    class="food_item"
                                    value="<?php echo $veg['id']; ?>"
                                    data-price="<?php echo $veg['price']; ?>"
                                    data-type="Veg">
                            </td>
                            <td><?php echo $veg['item_name']; ?></td>
                            <td><?php echo $veg['price']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <label>Number of Veg Plates</label>
            <input type="number" name="veg_qty" id="veg_qty" min="0" value="0">

            <!-- NON VEG ITEMS -->
            <h3>Choose Items For Non Veg Thali</h3>

            <table class="food-table">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Item Name</th>
                        <th>Price (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($nonveg = mysqli_fetch_assoc($nonveg_items)) { ?>
                        <tr>
                            <td>
                                <input type="checkbox"
                                    name="food_items[]"
                                    class="food_item"
                                    value="<?php echo $nonveg['id']; ?>"
                                    data-price="<?php echo $nonveg['price']; ?>"
                                    data-type="NonVeg">
                            </td>
                            <td><?php echo $nonveg['item_name']; ?></td>
                            <td><?php echo $nonveg['price']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <label>Number of Non-Veg Plates</label>
            <input type="number" name="nonveg_qty" id="nonveg_qty" min="0" value="0">

            <label>Event Date</label>
            <input type="date"
                name="event_date"
                min="<?php echo date('Y-m-d'); ?>"
                required>

            <!-- TOTAL -->
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
        const descriptionBox = document.getElementById("package_description");

        const totalSpan = document.getElementById("total");
        const advanceSpan = document.getElementById("advance");
        const remainingSpan = document.getElementById("remaining");

        function updatePackageDetails() {

            const selected = packageSelect.options[packageSelect.selectedIndex];

            if (!selected || selected.value === "") {
                descriptionBox.innerText = "";
                packageNameInput.value = "";
                packagePriceInput.value = "";
                calculate();
                return;
            }

            packageNameInput.value = selected.value;
            packagePriceInput.value = selected.getAttribute("data-price");
            descriptionBox.innerText = selected.getAttribute("data-description");

            calculate();
        }

        function calculate() {

            const packagePrice = parseFloat(packagePriceInput.value) || 0;
            const vegQty = parseInt(document.getElementById("veg_qty").value) || 0;
            const nonvegQty = parseInt(document.getElementById("nonveg_qty").value) || 0;

            let total = packagePrice;

            document.querySelectorAll(".food_item:checked").forEach(item => {

                const price = parseFloat(item.getAttribute("data-price"));
                const type = item.getAttribute("data-type");

                if (type === "Veg") {
                    total += price * vegQty;
                } else {
                    total += price * nonvegQty;
                }
            });

            const advance = total * 0.20;
            const remaining = total - advance;

            totalSpan.innerText = total.toFixed(2);
            advanceSpan.innerText = advance.toFixed(2);
            remainingSpan.innerText = remaining.toFixed(2);
        }

        /* EVENTS */
        packageSelect.addEventListener("change", updatePackageDetails);
        document.querySelectorAll("input").forEach(el => {
            el.addEventListener("change", calculate);
        });

        /* SUBMIT VALIDATION (ONLY ONCE) */
        document.querySelector(".booking-form").addEventListener("submit", function(e) {

            const guests = parseInt(document.getElementById("guests").value) || 0;
            const vegQty = parseInt(document.getElementById("veg_qty").value) || 0;
            const nonvegQty = parseInt(document.getElementById("nonveg_qty").value) || 0;

            if ((vegQty + nonvegQty) !== guests) {
                alert("Total Veg and Non-Veg plates must equal number of guests.");
                e.preventDefault();
            }
        });
    </script>

</body>

</html>