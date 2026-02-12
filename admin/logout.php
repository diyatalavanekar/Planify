<?php
session_start();

session_unset();
session_destroy();

/* Prevent caching */
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

header("Location: admin_login.php");
exit();
