<?php
include("../includes/db.php");
include("../panel/util/session.php");

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $userid = $_SESSION['user']['id']; // from session
        $status = "Submitted";
        $type   = "feedback"; // feedback form type
        $createdBy = $userid;   // who created the notification

        $insertSuccess = false;

        // loop through answers
        foreach ($_POST['answers'] as $questionid => $answer) {
            $stmt = $db->prepare("INSERT INTO evaluationfeedbackanswer
                (userid, status, type, questionid, answer, attendance_score, quality_score, technical_score, communication_score, initiative_score, teamwork_score, overall_score, comments, improvement_suggestions)
                VALUES (:userid, :status, :type, :questionid, :answer, :attendance_score, :quality_score, :technical_score, :communication_score, :initiative_score, :teamwork_score, :overall_score, :comments, :improvement_suggestions)");

            $insertSuccess = $stmt->execute([
                ':userid' => $userid,
                ':status' => $status,
                ':type'   => $type,
                ':questionid' => $questionid,
                ':answer' => is_array($answer) ? json_encode($answer) : $answer, 
                ':attendance_score' => $_POST['attendance_score'] ?? null,
                ':quality_score' => $_POST['quality_score'] ?? null,
                ':technical_score' => $_POST['technical_score'] ?? null,
                ':communication_score' => $_POST['communication_score'] ?? null,
                ':initiative_score' => $_POST['initiative_score'] ?? null,
                ':teamwork_score' => $_POST['teamwork_score'] ?? null,
                ':overall_score' => $_POST['overall_score'] ?? null,
                ':comments' => $_POST['comments'] ?? null,
                ':improvement_suggestions' => $_POST['improvement_suggestions'] ?? null,
            ]);
        }

        // If feedback insertion was successful, add notification
        if ($insertSuccess) {
            $menuItem = 'feedback';
            $notificationMessage = "New Feedback submitted by Student ID: " . $userid;

            try {
                $notifSql = "INSERT INTO notification (userid, menu_item, isread, message, createdBy) 
                             VALUES ('admin', :menu_item, 0, :message, :createdBy)";
                $notifStmt = $db->prepare($notifSql);
                $notifStmt->execute([
                    ':menu_item' => $menuItem,
                    ':message' => $notificationMessage,
                    ':createdBy' => $createdBy
                ]);
            } catch (Exception $e) {
                // Log error if you have logger
                // $logger->log('ERROR', 'Notification Insert Failed: ' . $e->getMessage());
            }
        }

        // Success message
        echo "
        <div id='statusContainer' style='position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 1050; width: 400px; max-width: 90%;'>
            <div class='alert alert-success alert-dismissible fade show' role='alert' id='statusAlert' 
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
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
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
