<?php
include '../includes/db.php';

$student_id = $_SESSION['student_id'];

$stmt = $conn->prepare("SELECT application_status FROM students WHERE id = ?");
$stmt->execute([$student_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$status = $row ? $row['application_status'] : 'Not Applied';

echo "<h2>Application Status</h2>";
echo "<p>Your application status is: <strong>" . htmlspecialchars($status) . "</strong></p>";
