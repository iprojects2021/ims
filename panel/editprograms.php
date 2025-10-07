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
        $status = $_POST['status'];
        $SuperProgram = $_POST['SuperProgram'];
 
        try {
            $sql = "UPDATE programs SET 
                        title = ?, slug = ?, SuperProgram = ?, short_description = ?, detailed_description = ?, 
                        duration = ?, start_date = ?, end_date = ?, is_remote = ?, 
                        location = ?, timezone = ?, stipend_amount = ?, stipend_currency = ?, 
                        is_paid = ?, application_deadline = ?, max_applicants = ?, is_active = ?, status = ?
                    WHERE program_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $title, $slug, $SuperProgram, $short_description, $detailed_description,
                $duration, $start_date, $end_date, $is_remote,
                $location, $timezone, $stipend_amount, $stipend_currency,
                $is_paid, $application_deadline, $max_applicants, $is_active, $status,
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
<?php
$stmt = $db->prepare("SELECT * FROM application WHERE program_id = :id");
$stmt->execute(['id' => $id]);
$applicationData = $stmt->fetchAll();
$totdalcount=count($applicationData);

$stmt = $db->prepare("SELECT * FROM programs WHERE program_id = :id");
$stmt->execute(['id' => $id]);
$programsdata = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Portal | INDSAC SOFTECH</title>
  <link rel="icon" type="image/png" href="../favico.png">

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css" />
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />
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
              <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a>
</li>
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
          <h3 class="card-title">
          <a data-bs-toggle="collapse" href="#editProgramForm" role="button" aria-expanded="false" aria-controls="editProgramForm" id="editProgramToggle">
    Edit Program- 
    <?php foreach ($editprogramsdata as $row): ?>
        <?= htmlspecialchars($row['title']) ?>
    <?php endforeach; ?>
    <i class="bi bi-chevron-down" id="editProgramIcon"></i>
</a>

</h3>
 </div>
          <!-- /.card-header -->
            <div class="collapse" id="editProgramForm">

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
                      <label for="superprogram" class="form-label">Super Program</label>
                      <input type="text" class="form-control form-control-sm" id="superprogram" value="<?= htmlspecialchars($row['SuperProgram']) ?>" name="SuperProgram" required>
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
                    <div class="col-md-6 mb-2">
                      <label for="status" class="form-label">Status</label>
                      <input type="text" class="form-control form-control-sm" id="status" value="<?= htmlspecialchars($row['status']) ?>" name="status" required>
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
        </div>
        <!-- /.card -->

      </div><!-- /.container-fluid -->
      <div class="row">
  <!-- Box 1 -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-light">
      <div class="inner">
        <h3><?php echo $totdalcount ?? '--'; ?></h3>
        <p>Total Student Count</p>
      </div>
      <div class="icon">
        <i class="fas fa-hourglass-half"></i>
      </div>
      <form action="application.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($app['email']); ?>">
        <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
          <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
            View Applications <i class="fas fa-arrow-circle-right"></i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Box 2 -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-light">
      <div class="inner">
        <h3><?php echo $applicationCount1 ?? '--'; ?></h3>
        <p>Total Completed Task</p>
      </div>
      <div class="icon">
        <i class="fas fa-hourglass-half"></i>
      </div>
      <form action="application.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($app['email']); ?>">
        <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
          <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
            View Applications <i class="fas fa-arrow-circle-right"></i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Box 3 -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-light">
      <div class="inner">
        <h3><?php echo $programsdata['mentorid'] ?? '--'; ?></h3>
        <p>Mentor Assigned</p>
      </div>
      <div class="icon">
        <i class="fas fa-hourglass-half"></i>
      </div>
      <form action="application.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($app['email']); ?>">
        <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
          <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
            View Applications <i class="fas fa-arrow-circle-right"></i>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Box 4 -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-light">
      <div class="inner">
        <h3></h3>
        <p>Start Date:<?php echo $programsdata['start_date'] ?? '--'; ?><br> Duration:<?php echo $programsdata['duration'] ?? '--'; ?><br>Program Status:<?php echo $programsdata['status'] ?? '--'; ?></p>
      </div>
      <div class="icon">
        <i class="fas fa-hourglass-half"></i>
      </div>
      <form action="application.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($app['email']); ?>">
        <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
          <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
            View Applications <i class="fas fa-arrow-circle-right"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="card">
          <div class="card-header">
            <h3 class="card-title">Student Details</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Program Id</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Project</th>
                  <th>Type</th>
                  <th>Excepted Start Date</th>
                  <th>Status</th>
                  <th>Create Date</th>
                  <th>Amount</th>
                  <th>Duration</th>
                  <th>Payment Verification Id</th>
                  <th>Mentor</th>
                  </tr>
              </thead>
              <tbody>
                <?php foreach ($applicationData as $row): ?>
                  <tr class="clickable-row" data-id="<?= (int)$row['id'] ?>">
                    <td><?= htmlspecialchars($row['program_id']) ?></td>
                    <td><?= htmlspecialchars($row['fullname'] ?? '') ?></td>
 <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['project']) ?></td>
                    <td><?= htmlspecialchars($row['type']) ?></td>
                    <td><?= htmlspecialchars($row['expected_start_date']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['createddate']) ?></td>
                    <td><?= htmlspecialchars($row['amount']) ?></td>
                    <td><?= htmlspecialchars($row['duration']) ?></td>
                    <td><?= htmlspecialchars($row['paymentverificationid']) ?></td>
                    <td><?= htmlspecialchars($row['mentorid']) ?></td>
                       </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                <th>Program Id</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Project</th>
                  <th>Type</th>
                  <th>Excepted Start Date</th>
                  <th>Status</th>
                  <th>Create Date</th>
                  <th>Amount</th>
                  <th>Duration</th>
                  <th>Payment Verification Id</th>
                  <th>Mentor</th>
                
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
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
<!-- jQuery (required by Bootstrap 4) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 4 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap 5 Bundle JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<?php include("../panel/util/alert.php");?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('editProgramToggle');
    const icon = document.getElementById('editProgramIcon');
    const collapseElement = document.getElementById('editProgramForm');

    collapseElement.addEventListener('show.bs.collapse', function () {
        icon.classList.remove('bi-chevron-down');
        icon.classList.add('bi-chevron-up');
    });

    collapseElement.addEventListener('hide.bs.collapse', function () {
        icon.classList.remove('bi-chevron-up');
        icon.classList.add('bi-chevron-down');
    });
});
</script>
<!-- JS Includes -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // Clickable rows redirect
    $('.clickable-row').on('click', function () {
      const id = $(this).data('id');
      $('<form>', {
        'method': 'POST',
        'action': 'admintypedetails.php'
      }).append($('<input>', {
        'type': 'hidden',
        'name': 'id',
        'value': id
      })).appendTo('body').submit();
    });
  });
</script>
<style>
  /* Hide the + icon cell if it somehow still appears */
  table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child::before,
  table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child::before {
    display: none !important;
  }

  /* Prevent the extra column for the + icon */
  table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child,
  table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child {
    padding-left: 8px !important;
  }
</style>


</body>
</html>
