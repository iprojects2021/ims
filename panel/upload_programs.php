<?php
include("../includes/db.php");
include("../panel/util/session.php");

try {
    if (!isset($_FILES['program_file'])) {
        die("❌ No file received in \$_FILES.");
    }

    if ($_FILES['program_file']['error'] !== UPLOAD_ERR_OK) {
        die("❌ Upload error code: " . $_FILES['program_file']['error']);
    }

    $fileTmpPath = $_FILES['program_file']['tmp_name'];
    $fileName    = $_FILES['program_file']['name'];

    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileExtension !== 'csv') {
        die("❌ Only CSV files are allowed.");
    }

    if (($handle = fopen($fileTmpPath, "r")) !== false) {
        // Skip header row
        fgetcsv($handle);

        $stmtInsert = $db->prepare("
            INSERT INTO programs (
                title, slug, short_description, detailed_description, duration,
                start_date, end_date, is_remote, location, timezone, stipend_amount,
                stipend_currency, is_paid, application_deadline, max_applicants,
                is_active, SuperProgram, status, programtype, amount, mentorid
            ) VALUES (
                :title, :slug, :short_description, :detailed_description, :duration,
                :start_date, :end_date, :is_remote, :location, :timezone, :stipend_amount,
                :stipend_currency, :is_paid, :application_deadline, :max_applicants,
                :is_active, :SuperProgram, :status, :programtype, :amount, :mentorid
            )
        ");

        $stmtCheck = $db->prepare("
            SELECT COUNT(*) FROM programs WHERE title = :title AND status = 'upcoming'
        ");

        $insertedCount = 0;
        $skippedCount = 0;
        $skippedTitles = [];

        while (($row = fgetcsv($handle, 1000, ",")) !== false) {

            $title = trim($row[0] ?? '');
            $status = strtolower(trim($row[17] ?? 'upcoming'));

            if ($title === '') continue; // skip empty titles

            // Check for duplicates
            $stmtCheck->execute([':title' => $title]);
            if ($stmtCheck->fetchColumn() > 0 && $status === 'upcoming') {
                $skippedCount++;
                $skippedTitles[] = $title;
                continue; // skip this row
            }

            $data = [
                ':title'                => $title,
                ':slug'                 => $row[1] ?? null,
                ':short_description'    => $row[2] ?? null,
                ':detailed_description' => $row[3] ?? null,
                ':duration'             => $row[4] ?? null,
                ':start_date'           => $row[5] ?? null,
                ':end_date'             => $row[6] ?? null,
                ':is_remote'            => $row[7] ?? 1,
                ':location'             => $row[8] ?? null,
                ':timezone'             => $row[9] ?? null,
                ':stipend_amount'       => $row[10] ?? null,
                ':stipend_currency'     => $row[11] ?? "USD",
                ':is_paid'              => $row[12] ?? 0,
                ':application_deadline' => $row[13] ?? null,
                ':max_applicants'       => $row[14] ?? null,
                ':is_active'            => $row[15] ?? 1,
                ':SuperProgram'         => $row[16] ?? null,
                ':status'               => $status,
                ':programtype'          => $row[18] ?? null,
                ':amount'               => $row[19] ?? null,
                ':mentorid'             => $row[20] ?? null,
            ];

            $stmtInsert->execute($data);
            $insertedCount++;
        }

        fclose($handle);

        // Show result message
        $message = "$insertedCount program(s) imported successfully.";
        if ($skippedCount > 0) {
            $message .= " $skippedCount duplicate program(s) were skipped: " . implode(", ", $skippedTitles);
            $alertClass = "alert-warning";
        } else {
            $alertClass = "alert-success";
        }

        echo "
        <div id='statusContainer' style='position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 1050; width: 400px; max-width: 90%;'>
            <div class='alert $alertClass alert-dismissible fade show' role='alert' id='statusAlert' style='box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>
                $message
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'admin_addprogrms.php';
            }, 5000);
        </script>
        ";

    } else {
        die("❌ Error reading the uploaded CSV file.");
    }

} catch (PDOException $e) {
    echo "
    <div id='statusContainer' style='position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
        z-index: 1050; width: 400px; max-width: 90%;'>
        <div class='alert alert-danger alert-dismissible fade show' role='alert' id='statusAlert' style='box-shadow: 0 2px 10px rgba(0,0,0,0.1);'>
            Database error: " . htmlspecialchars($e->getMessage()) . "
        </div>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'admin_addprogrms.php';
        }, 5000);
    </script>
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

