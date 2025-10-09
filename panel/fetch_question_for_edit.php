<?php
include("../includes/db.php");
include("../panel/util/session.php");
$id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM questions WHERE id = ?");
$stmt->execute([$id]);
echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
?>
