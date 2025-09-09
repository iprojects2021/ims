<?php
include("../includes/db.php");
include("../panel/util/session.php");
include("../panel/util/statuscolour.php");

$editprogramsdata = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['program_id']) && !isset($_POST['title'])) {
        // STEP 1: Just show the edit form for the selected program
        $id = $_POST['program_id'];
        try {
            $sql = "SELECT * FROM programs WHERE program_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            $editprogramsdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Log or handle DB error
        }
    } elseif (isset($_POST['title'], $_POST['slug'], $_POST['program_id'])) {
        // STEP 2: Handle the form submission and update the DB

        // Sanitize inputs
        $id = $_POST['program_id'];
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $short_description = $_POST['short_description'];
        $detailed_description = $_POST['detailed_description'];
        $duration = $_POST['duration'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $is_remote = $_POST['is_remote'];
        $location = $_POST['location'];
        $timezone = $_POST['timezone'];
        $stipend_amount = $_POST['stipend_amount'];
        $stipend_currency = $_POST['stipend_currency'];
        $is_paid = $_POST['is_paid'];
        $application_deadline = $_POST['application_deadline'];
        $max_applicants = $_POST['max_applicants'];
        $is_active = $_POST['is_active'];

        try {
            $sql = "UPDATE programs SET 
                        title = ?, slug = ?, short_description = ?, detailed_description = ?, 
                        duration = ?, start_date = ?, end_date = ?, is_remote = ?, 
                        location = ?, timezone = ?, stipend_amount = ?, stipend_currency = ?, 
                        is_paid = ?, application_deadline = ?, max_applicants = ?, is_active = ?
                    WHERE program_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $title, $slug, $short_description, $detailed_description,
                $duration, $start_date, $end_date, $is_remote,
                $location, $timezone, $stipend_amount, $stipend_currency,
                $is_paid, $application_deadline, $max_applicants, $is_active,
                $id
            ]);
            $showAlert = 'success';

            // Reload updated program data to fill form with new values
            $sql = "SELECT * FROM programs WHERE program_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            $editprogramsdata = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            echo "Update failed: " . $e->getMessage();
        }
    } else {
        echo "Invalid request.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Portal | INDSAC SOFTECH</title>
  <link rel="icon" type="image/png" href="../favico.png">

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
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include("leftmenu.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Programs</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
        <!-- AdminLTE Card Wrapper -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Program</h3>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <?php if (!empty($editprogramsdata) && is_array($editprogramsdata)): ?>
            <form method="post">
              <div class="card-body">
                <div class="row">
                  <?php foreach ($editprogramsdata as $row): ?>
                    <!-- Hidden program_id field (important for update) -->
                    <input type="hidden" name="program_id" value="<?= htmlspecialchars($row['program_id']) ?>">

                    <div class="col-md-6 mb-2">
                      <label for="title" class="form-label">Program Title</label>
                      <input type="text" class="form-control form-control-sm" id="title" value="<?= htmlspecialchars($row['title']) ?>" name="title" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="slug" class="form-label">Slug</label>
                      <input type="text" class="form-control form-control-sm" id="slug" value="<?= htmlspecialchars($row['slug']) ?>" name="slug" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="short_description" class="form-label">Short Description</label>
                      <input type="text" class="form-control form-control-sm" id="short_description" value="<?= htmlspecialchars($row['short_description']) ?>" name="short_description" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="duration" class="form-label">Duration</label>
                      <input type="text" class="form-control form-control-sm" id="duration" value="<?= htmlspecialchars($row['duration']) ?>" name="duration" required>
                    </div>

                    <div class="col-md-12 mb-2">
                      <label for="detailed_description" class="form-label">Detailed Description</label>
                      <textarea class="form-control form-control-sm" id="detailed_description" name="detailed_description" rows="3" required><?= htmlspecialchars($row['detailed_description']) ?></textarea>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="start_date" class="form-label">Start Date</label>
                      <input type="date" class="form-control form-control-sm" id="start_date" value="<?= htmlspecialchars($row['start_date']) ?>" name="start_date" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="end_date" class="form-label">End Date</label>
                      <input type="date" class="form-control form-control-sm" id="end_date" value="<?= htmlspecialchars($row['end_date']) ?>" name="end_date" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="is_remote" class="form-label">Is Remote</label>
                      <select class="form-control form-control-sm" id="is_remote" name="is_remote" required>
                        <option value="1" <?= $row['is_remote'] == '1' ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= $row['is_remote'] == '0' ? 'selected' : '' ?>>No</option>
                      </select>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="location" class="form-label">Location</label>
                      <input type="text" class="form-control form-control-sm" id="location" value="<?= htmlspecialchars($row['location']) ?>" name="location" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="timezone" class="form-label">Time Zone</label>
                      <input type="text" class="form-control form-control-sm" id="timezone" value="<?= htmlspecialchars($row['timezone']) ?>" name="timezone" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="stipend_amount" class="form-label">Stipend Amount</label>
                      <input type="number" class="form-control form-control-sm" id="stipend_amount" value="<?= htmlspecialchars($row['stipend_amount']) ?>" name="stipend_amount" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="stipend_currency" class="form-label">Stipend Currency</label>
                      <input type="text" class="form-control form-control-sm" id="stipend_currency" value="<?= htmlspecialchars($row['stipend_currency']) ?>" name="stipend_currency" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="is_paid" class="form-label">Is Paid</label>
                      <select class="form-control form-control-sm" id="is_paid" name="is_paid" required>
                        <option value="1" <?= $row['is_paid'] == '1' ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= $row['is_paid'] == '0' ? 'selected' : '' ?>>No</option>
                      </select>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="application_deadline" class="form-label">Application Deadline</label>
                      <input 
                        type="date" 
                        class="form-control form-control-sm" 
                        id="application_deadline" 
                        value="<?= htmlspecialchars(date('Y-m-d', strtotime($row['application_deadline']))) ?>" 
                        name="application_deadline" 
                        required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="max_applicants" class="form-label">Max Applicants</label>
                      <input type="number" class="form-control form-control-sm" id="max_applicants" value="<?= htmlspecialchars($row['max_applicants']) ?>" name="max_applicants" required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="is_active" class="form-label">Is Active</label>
                      <select class="form-control form-control-sm" id="is_active" name="is_active" required>
                        <option value="1" <?= $row['is_active'] == '1' ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= $row['is_active'] == '0' ? 'selected' : '' ?>>No</option>
                      </select>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="card-footer text-end">
                <button type="submit" class="btn btn-sm btn-primary">Submit Program</button>
              </div>
            </form>
          <?php else: ?>
            <!-- You can add a message here like "Select a program to edit" -->
          <?php endif; ?>

        </div>
        <!-- /.card -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
<?php include("../panel/util/alert.php");?>
</body>
</html>
