<?php
include("../includes/db.php");
include("../panel/util/session.php");

// Fetch all applications
$stmt = $db->prepare("SELECT * FROM questions");
$stmt->execute();
$allquestionslist = $stmt->fetchAll();

//fetch all feedback
$stmt = $db->prepare("SELECT * FROM evaluationfeedbackanswer");
$stmt->execute();
$allanswerslist = $stmt->fetchAll();

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

<?php

try {
    $sql = "UPDATE notification 
            SET isread = 1 
            WHERE userid ='admin' 
              AND menu_item = 'feedback'";
    $db->query($sql);
} catch (Exception $e) {
    // Optional: Log the error
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
  
<div class="form-group">
<label for="feedback form" class="form-label">FeedBack Form</label>
    <div class="custom-control custom-switch">
        
        <input type="checkbox" class="custom-control-input" id="toggle_feedback">
        <label class="custom-control-label" for="toggle_feedback" id="status_text">OFF</label>
    </div>
</div>


</div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQuestionModal">
    Add Question
  </button>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#previewModal" id="previewBtn">
  Preview
</button>


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
    <option value="Date">Date</option>
    <option value="Rate">Rate</option> <!-- ✅ Added -->
  </select>
</div>
<div class="mb-3" id="rateMaxDiv" style="display:none;">
  <label for="ratemax" class="form-label">Maximum Rating</label>
  <input type="number" name="ratemax" id="ratemax" class="form-control" min="1" max="20" value="10">
</div>

          <div class="mb-3">
  <label for="category" class="form-label">Category</label>
  <input type="text" name="category" id="category" class="form-control" list="categoryList" placeholder="Select or add category">
  <datalist id="categoryList"></datalist>
</div>
<div class="mb-3">
  <label for="status" class="form-label">Status</label>
  <select name="status" id="status" class="form-control" required>
    <option value="active">Active</option>
    <option value="inactive">Inactive</option>
  </select>
</div>



          <div id="mcqOptions">
            <div class="mb-3"><input type="text" name="ans1" class="form-control" placeholder="Option 1"></div>
            <div class="mb-3"><input type="text" name="ans2" class="form-control" placeholder="Option 2"></div>
            <div class="mb-3"><input type="text" name="ans3" class="form-control" placeholder="Option 3"></div>
            <div class="mb-3"><input type="text" name="ans4" class="form-control" placeholder="Option 4"></div>
          </div>

          <!-- <div class="mb-3">
            <label for="textans" class="form-label">Text Answer (if any)</label>
            <input type="text" name="textans" id="textans" class="form-control">
          </div> -->

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Question</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Question Modal -->
<!-- Edit Question Modal -->
<div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Edit Question Form -->
      <form id="editQuestionForm" method="POST" action="update_questions.php">
        <div class="modal-body">

          <!-- Hidden ID -->
          <input type="hidden" name="id" id="edit_id">

          <!-- Question -->
          <div class="mb-3">
            <label for="edit_question" class="form-label">Question</label>
            <textarea name="question" id="edit_question" class="form-control" required></textarea>
          </div>

          <!-- Question Type -->
          <div class="mb-3">
            <label for="edit_questiontype" class="form-label">Question Type</label>
            <select name="questiontype" id="edit_questiontype" class="form-control" required>
              <option value="MCQ">MCQ</option>
              <option value="Text">Text</option>
              <option value="Date">Date</option>
              <option value="Rate">Rate</option>
            </select>
          </div>

          <!-- Maximum Rating (Visible only for Rate type) -->
          <div class="mb-3" id="editRateDiv" style="display:none;">
            <label for="edit_ratemax" class="form-label">Maximum Rating</label>
            <input type="number" name="ratemax" id="edit_ratemax" class="form-control" min="1" max="20" value="10">
          </div>

          <!-- Category -->
          <div class="mb-3">
            <label for="edit_category" class="form-label">Category</label>
            <input type="text" name="category" id="edit_category" class="form-control" list="categoryList" placeholder="Select or add category">
          </div>

          <!-- Status -->
          <div class="mb-3">
            <label for="edit_status" class="form-label">Status</label>
            <select name="status" id="edit_status" class="form-control" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>

          <!-- MCQ Options -->
          <div id="edit_mcq_options">
            <div class="mb-3"><input type="text" name="ans1" id="edit_ans1" class="form-control" placeholder="Option 1"></div>
            <div class="mb-3"><input type="text" name="ans2" id="edit_ans2" class="form-control" placeholder="Option 2"></div>
            <div class="mb-3"><input type="text" name="ans3" id="edit_ans3" class="form-control" placeholder="Option 3"></div>
            <div class="mb-3"><input type="text" name="ans4" id="edit_ans4" class="form-control" placeholder="Option 4"></div>
          </div>

        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Question</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content shadow-lg border-0 rounded">

      <!-- Modal Header -->
      <div class="modal-header" style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); color: white; border:0;">
        <h5 class="modal-title" id="previewModalLabel">
          <i class="fas fa-eye"></i> Preview Evaluation
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Form -->
      <form method="POST" action="submit_answers.php" id="evaluationForm">
        <div class="modal-body">

          <!-- Questions Container -->
          <div id="questionsContainer">
            <!-- Example Questions -->
            <div class="card mb-3 shadow-sm p-3" style="border-left: 5px solid #2575fc; transition: transform 0.2s;">
              <p class="mb-0"><strong>Q1:</strong> What is your favorite programming language?</p>
            </div>
            <div class="card mb-3 shadow-sm p-3" style="border-left: 5px solid #6a11cb; transition: transform 0.2s;">
              <p class="mb-0"><strong>Q2:</strong> How many years of experience do you have?</p>
            </div>
            <!-- More questions dynamically can be added here -->
          </div>

          <!-- Pagination & Progress -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <button type="button" class="btn btn-gradient-secondary" id="prevBtn" disabled>
              <i class="fas fa-chevron-left"></i> Previous
            </button>

            <!-- Progress Indicator -->
            <div class="progress flex-grow-1 mx-3" style="height: 8px; border-radius: 10px; overflow:hidden;">
              <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%; background: linear-gradient(to right, #6a11cb, #2575fc);"></div>
            </div>

            <button type="button" class="btn btn-gradient-primary" id="nextBtn">
              Next <i class="fas fa-chevron-right"></i>
            </button>
          </div>

        </div>

        <!-- Modal Footer -->
        <div class="modal-footer border-0">
          <button type="submit" class="btn btn-success btn-gradient-success">
            <i class="fas fa-check"></i> Submit Evaluation
          </button>
          <button type="button" class="btn btn-secondary btn-gradient-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i> Close
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Custom CSS for gradients and hover effects -->
<style>
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  }

  .btn-gradient-primary {
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    color: white;
    border: none;
  }
  .btn-gradient-primary:hover {
    background: linear-gradient(45deg, #2575fc, #6a11cb);
    color: white;
  }

  .btn-gradient-secondary {
    background: linear-gradient(45deg, #ff416c, #ff4b2b);
    color: white;
    border: none;
  }
  .btn-gradient-secondary:hover {
    background: linear-gradient(45deg, #ff4b2b, #ff416c);
    color: white;
  }

  .btn-gradient-success {
    background: linear-gradient(45deg, #11998e, #38ef7d);
    color: white;
    border: none;
  }
  .btn-gradient-success:hover {
    background: linear-gradient(45deg, #38ef7d, #11998e);
    color: white;
  }
</style>



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
                  <td><?= htmlspecialchars($data['status']) ?></td>
                  <td><?= htmlspecialchars($data['createdate']) ?></td>
                  </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
</div>
<div class="card">
          <div class="card-header">
            <h3 class="card-title">All Answers List</h3>
          </div>
          <div class="card-body">
            <table id="new" class="table table-bordered table-striped">
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
                <tr>
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
<!-- <form id="postForm" method="POST" action="#" style="display:none;">
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
</script> -->
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
<script>
$(document).ready(function() {
    var table = $('#new').DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "lengthChange": false, // hide dropdown if not needed
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });

    table.buttons().container()
        .appendTo('#new_wrapper .col-md-6:eq(0)');
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

<script>
let questionsData = [];
let currentPage = 0;
const pageSize = 5; // 5 questions per page

$('#previewModal').on('show.bs.modal', function () {
  fetch("fetch_questions.php")
    .then(res => res.json())
    .then(data => {
      questionsData = data;
      currentPage = 0;
      renderPage();
    });
});

function renderPage() {
  const container = document.getElementById("questionsContainer");
  container.innerHTML = "";

  const start = currentPage * pageSize;
  const end = Math.min(start + pageSize, questionsData.length);

  for (let i = start; i < end; i++) {
    const q = questionsData[i];
    const card = document.createElement("div");
    card.className = "card mb-2 p-2";
    card.innerHTML = `
      <div class="card-header font-weight-bold">${q.question}</div>
      <div class="card-body">${renderInput(q)}</div>
    `;
    container.appendChild(card);
  }

  // Pagination button states
  document.getElementById("prevBtn").disabled = currentPage === 0;
  if ((currentPage + 1) * pageSize >= questionsData.length) {
    document.getElementById("nextBtn").classList.add("d-none");
    document.getElementById("submitBtn").classList.remove("d-none");
  } else {
    document.getElementById("nextBtn").classList.remove("d-none");
    document.getElementById("submitBtn").classList.add("d-none");
  }
}

document.getElementById("prevBtn").addEventListener("click", () => {
  if (currentPage > 0) {
    currentPage--;
    renderPage();
  }
});

document.getElementById("nextBtn").addEventListener("click", () => {
  if ((currentPage + 1) * pageSize < questionsData.length) {
    currentPage++;
    renderPage();
  }
});

// Render input based on type
function renderInput(q) {
  if (q.questiontype === "MCQ") return renderOptions(q);
  if (q.questiontype === "Text") return renderText(q);
  if (q.questiontype === "Date") return renderDate(q);
  if (q.questiontype === "Rate") return renderRate(q);
  return '';
}

function renderOptions(q) {
  let html = '';
  for (let i=1;i<=4;i++) {
    if (q["ans"+i]) html += `
      <div class="form-check">
        <input class="form-check-input" type="radio" name="answers[${q.id}]" value="${q["ans"+i]}" required>
        <label class="form-check-label">${q["ans"+i]}</label>
      </div>`;
  }
  return html;
}

function renderText(q) {
  return `<input type="text" class="form-control" name="answers[${q.id}]" required>`;
}

function renderDate(q) {
  return `<input type="date" class="form-control" name="answers[${q.id}]" required>`;
}

// Rate (0 → ratemax, default 10)
function renderRate(q) {
  const max = q.ratemax ? parseInt(q.ratemax) : 10;
  let html = '<div class="d-flex flex-wrap">';
  for (let i=0;i<=max;i++) {
    html += `
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="answers[${q.id}]" value="${i}" required>
        <label class="form-check-label">${i}</label>
      </div>`;
  }
  html += '</div>';
  return html;
}

</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  fetch("fetch_categories.php")
    .then(response => response.json())
    .then(data => {
      let datalist = document.getElementById("categoryList");
      datalist.innerHTML = "";
      data.forEach(cat => {
        let option = document.createElement("option");
        option.value = cat;
        datalist.appendChild(option);
      });
    });
});
</script>
<script>
  
function renderInput(q) {
  if (q.questiontype === "MCQ") {
    return renderOptions(q);
  } else if (q.questiontype === "Date") {
    return renderDate(q);
  } else if (q.questiontype === "Rate") {   // ✅ Added
    return renderRate(q);
  } else {
    return renderText(q);
  }
}

  </script>
<script>
document.getElementById('questiontype').addEventListener('change', function() {
    var rateDiv = document.getElementById('rateMaxDiv');
    if (this.value === 'Rate') {
        rateDiv.style.display = 'block';
    } else {
        rateDiv.style.display = 'none';
    }
});
</script>
<script>
  $(document).ready(function() {

// Load current status on page load
$.get('toggle_feedback.php', {action: 'get_status'}, function(data){
    if(data.status){
        let isEnabled = (data.status === 'enabled feedback form');
        $('#toggle_feedback').prop('checked', isEnabled);
        $('#status_text').text(isEnabled ? 'ON' : 'OFF');
    }
}, 'json');

// Update all rows when toggle is clicked
$('#toggle_feedback').change(function(){
    $.post('toggle_feedback.php', {action: 'toggle_all'}, function(data){
        if(data.status){
            let isEnabled = (data.status === 'enabled feedback form');
            $('#toggle_feedback').prop('checked', isEnabled);
            $('#status_text').text(isEnabled ? 'ON' : 'OFF');
        }
    }, 'json');
});

});

</script>

<script>
$(document).ready(function() {
  // 🔹 When a row is clicked
  $('.clickable-row').on('click', function() {
    const questionId = $(this).data('id');

    // Fetch that question’s data using AJAX
    $.ajax({
      url: 'fetch_question_for_edit.php',
      type: 'GET',
      data: { id: questionId },
      dataType: 'json',
      success: function(q) {
        // Fill form fields in modal
        $('#edit_id').val(q.id);
        $('#edit_question').val(q.question);
        $('#edit_questiontype').val(q.questiontype);
        $('#edit_category').val(q.category);
        $('#edit_status').val(q.status);
        $('#edit_ratemax').val(q.ratemax || 10);

        // Show/hide Rate field based on type
        if (q.questiontype === 'Rate') {
          $('#editRateDiv').show();
        } else {
          $('#editRateDiv').hide();
        }

        // Show MCQ options only if type is MCQ
        if (q.questiontype === 'MCQ') {
          $('#edit_mcq_options').show();
          $('#edit_ans1').val(q.ans1);
          $('#edit_ans2').val(q.ans2);
          $('#edit_ans3').val(q.ans3);
          $('#edit_ans4').val(q.ans4);
        } else {
          $('#edit_mcq_options').hide();
        }

        // Finally show the modal
        $('#editQuestionModal').modal('show');
      },
      error: function() {
        alert('❌ Failed to load question details.');
      }
    });
  });

  // 🔹 Toggle Rate input inside modal
  $('#edit_questiontype').on('change', function() {
    if ($(this).val() === 'Rate') {
      $('#editRateDiv').show();
    } else {
      $('#editRateDiv').hide();
    }
  });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Show/Hide Rate field when type is changed
  document.getElementById('edit_questiontype').addEventListener('change', function() {
    if (this.value === 'Rate') {
      document.getElementById('editRateDiv').style.display = 'block';
    } else {
      document.getElementById('editRateDiv').style.display = 'none';
    }

    if (this.value === 'MCQ') {
      document.getElementById('edit_mcq_options').style.display = 'block';
    } else {
      document.getElementById('edit_mcq_options').style.display = 'none';
    }
  });
});
</script>



<?php include("../panel/util/alert.php");?>
</body>
</html>
