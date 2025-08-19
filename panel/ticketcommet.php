<?php
include("../includes/db.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION["user"])) {
    header("Location: ../student/login.php");
    exit();
}

// Get current student/user ID
$iddata = $_SESSION["user"]["id"];
$createdBy = $iddata; // Assuming student created the ticket

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ticketid = trim($_POST["ticketid"]);
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

    // Prepare SQL statement
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
      echo '<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-check"></i> Alert!</h5>
      Data saved successfully
    </div>';
    echo '<script type="text/javascript">
    setTimeout(function() {
        window.location.href = "adminticketdetails.php?id=' . $ticketid . '"; 
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
