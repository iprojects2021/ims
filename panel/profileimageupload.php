<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Image</title>
</head>
<body>
    <h2>Upload Profile Image</h2>
    <form action="upload_profile_image.php" method="POST" enctype="multipart/form-data">
        
        <label for="profileImage">Select Image:</label>
        <input type="file" name="profileImage" id="profileImage" required><br><br>

        <input type="submit" value="Upload">
    </form>
</body>
</html>
