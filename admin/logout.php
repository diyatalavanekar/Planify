<?php
session_start();

/* Cache prevention */
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

/* Destroy session */
session_unset();
session_destroy();

/* Redirect */
header("Location: admin_login.php");
exit();
?>
