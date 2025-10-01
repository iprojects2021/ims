<?php
include("../includes/db.php");
include("../panel/util/session.php");

// Fetch all applications
$stmt = $db->prepare("SELECT * FROM questions");
$stmt->execute();
$allquestionslist = $stmt->fetchAll();

// Handle form submission
$showAlert = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1️⃣ Check if a program with the same title and status 'upcoming' already exists
    $checkStmt = $db->prepare("SELECT COUNT(*) FROM programs WHERE title = :title AND status = 'upcoming'");
    $checkStmt->execute([':title' => $_POST['title']]);
    $exists = $checkStmt->fetchColumn();

    if ($exists > 0) {
        // Program exists, don't insert
        $showAlert = 'duplicate';
    } else {
        // 2️⃣ Insert new program
        $stmt = $db->prepare("INSERT INTO programs (
            title, slug, short_description, detailed_description, duration,
            start_date, end_date, is_remote, location, timezone,
            stipend_amount, stipend_currency, is_paid,
            application_deadline, max_applicants, is_active, status, mentorid, SuperProgram
        ) VALUES (
            :title, :slug, :short_description, :detailed_description, :duration,
            :start_date, :end_date, :is_remote, :location, :timezone,
            :stipend_amount, :stipend_currency, :is_paid,
            :application_deadline, :max_applicants, :is_active, :status, :mentorid, :SuperProgram
        )");

        $stmt->execute([
            ':title' => $_POST['title'],
            ':slug' => $_POST['slug'],
            ':short_description' => $_POST['short_description'],
            ':detailed_description' => $_POST['detailed_description'],
            ':duration' => $_POST['duration'],
            ':start_date' => $_POST['start_date'],
            ':end_date' => $_POST['end_date'],
            ':is_remote' => $_POST['is_remote'],
            ':location' => $_POST['location'],
            ':timezone' => $_POST['timezone'],
            ':stipend_amount' => $_POST['stipend_amount'],
            ':stipend_currency' => $_POST['stipend_currency'],
            ':is_paid' => $_POST['is_paid'],
            ':application_deadline' => $_POST['application_deadline'],
            ':max_applicants' => $_POST['max_applicants'],
            ':is_active' => $_POST['is_active'],
            ':status' => "upcoming",
            ':mentorid' => "admin",
            ':SuperProgram' => $_POST['SuperProgram']
        ]);

        $showAlert = ($stmt->rowCount() > 0) ? 'success' : 'error';
    }
}

// Optional: show alert messages
if ($showAlert == 'success') {
//    echo "<div class='alert alert-success'>Program added successfully!</div>";
} elseif ($showAlert == 'error') {
    echo "<div class='alert alert-danger'>Failed to add program. Please try again.</div>";
} elseif ($showAlert == 'duplicate') {
    echo "<div class='alert alert-warning'>Program with this title is already upcoming. Cannot insert duplicate.</div>";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin-Evaluations | INDSAC SOFTECH</title>
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
  <style>
    .badge-orange {
      background-color: #fd7e14;
      color: #fff;
    }
    /* Add cursor pointer for clickable rows */
    .clickable-row {
      cursor: pointer;
    }
  </style>

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
               <div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="m-0">Dashboard</h1>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQuestionModal">
    Add Question
  </button>
 
</div>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a>
</li>
              <li class="breadcrumb-item active">Evaluations</li>
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
<!-- <div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Add New Program</h3>
  </div> -->
  <!-- /.card-header -->
  
  <!-- form start -->
  
<!-- Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addQuestionModalLabel">Add New Question</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
      <form id="questionForm" method="POST" action="add_question.php">
        <div class="modal-body">
          <div class="mb-3">
            <label for="question" class="form-label">Question</label>
            <textarea name="question" id="question" class="form-control" required></textarea>
          </div>

          <div class="mb-3">
            <label for="questiontype" class="form-label">Question Type</label>
            <select name="questiontype" id="questiontype" class="form-control" required>
              <option value="MCQ">MCQ</option>
              <option value="Text">Text</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" id="category" class="form-control">
          </div>

          <div id="mcqOptions">
            <div class="mb-3"><input type="text" name="ans1" class="form-control" placeholder="Option 1"></div>
            <div class="mb-3"><input type="text" name="ans2" class="form-control" placeholder="Option 2"></div>
            <div class="mb-3"><input type="text" name="ans3" class="form-control" placeholder="Option 3"></div>
            <div class="mb-3"><input type="text" name="ans4" class="form-control" placeholder="Option 4"></div>
          </div>

          <div class="mb-3">
            <label for="textans" class="form-label">Text Answer (if any)</label>
            <input type="text" name="textans" id="textans" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Question</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 </div>
      </form>
    </div>
  </div>
</div>

<div class="card">
          <div class="card-header">
            <h3 class="card-title">All Questions List</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>User Id</th>
                  <th>Question</th>
                  <th>Questiontype</th>
                  <th>Category</th>
                  <th>Ans1</th>
                  <th>Ans2</th>
                  <th>Ans3</th>
                  <th>Ans4</th>
                  <th>Text Answer</th>
                  <th>Status</th>
                  <th>Create Date</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($allquestionslist as $data): ?>
                <tr class="clickable-row" data-id="<?= $data['id'] ?>">
                  <td><?= htmlspecialchars($data['id']) ?></td>
                  <td><?= nl2br(htmlspecialchars($data['userid'])) ?></td>
                  <td><?= htmlspecialchars($data['question']) ?></td>
                  <td><?= htmlspecialchars($data['questiontype']) ?></td>
                  <td><?= htmlspecialchars($data['category']) ?></td>
                  <td><?= htmlspecialchars($data['ans1']) ?></td>
                  <td><?= htmlspecialchars($data['ans2']) ?></td>
                  <td><?= htmlspecialchars($data['ans3']) ?></td>
                  <td><?= htmlspecialchars($data['ans4']) ?></td>
                  <td><?= htmlspecialchars($data['textans']) ?></td>
                  <td><?= htmlspecialchars($data['status']) ?></td>
                  <td><?= htmlspecialchars($data['createdate']) ?></td>
                  </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
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
<!-- Hidden form to send POST -->
<!-- Hidden Form for Submitting Program ID -->
<form id="postForm" method="POST" action="editprograms.php" style="display:none;">
    <input type="hidden" name="program_id" id="hiddenId">
</form>

<script>
  document.querySelectorAll('.clickable-row').forEach(row => {
    row.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      document.getElementById('hiddenId').value = id;
      document.getElementById('postForm').submit();
    });
  });
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Add this CSS to hide any remaining + icon rows -->
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

<script>
document.getElementById('questiontype').addEventListener('change', function() {
    var mcqDiv = document.getElementById('mcqOptions');
    if (this.value === 'MCQ') {
        mcqDiv.style.display = 'block';
    } else {
        mcqDiv.style.display = 'none';
    }
});
window.addEventListener('DOMContentLoaded', () => {
    document.getElementById('mcqOptions').style.display = 'block';
});
</script>


<?php include("../panel/util/alert.php");?>
</body>
</html>
