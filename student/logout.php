<?php
session_start();
session_unset();
session_destroy();

// Redirect to login.php inside same folder
header("Location: ../student/login.php");
exit();
?>
