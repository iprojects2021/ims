<?php
// Base directory where the files are stored
$baseDir = realpath(__DIR__ . '/../../uploads/ideas');

if (!empty($_GET['file'])) {
    // Get file parameter and sanitize it
    $file = basename($_GET['file']); // prevents directory traversal

    $filePath = $baseDir . DIRECTORY_SEPARATOR . $file;

    // Check if file exists and is inside the base directory
    if (file_exists($filePath) && strpos(realpath($filePath), $baseDir) === 0) {
        // Send headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush();
        readfile($filePath);
        exit;
    } else {
        http_response_code(404);
        echo "File not found.";
    }
} else {
    http_response_code(400);
    echo "No file specified.";
}
?>
