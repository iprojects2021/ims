<?php
include("../includes/db.php");
include("../panel/util/session.php");
include("../panel/util/statuscolour.php");

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userid =$_SESSION['user']['id'];
        $question = $_POST['question'];
        $questiontype = $_POST['questiontype'];
        $category = $_POST['category'] ?? null;
        $ans1 = $_POST['ans1'] ?? null;
        $ans2 = $_POST['ans2'] ?? null;
        $ans3 = $_POST['ans3'] ?? null;
        $ans4 = $_POST['ans4'] ?? null;
        $textans = $_POST['textans'] ?? null;
        $status = $_POST['status'];
        $ratemax = $_POST['ratemax'] ?? null;


        $stmt = $db->prepare("INSERT INTO questions (userid, question, questiontype, category, ans1, ans2, ans3, ans4, textans, ratemax, status) 
        VALUES (:userid, :question, :questiontype, :category, :ans1, :ans2, :ans3, :ans4, :textans, :ratemax, :status)");

$stmt->execute([
':userid' => $userid,
':question' => $question,
':questiontype' => $questiontype,
':category' => $category,
':ans1' => $ans1,
':ans2' => $ans2,
':ans3' => $ans3,
':ans4' => $ans4,
':textans' => $textans,
':ratemax' => $ratemax,
':status' => $status
]);

        echo "
        <div id='statusContainer' style='position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 1050; width: 400px; max-width: 90%;'>
            <div class='alert alert-success alert-dismissible fade show' role='alert' id='statusAlert' 
                style='box-shadow: 0 2px 10px rgba(0,0,0,0.1); 
                       background: linear-gradient(90deg, #4CAF50, #81C784); 
                       color: white; 
                       font-weight: bold;'>
                Question Added Successfully
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'adminevaluations.php';
            }, 1000);
        </script>
        ";
        

        // echo "<script>alert('Question added successfully');window.location.href='your_page.php';</script>";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
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
