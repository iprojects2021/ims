<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "indsac_internship"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
// Query to fetch the profile image
$useriddata=$_SESSION['user']['id'];

$sql = "SELECT profile_image FROM users WHERE id =$useriddata";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Set the content type to the correct image format
    header("Content-Type: image/jpeg");
    echo $row['profile_image']; // Output the image data
} else {
    echo "No image found.";
}

$conn->close();
?>
