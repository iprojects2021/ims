<?php
include("../includes/db.php");
include("../panel/util/session.php");


header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $applicationid = $_POST['applicationid'] ?? null;
        $userid = $_POST['userid'] ?? null;
        $payoutamount = $_POST['payoutamount'] ?? null;
        $payoutmethod = $_POST['payoutmethod'] ?? null;
        $payoutdetails = $_POST['payoutdetails'] ?? null;
        $transactionid = $_POST['transactionid'] ?? null;
        $createby = $_POST['createby'] ?? null;
        $notes = $_POST['notes'] ?? null;

        if (empty($applicationid) || empty($userid) || empty($payoutamount)) {
            echo json_encode(['status' => 'error', 'message' => 'Required fields missing.']);
            exit;
        }

        $sql = "INSERT INTO referralpaymentpayout 
                (applicationid, userid, payoutamount, payoutmethod, payoutdetails, transactionid, createby, notes) 
                VALUES 
                (:applicationid, :userid, :payoutamount, :payoutmethod, :payoutdetails, :transactionid, :createby, :notes)";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':applicationid' => $applicationid,
            ':userid' => $userid,
            ':payoutamount' => $payoutamount,
            ':payoutmethod' => $payoutmethod,
            ':payoutdetails' => $payoutdetails,
            ':transactionid' => $transactionid,
            ':createby' => $createby,
            ':notes' => $notes
        ]);

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
