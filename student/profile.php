<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['users_id'])) {
    echo "Unauthorized";
    exit;
}

$student_id = $_SESSION['users_id'];

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if ($student):
?>
    <h2>Student Profile</h2>
    <p><strong>Name:</strong> <?= htmlspecialchars($student['full_name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
    <p><strong>Course:</strong> <?= htmlspecialchars($student['course']) ?></p>
<?php else: ?>
    <p>No profile data found.</p>
<?php endif; ?>
