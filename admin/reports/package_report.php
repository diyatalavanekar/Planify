<?php
require_once("db.php");

/* ==============================
   FETCH PACKAGES
============================== */
$query = "SELECT * FROM package ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

/* ==============================
   DATE SETUP
============================== */
date_default_timezone_set("Asia/Kolkata");

$today = date("Y-m-d");
$yesterday = date("Y-m-d", strtotime("-1 day"));

/* ==============================
   ARRAYS FOR GROUPING
============================== */
$today_data = [];
$yesterday_data = [];
$old_data = [];

while ($row = mysqli_fetch_assoc($result)) {

    $created_date = date("Y-m-d", strtotime($row['created_at']));

    if ($created_date == $today) {
        $today_data[] = $row;
    } elseif ($created_date == $yesterday) {
        $yesterday_data[] = $row;
    } else {
        $old_data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Package Report</title>
    <link rel="stylesheet" href="../admin.css">

    <style>
        h2, h3 {
            color: rgb(48,47,81);
        }

        h3 {
            margin-top: 30px;
        }
    </style>
</head>

<body>

<?php include("../admin_header.php"); ?>
<?php include("../admin_sidebar.php"); ?>

<div class="main-content">

    <h2>Package Report</h2>

    <?php
    /* ==============================
       DISPLAY FUNCTION
    ============================== */
    function displayPackages($data) {
        if (count($data) == 0) {
            echo "<p>No Records Found</p>";
            return;
        }

        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Package Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Created On</th>
                </tr>";

        foreach ($data as $row) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['package_name']}</td>
                    <td>{$row['description']}</td>
                    <td>₹{$row['price']}</td>
                    <td>".date("d-m-Y", strtotime($row['created_at']))."</td>
                  </tr>";
        }

        echo "</table>";
    }
    ?>

    <!-- TODAY -->
    <h3>Today's Packages</h3>
    <?php displayPackages($today_data); ?>

    <!-- YESTERDAY -->
    <h3>Yesterday's Packages</h3>
    <?php displayPackages($yesterday_data); ?>

    <!-- HISTORY -->
    <h3>Previous Packages</h3>
    <?php displayPackages($old_data); ?>

</div>

<?php include("../admin_footer.php"); ?>

</body>
</html>