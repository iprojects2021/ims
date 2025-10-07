<?php
include("../includes/db.php");
include("../panel/util/session.php");

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (!isset($_POST['answers']) || !is_array($_POST['answers'])) {
            throw new Exception("No answers submitted.");
        }

        $userid = $_SESSION['user']['id']; // Current user
        $status = "Submitted";
        $type   = "feedback";  // Feedback form type
        $createdBy = $userid;  // Who created notification

        // Begin transaction to ensure atomic inserts
        $db->beginTransaction();
        $allInserted = true;

        foreach ($_POST['answers'] as $questionid => $answer) {
            $stmt = $db->prepare("
                INSERT INTO evaluationfeedbackanswer
                (userid, status, type, questionid, answer)
                VALUES (:userid, :status, :type, :questionid, :answer)
            ");

            $success = $stmt->execute([
                ':userid' => $userid,
                ':status' => $status,
                ':type' => $type,
                ':questionid' => $questionid,
                ':answer' => is_array($answer) ? json_encode($answer) : $answer
            ]);

            if (!$success) {
                $allInserted = false;
                break;
            }
        }

        if ($allInserted) {
            // Insert notification for admin
            $notifSql = "
                INSERT INTO notification (userid, menu_item, isread, message, createdBy)
                VALUES ('admin', :menu_item, 0, :message, :createdBy)
            ";
            $notifStmt = $db->prepare($notifSql);
            $notifStmt->execute([
                ':menu_item' => 'feedback',
                ':message' => "New Feedback submitted by Student ID: " . $userid,
                ':createdBy' => $createdBy
            ]);

            $db->commit();

            echo "
            <div id='statusContainer' style='position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
                        z-index: 1050; width: 400px; max-width: 90%;'>
                <div class='alert alert-success alert-dismissible fade show' role='alert' 
                    style='box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
                           background: linear-gradient(90deg, #4CAF50, #81C784); 
                           color: white; 
                           font-weight: bold;'>
                    Feedback Submitted Successfully
                </div>
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = 'evaluations.php';
                }, 1000);
            </script>
            ";
        } else {
            $db->rollBack();
            throw new Exception("Error submitting some feedback answers.");
        }
    }
} catch (Exception $e) {
    // Error response
    echo "
    <div class='alert alert-danger' role='alert'>
        Error: " . htmlspecialchars($e->getMessage()) . "
    </div>
    ";
}
?>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
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
