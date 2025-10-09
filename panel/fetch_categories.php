<?php
include("../includes/db.php");
include("../panel/util/session.php");


try {

    $stmt = $db->query("SELECT DISTINCT category FROM questions WHERE category IS NOT NULL AND category <> '' ORDER BY category ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

    header('Content-Type: application/json');
    echo json_encode($categories);
} catch (Exception $e) {
    echo json_encode([]);
}
