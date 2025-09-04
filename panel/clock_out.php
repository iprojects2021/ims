<?php
include("../includes/db.php");
include("../panel/util/session.php");

$userid = $_SESSION['user']['id'];

try {
    // Ensure there's a clock-in today with no clock-out
    $sql = "SELECT id FROM userattendance 
            WHERE userid = :userid 
              AND DATE(logintime) = CURDATE()
              AND logouttime IS NULL
            ORDER BY logintime DESC 
            LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();
    $attendance = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$attendance) {
        echo json_encode(["status" => "error", "message" => "You have not clocked in today or already clocked out."]);
        exit;
    }

    // Update logout time
    $sql = "UPDATE userattendance 
            SET logouttime = NOW() 
            WHERE id = :id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $attendance['id'], PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Clock-out successful."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to clock out."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
