<?php
session_start();
include('../includes/db.php'); // Make sure this includes PDO connection $pdo
header('Content-Type: application/json'); // Important: force JSON output


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicationid = $_POST['applicationid'] ?? null;
    $userid        = $_POST['userid'] ?? null;
    $oldstatus     = $_POST['oldstatus'] ?? '';
    $newstatus     = $_POST['newstatus'] ?? '';
    $remarks       = $_POST['remarks'] ?? '';

    if (!$applicationid || !$userid || !$newstatus) {
        echo json_encode(['success' => false, 'message' => 'Required fields are missing.']);
        exit;
    }

    try {
        $stmt = $db->prepare("INSERT INTO applicationstatus (applicationid, userid, oldstatus, newstatus, remarks) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$applicationid, $userid, $oldstatus, $newstatus, $remarks]);

        // Optionally update the current status in the main application table
        $updateApp = $db->prepare("UPDATE application SET status = ? WHERE id = ?");
        $updateApp->execute([$newstatus, $applicationid]);

        echo json_encode(['success' => true, 'message' => 'Status updated successfully.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>
