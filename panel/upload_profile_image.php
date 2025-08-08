<?php
// MySQL database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "indsac_internship"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the file is uploaded successfully
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] == 0) {

        // File details
        $fileTmp = $_FILES['profileImage']['tmp_name'];
        $fileName = $_FILES['profileImage']['name'];
        $fileType = $_FILES['profileImage']['type'];
        $fileSize = $_FILES['profileImage']['size'];

        // Get file content (binary data)
        $fileData = file_get_contents($fileTmp);

        // Escape the data for insertion into the database
        $fileData = $conn->real_escape_string($fileData);

        // Get user name and email from the form
        
        // Insert user data and image into the database
       
        $useriddata=$_SESSION['user']['id'];
        $sql="UPDATE users SET profile_image=('$fileData') WHERE id=$useriddata";
        // Prepare the update query
        


        if ($conn->query($sql) === TRUE) {
            echo "Profile image uploaded and saved successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } else {
        echo "No file uploaded or there was an error during upload.";
    }
}

$conn->close();
?>
