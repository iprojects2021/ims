<?php
include("../includes/db.php");
include(__DIR__ . "/../panel/util/PdoSessionHandler.php");
// Use the custom session handler
$handler = new PdoSessionHandler($db);
session_set_save_handler($handler, true);

session_start();
session_unset();
session_destroy();

// Redirect to login.php inside same folder
header("Location: ../student/login.php");
exit();
?>
