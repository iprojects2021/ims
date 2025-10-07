<?php
include("../includes/db.php");
include("../panel/util/session.php");

$stmt = $db->query("SELECT * FROM questions WHERE status='active' ORDER BY createdate ASC");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($questions);
?>