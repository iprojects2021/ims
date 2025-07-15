<?php
try {
    // Use port 3306 (default). If you're using 3307, update it accordingly.
    $db = new PDO("mysql:host=localhost;port=3307;dbname=internship_db", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
