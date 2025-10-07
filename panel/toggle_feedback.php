<?php
include("../includes/db.php");
include("../panel/util/session.php");

header('Content-Type: application/json');

$action = $_REQUEST['action'] ?? '';

if($action === 'get_status'){
    // Get overall status: if any row is enabled, show ON
    $stmt = $db->prepare("SELECT COUNT(*) as count_enabled FROM questions WHERE status='enabled feedback form'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['count_enabled'] > 0){
        echo json_encode(['status'=>'enabled feedback form']);
    } else {
        echo json_encode(['status'=>'disabled feedback form']);
    }
    exit;
}

if($action === 'toggle_all'){
    // Determine new status
    $stmt = $db->prepare("SELECT COUNT(*) as count_enabled FROM questions WHERE status='enabled feedback form'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $new_status = ($row['count_enabled'] > 0) ? 'disabled feedback form' : 'enabled feedback form';

    // Update all rows
    $stmtUpdate = $db->prepare("UPDATE questions SET status = :new_status");
    $stmtUpdate->execute([':new_status'=>$new_status]);

    echo json_encode(['status'=>$new_status]);
    exit;
}
