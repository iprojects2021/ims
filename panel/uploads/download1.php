<?php
// File: ims/panel/uploads/download1.php

// Ensure the file parameter is set
if (!isset($_GET['file'])) {
    die("Error: File not specified.");
}

// Sanitize filename to prevent directory traversal
$filename = basename($_GET['file']);

// Build the file path (same directory as this script)
$filePath = __DIR__ . '/' . $filename;

// Check if the file exists
if (!file_exists($filePath)) {
    die("Error: File does not exist.");
}

// Set headers to download the file
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));

// Output the file
flush();
readfile($filePath);
exit;
?>
