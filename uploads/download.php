<?php
// Check if the 'file' parameter is present in the URL
if (isset($_GET['file'])) {
    // Get the filename from the query string and sanitize it
    $file = basename($_GET['file']);  // basename to prevent directory traversal
    $filePath = "../uploads/tickets/" . $file; // Define the path to the file

    // Check if the file exists
    if (file_exists($filePath)) {
        // Optional: Add authentication/authorization checks here to ensure the user can access the file

        // Set headers to force a download (this prevents browser from rendering the file)
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream'); // Default content type for binary files
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath)); // Set content length header

        // Read the file and output it to the browser
        readfile($filePath);
        exit;
    } else {
        // File doesn't exist
        echo "File not found.";
    }
} else {
    // No file parameter specified
    echo "No file specified.";
}
?>
