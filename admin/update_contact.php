<?php
require_once "auth_check.php";
require_once "../config/db.php";

/* ================= FETCH CURRENT CONTACT ================= */
$contact_result = $conn->query("SELECT * FROM contact_info LIMIT 1");
$contact = $contact_result->fetch_assoc();

/* ================= FORM SUBMISSION ================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email   = trim($_POST['email']);
    $phone   = trim($_POST['phone']);
    $address = trim($_POST['address']);

    /* ================= VALIDATION ================= */

    if (empty($email) || empty($phone) || empty($address)) {
        header("Location: update_contact.php?error=empty");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: update_contact.php?error=email");
        exit();
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        header("Location: update_contact.php?error=phone");
        exit();
    }

    /* ================= UPDATE USING PREPARED STATEMENT ================= */
    $stmt = $conn->prepare("UPDATE contact_info SET email=?, phone=?, address=? LIMIT 1");
    $stmt->bind_param("sss", $email, $phone, $address);
    $stmt->execute();

    /* ================= PRG PATTERN ================= */
    header("Location: update_contact.php?success=1");
    exit();
}
?>

<?php include("admin_header.php"); ?>
<?php include("admin_sidebar.php"); ?>

<div class="main-content">

    <h1>Update Official Contact</h1>

    <div class="contact-form-card">

        <form method="POST">

            <label>Email</label>
            <input type="email" name="email"
                value="<?php echo htmlspecialchars($contact['email']); ?>"
                required>

            <label>Phone</label>
            <input type="text" name="phone"
                value="<?php echo htmlspecialchars($contact['phone']); ?>"
                maxlength="10"
                required>

            <label>Address</label>
            <textarea name="address" required><?php
                                                echo htmlspecialchars($contact['address']);
                                                ?></textarea>

            <button type="submit">Update Contact</button>

        </form>

    </div>

</div>

<?php include("admin_footer.php"); ?>


<!-- ================= POPUP MESSAGES ================= -->
<?php if (isset($_GET['success'])): ?>
    <script>
        alert("Contact details updated successfully!");
    </script>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <script>
        alert("Invalid input. Please check your details.");
    </script>
<?php endif; ?>