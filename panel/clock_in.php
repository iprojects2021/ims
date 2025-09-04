<?php
include("../includes/db.php");
include("../panel/util/session.php");

$userid = $_SESSION['user']['id'];

try {
    // Check if user already clocked in today
    $sql = "SELECT COUNT(*) FROM userattendance 
            WHERE userid = :userid AND DATE(logintime) = CURDATE()";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();
    $alreadyClockedIn = $stmt->fetchColumn();

    if ($alreadyClockedIn > 0) {
        echo json_encode(["status" => "error", "message" => "You have already clocked in today."]);
        exit;
    }

    // Insert new clock-in
    $sql = "INSERT INTO userattendance (userid, logintime) VALUES (:userid, NOW())";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Clock-in successful."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to clock in."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
