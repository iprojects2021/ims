<?php
$host = "localhost";
$port = 3307; // or 3306 if default
$user = "root";
$pass = "";
$dbname = "internship_db";

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
