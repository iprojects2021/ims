<?php
include("../includes/db.php");
include("../panel/util/encryptdecrypt.php");
include("../panel/util/session.php");

// Get current student/user ID
$iddata = $_SESSION["user"]["id"];
$createdBy = $iddata; // Assuming student created the ticket

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ticketid = trim($_POST["ticketid"]);
    $key = bin2hex(random_bytes(32));  // 32 bytes = 256 bits
    $encrypted_ticketid = encrypt($ticketid, $key);
    $message = trim($_POST["message"]);

    $filename = null;

    // Handle file upload if a file was uploaded
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
        $uploadDir = "../uploads/tickets/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $originalName = basename($_FILES["file"]["name"]);
        $filename = time() . "_" . preg_replace("/[^a-zA-Z0-9\._-]/", "_", $originalName); // sanitize filename
        $targetPath = $uploadDir . $filename;

        if (!move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {
            echo "<div class='alert alert-danger'>Failed to upload file.</div>";
            exit();
        }
    }

    // Prepare SQL statement to insert ticket comment
    $stmt = $db->prepare("INSERT INTO ticketcomment 
        (ticketid, message, filename, createdate, createdby)
        VALUES
        (:ticketid, :message , :filename, NOW(), :createdby)
    ");

    $result = $stmt->execute([
        ':ticketid' => $ticketid,
        ':message' => $message,
        ':filename' => $filename,
        ':createdby' => $createdBy
    ]);

    if ($result) {
        // ✅ Notification setup
        $menuItem = 'help';
        $notificationMessage = "Ticket Updated By Admin";
        $recipient = 'admin'; // You can replace this with dynamic logic to notify specific users
        $createdBy = $changed_by;

        try {
            $notifSql = "INSERT INTO notification (userid, menu_item, isread, message, createdBy) 
                         VALUES (:userid, :menu_item, 0, :message, :createdBy)";
            $notifStmt = $db->prepare($notifSql);
            $notifStmt->execute([
                ':userid' => $recipient,
                ':menu_item' => $menuItem,
                ':message' => $notificationMessage,
                ':createdBy' => $createdBy
            ]);
           // print_r($notifStmt);die;
        } catch (Exception $e) {
            $logger->log('ERROR', 'Notification Insert Failed: ' . $e->getMessage());
        }

        // ✅ Success alert and redirect
        echo '
        <div style="position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 1050; width: 400px; max-width: 90%;">
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="statusAlert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                Status updated successfully.
            </div>
        </div>
        <script type="text/javascript">
            setTimeout(function() {
                window.location.href = "adminticketdetails.php?id=' . $ticketid . '";
            }, 2000);
        </script>';
    } else {
        // ❌ Failure alert
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="statusAlert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-times"></i> Error!</h5>
                There was an error updating the data.
              </div>';
    }
}
?>
