<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}

switch ($_SESSION["role"]) {
    case "admin":
        header("Location: admin/index.php");
        break;
    case "intern":
        header("Location: intern/index.php");
        break;
    default:
        echo "Invalid role!";
}
?>
