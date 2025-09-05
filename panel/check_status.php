<?php
include("../includes/db.php");
include("../panel/util/session.php");

$userid = $_SESSION['user']['id'];

try {
    // Check if user has clocked in today
    $sql = "SELECT logintime, logouttime 
            FROM userattendance 
            WHERE userid = :userid 
              AND DATE(logintime) = CURDATE()
            ORDER BY logintime DESC 
            LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($record) {
        $clockedInToday = true;
        $clockedOutToday = !empty($record['logouttime']);
    } else {
        $clockedInToday = false;
        $clockedOutToday = false;
    }

    echo json_encode([
        "clockedInToday" => $clockedInToday,
        "clockedOutToday" => $clockedOutToday
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "clockedInToday" => false,
        "clockedOutToday" => false,
        "error" => $e->getMessage()
    ]);
}
?>
