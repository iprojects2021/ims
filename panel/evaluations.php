<?php
include("../includes/db.php");
include("../panel/util/session.php");
//fetch all feedback
$stmt = $db->prepare("SELECT * FROM evaluationfeedbackanswer WHERE userid = ?");
$stmt->execute([$_SESSION['user']['id']]);
$allanswerslist = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student-Evaluations | INDSAC SOFTECH</title>
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
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include("leftmenu.php"); ?>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#previewModal" id="previewBtn">
  Give Feedback to Us
</button>
</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="student-dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Evaluations</li>
            </ol>
          </div>
        </div>
        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="previewModalLabel">Preview & Submit Evaluation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="POST" action="submit_answers.php" id="evaluationForm">
        <div class="modal-body">
          
          <!-- Questions Section -->
          <h6><i class="fas fa-question-circle"></i> Questions</h6>
          <div id="questionsContainer"></div>
          <hr>

          
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Submit Evaluation</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div>
</div>
<div class="card">
          <div class="card-header">
            <h3 class="card-title">All Answers List</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>User Id</th>
                  <th>Status</th>
                  <th>Type</th>
                  <th>Question Id</th>
                  <th>Answer</th>
                  <th>Attendance Score</th>
                  <th>Quality Score</th>
                  <th>Technical Score</th>
                  <th>Communication Score</th>
                  <th>Initiative Score</th>
                  <th>Overall Score</th>
                  <th>Improvements Questions</th>
                  <th>Comments</th>
                  <th>Create Date</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php foreach ($allanswerslist as $data): ?>
                <tr class="clickable-row" data-id="<?= $data['id'] ?>">
                  <td><?= htmlspecialchars($data['id']) ?></td>
                  <td><?= nl2br(htmlspecialchars($data['userid'])) ?></td>
                  <td><?= htmlspecialchars($data['status']) ?></td>
                  <td><?= htmlspecialchars($data['type']) ?></td>
                  <td><?= htmlspecialchars($data['questionid']) ?></td>
                  <td><?= htmlspecialchars($data['answer']) ?></td>
                  <td><?= htmlspecialchars($data['attendance_score']) ?></td>
                  <td><?= htmlspecialchars($data['technical_score']) ?></td>
                  <td><?= htmlspecialchars($data['communication_score']) ?></td>
                  <td><?= htmlspecialchars($data['initiative_score']) ?></td>
                  <td><?= htmlspecialchars($data['teamwork_score']) ?></td>
                  <td><?= htmlspecialchars($data['overall_score']) ?></td>
                  <td><?= htmlspecialchars($data['improvement_suggestions']) ?></td>
                  <td><?= htmlspecialchars($data['comments']) ?></td>
                  <td><?= htmlspecialchars($data['createdat']) ?></td>
                  </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
</div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

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
<script>
$('#previewModal').on('show.bs.modal', function () {
  fetch("fetch_questions.php")
    .then(response => response.json())
    .then(data => {
      let container = document.getElementById("questionsContainer");
      container.innerHTML = "";
      data.forEach(q => {
        let card = document.createElement("div");
        card.className = "card mb-2";
        card.innerHTML = `
          <div class="card-header">
            <strong>Q${q.id}:</strong> ${q.question}
            <span class="badge badge-info float-right">${q.questiontype}</span>
          </div>
          <div class="card-body">
            ${renderInput(q)}
          </div>`;
        container.appendChild(card);
      });
    });

  function renderInput(q) {
    if (q.questiontype === "MCQ") {
      return renderOptions(q);
    } else if (q.questiontype === "Date") {
      return renderDate(q);
    } else {
      return renderText(q);
    }
  }

  function renderOptions(q) {
    let options = "";
    for (let i = 1; i <= 4; i++) {
      if (q["ans"+i]) {
        options += `
        <div class="form-check">
          <input class="form-check-input" type="radio" name="answers[${q.id}]" value="${q["ans"+i]}" required>
          <label class="form-check-label">${q["ans"+i]}</label>
        </div>`;
      }
    }
    return options;
  }

  function renderText(q) {
    return `<input type="text" name="answers[${q.id}]" class="form-control" placeholder="Your answer..." required>`;
  }

  function renderDate(q) {
    return `<input type="date" name="answers[${q.id}]" class="form-control" required>`;
  }
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



</body>
</html>
