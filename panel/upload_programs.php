<?php
include("../includes/db.php");
include("../panel/util/session.php");
include("../vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\IOFactory;



// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['program_file']) ) {
    $file = $_FILES['program_file']['tmp_name'];

    try {
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Skip the header row
        $header = array_shift($rows);

        $sql = "INSERT INTO programs (
            title, slug, short_description, detailed_description, duration,
            start_date, end_date, is_remote, location, timezone,
            stipend_amount, stipend_currency, is_paid, application_deadline,
            max_applicants, is_active, SuperProgram, status, programtype, amount, mentorid
        ) VALUES (
            :title, :slug, :short_description, :detailed_description, :duration,
            :start_date, :end_date, :is_remote, :location, :timezone,
            :stipend_amount, :stipend_currency, :is_paid, :application_deadline,
            :max_applicants, :is_active, :SuperProgram, :status, :programtype, :amount, :mentorid
        )";

        $stmt = $db->prepare($sql);

        foreach ($rows as $row) {
            $stmt->execute([
                ':title' => $row[0],
                ':slug' => $row[1],
                ':short_description' => $row[2],
                ':detailed_description' => $row[3],
                ':duration' => $row[4],
                ':start_date' => $row[5],
                ':end_date' => $row[6] ?: null,
                ':is_remote' => $row[7] ?: 0,
                ':location' => $row[8],
                ':timezone' => $row[9],
                ':stipend_amount' => $row[10] ?: null,
                ':stipend_currency' => $row[11] ?: 'USD',
                ':is_paid' => $row[12] ?: 0,
                ':application_deadline' => $row[13] ?: null,
                ':max_applicants' => $row[14] ?: null,
                ':is_active' => $row[15] ?: 1,
                ':SuperProgram' => $row[16],
                ':status' => $row[17],
                ':programtype' => $row[18],
                ':amount' => $row[19],
                ':mentorid' => $row[20]

            ]);  
        }

        //echo "Programs imported successfully!";
        echo '
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            Programs imported successfully
        </div>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "admin_addprogrms.php";
        }, 3000);
    </script>
';

    } catch (Exception $e) {
        echo "Error processing file: " . $e->getMessage();
    }
} else {
    echo "No file uploaded.";
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

