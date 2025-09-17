<?php
if (isset($_GET['file'])) {
    $filename = basename($_GET['file']); // security
    $filepath = __DIR__ . '/' . $filename;

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
}
?>
