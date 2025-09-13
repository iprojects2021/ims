<?php
include("../includes/db.php");
include("../panel/util/session.php");

// Get current student/user ID
$iddata = $_SESSION["user"]["id"];
$createdBy = $iddata; // Assuming student created the ticket

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $taskid = trim($_POST["taskid"]);
    $message = trim($_POST["message"]);

    $result = false;  // Initialize here

    try {
        // Prepare SQL statement
        $sql = "INSERT INTO taskcommit
                (taskid, message, createdate, createdby)
                VALUES (:taskid, :message, NOW(), :createdby)";
        $stmt = $db->prepare($sql);

        $result = $stmt->execute([
            ':taskid' => $taskid,
            ':message' => $message,
            ':createdby' => $createdBy
        ]);
    } catch (Exception $e) {
        $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - ' . $sql . ' ,Exception Error = ' . $e->getMessage());
    }

    if ($result) {
        echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data saved successfully
              </div>';
        echo '<script type="text/javascript">
                setTimeout(function() {
                    window.location.href = "studenttaskcommit.php?id=' . htmlspecialchars($taskid) . '"; 
                }, 2000); // Redirect after 2 seconds
              </script>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-times"></i> Error!</h5>
                There was an error updating the data.
              </div>';
    }
}
?>
