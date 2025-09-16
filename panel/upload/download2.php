<?php
// Base directory is: panel/upload/resume/
$baseDir = realpath(__DIR__ . '/resume/');

// Get and sanitize file name
if (!isset($_GET['file'])) {
    http_response_code(400);
    exit('Missing file parameter.');
}

$filename = basename($_GET['file']); // Prevent path traversal
$filePath = realpath($baseDir . DIRECTORY_SEPARATOR . $filename);

// Optional: restrict allowed extensions
$allowedExtensions = ['pdf', 'doc', 'docx'];
$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
if (!in_array($ext, $allowedExtensions)) {
    http_response_code(403);
    exit('File type not allowed.');
}

// Validate path and file
if (!$filePath || strpos($filePath, $baseDir) !== 0 || !is_file($filePath)) {
    http_response_code(404);
    exit('File not found or access denied.');
}

// Send headers and output file
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));

ob_clean();
flush();
readfile($filePath);
exit;
