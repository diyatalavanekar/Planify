<?php
require_once "auth_check.php";
require_once "../config/db.php";

/* ================= TOTAL USERS COUNT ================= */
$total_result = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$total_row = $total_result->fetch_assoc();
$total_users = $total_row['total_users'];

/* ================= GROUP USERS BY DATE ================= */
$date_result = $conn->query("
    SELECT DATE(created_at) AS reg_date, COUNT(*) AS daily_total
    FROM users
    GROUP BY DATE(created_at)
    ORDER BY reg_date DESC
");
?>

<?php include("admin_header.php"); ?>
<?php include("admin_sidebar.php"); ?>

<div class="main-content">

    <h1>Manage Users</h1>

    <h3>Total Registered Users: <?php echo $total_users; ?></h3>

    <br>

    <?php while ($date_row = $date_result->fetch_assoc()) { ?>

        <h2>
            Date: <?php echo $date_row['reg_date']; ?>
            (Total: <?php echo $date_row['daily_total']; ?> users)
        </h2>

        <table border="1" width="100%" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            <?php
            $current_date = $date_row['reg_date'];

            $user_stmt = $conn->prepare("
                SELECT id, username, phone, email
                FROM users
                WHERE DATE(created_at) = ?
                ORDER BY id DESC
            ");
            $user_stmt->bind_param("s", $current_date);
            $user_stmt->execute();
            $users_result = $user_stmt->get_result();

            while ($user = $users_result->fetch_assoc()) {
            ?>

                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>"
                            onclick="return confirm('Delete this user?');">
                            Delete
                        </a>
                    </td>
                </tr>

            <?php } ?>

        </table>

        <br><br>

    <?php } ?>

</div>

<?php include("admin_footer.php"); ?>