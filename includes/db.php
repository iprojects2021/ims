<?php
$url="http://localhost/ims/student/register.php?referral=";
$host = "localhost";
$port = 3306; // or 3306
$user = "root";
$pass = "";
$dbname = "internship_db";
$uploadFolder ="upload";

try {
    $db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
