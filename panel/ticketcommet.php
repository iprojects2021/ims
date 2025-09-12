<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
    $studentid = trim($_POST["studentid"]);
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
        $recipient =$studentid; // You can replace this with dynamic logic to notify specific users
        $createdBy =$_SESSION['user']['id'];

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
                 Success.
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
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>