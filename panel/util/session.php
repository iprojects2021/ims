<?php
include(__DIR__ . '/PdoSessionHandler.php');
// Use the custom session handler
$handler = new PdoSessionHandler($db);

session_set_save_handler($handler, true);

session_start();
// Check if user session exists and name is not empty
if (
    !isset($_SESSION["user"]) || 
    !isset($_SESSION["user"]["name"]) || 
    trim($_SESSION["user"]["name"]) === ''
) {
    // Redirect to login page
    header("Location: ../student/login.php"); // Update this path as needed
    exit();
}
?>