<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "indsac_internship"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Check if a file has been uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageSize = $image['size'];
        $imageError = $image['error'];

        // Get the file extension
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
        $imageExt = strtolower($imageExt); // Convert to lowercase to handle extensions case-insensitively

        // Allowed file extensions
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageExt, $allowedExt)) {
            // Check file size (5MB max)
            if ($imageSize <= 5000000) {
                // Create a unique name for the image
                $newImageName = uniqid('', true) . "." . $imageExt;
                $uploadDir = 'uploads/'; // Directory to store uploaded images
                $imagePath = $uploadDir . $newImageName;

                // Move the image to the server directory
                if (move_uploaded_file($imageTmpName, $imagePath)) {
                    // Save the image path in the database
                    $sql = "INSERT INTO users (image_path) VALUES (?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $imagePath);

                    if ($stmt->execute()) {
                        echo "Image uploaded and saved in database successfully!";
                    } else {
                        echo "Error saving image path to database.";
                    }
                    $stmt->close();
                } else {
                    echo "Error moving the uploaded file.";
                }
            } else {
                echo "File size exceeds 5MB.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "No file was uploaded.";
    }
}

$conn->close();
?>
