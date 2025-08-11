<?php
$host = "localhost";
$port = 3306; // or 3306
$user = "root";
$pass = "";
$dbname = "indsac_internship";
$uploadFolder ="upload";

try {
    $db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
