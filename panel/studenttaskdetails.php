<?php
include("../panel/util/statuscolour.php");
include("../includes/db.php");
session_start();
$taskId = $application['id'] ?? '';
//print_r($_SESSION);die;
$application = null;
$comments = [];

$id = $_GET['id'] ?? $_POST['id'] ?? null;
$createdBy = $_SESSION["user"]["id"] ?? null;

// Fetch task details
if ($id) {
    try {
        $stmt = $db->prepare("SELECT * FROM task WHERE id = ?");
        $stmt->execute([$id]);
        $application = $stmt->fetch();
    } catch (Exception $e) {
        error_log("Error fetching task: " . $e->getMessage());
    }

    // Fetch comments if accessed via GET
            $stmt = $db->prepare("SELECT * FROM taskcommit WHERE taskid =$id ORDER BY createdate ASC");
            $stmt->execute([$id]);
            $comments = $stmt->fetchAll();
    
}

// Handle new comment submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
  $taskid = trim($_POST["taskid"]);
  $message = trim($_POST["message"]);

  if ($taskid && $message && $createdBy) {
      try {
          // Insert comment into taskcommit table
          $stmt = $db->prepare("INSERT INTO taskcommit (taskid, message, createdate, createdby) VALUES (?, ?, NOW(), ?)");
          $stmt->execute([$taskid, $message, $createdBy]);

          // ✅ Insert Notification for Admin or Responsible User
          $menuItem = 'task'; // or whatever menu this relates to
          $notificationMessage = "New comment added to Task ID: " . htmlspecialchars($taskid);

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
              // Optional: Log error or handle notification insert failure
              if (isset($logger)) {
                  $logger->log('ERROR', 'Notification Insert Failed: ' . $e->getMessage());
              }
          }

          // Success message and redirect
          echo '<div class="alert alert-success">Comment added successfully.</div>';
          echo '<script>
              setTimeout(() => { 
                  window.location.href = "studenttaskdetails.php?id=' . htmlspecialchars($taskid) . '"; 
              }, 1500);
          </script>';

      } catch (Exception $e) {
          echo '<div class="alert alert-danger">Failed to add comment.</div>';
      }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Task Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">

  <style>
    .badge-orange {
        background-color: #fd7e14;
        color: #fff;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
  <?php include("leftmenu.php"); ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1>Task Details</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Task Details</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header"><h3 class="card-title"><?php echo htmlspecialchars($application['title'] ?? ''); ?></h3></div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8">

              <div class="row mb-3">
                <div class="col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content text-center">
                      <span class="info-box-text text-muted">Estimated Budget</span>
                      <span class="info-box-number text-muted">2300</span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content text-center">
                      <span class="info-box-text text-muted">Amount Spent</span>
                      <span class="info-box-number text-muted">2000</span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content text-center">
                      <span class="info-box-text text-muted">Duration</span>
                      <span class="info-box-number text-muted">20 days</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Task Description -->
              <div class="post mb-3">
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user">
                  <span class="username"><a href="#"><?php echo htmlspecialchars($application['title'] ?? ''); ?></a></span>
                  <span class="description"><?php echo htmlspecialchars($application['created_at'] ?? ''); ?></span>
                </div>
                <p><?php echo nl2br(htmlspecialchars($application['description'] ?? '')); ?></p>
              </div>

              <!-- Comments -->
              <h4>Comments</h4>
              <?php foreach ($comments as $comment): ?>
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user">
                    <span class="username">User #<?php echo htmlspecialchars($comment['createdby']); ?></span>
                    <span class="description"><?php echo htmlspecialchars($comment['createdate']); ?></span>
                  </div>
                  <p><?php echo nl2br(htmlspecialchars($comment['message'])); ?></p>
                </div>
              <?php endforeach; ?>

              <!-- Add Comment -->
              <form method="post">
                <input type="hidden" name="taskid" value="<?php echo htmlspecialchars($application['id'] ?? ''); ?>">
                <div class="form-group">
                  <textarea name="message" class="form-control" rows="2" placeholder="Add a comment..." required></textarea>
                </div>
                <button type="submit" name="add" class="btn btn-primary btn-sm">Submit</button>
              </form>

            </div>

            <!-- Sidebar with Task Details -->
            <div class="col-lg-4">
              <h5 class="text-primary"><i class="fas fa-tasks"></i> Task Info</h5>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Title:</strong> <?php echo htmlspecialchars($application['title'] ?? ''); ?></li>
                <li class="list-group-item"><strong>Task ID:</strong> <?php echo htmlspecialchars($application['id'] ?? ''); ?></li>
                <li class="list-group-item"><strong>Student ID:</strong> <?php echo htmlspecialchars($application['studentid'] ?? ''); ?></li>
                <li class="list-group-item"><strong>Status:</strong> <?php echo htmlspecialchars($application['status'] ?? ''); ?></li>
                <li class="list-group-item"><strong>Created:</strong> <?php echo htmlspecialchars($application['created_at'] ?? ''); ?></li>
                <li class="list-group-item"><strong>Updated:</strong> <?php echo htmlspecialchars($application['updated_at'] ?? ''); ?></li>
              </ul>

              <h5 class="mt-4">Project Files</h5>
              <ul class="list-unstyled">
                <?php if (!empty($application['filename'])): ?>
                  <li><a href="../uploads/tickets/<?php echo urlencode($application['filename']); ?>" target="_blank" class="text-secondary"><i class="fas fa-file"></i> View File</a></li>
                <?php else: ?>
                  <li><em>No files attached</em></li>
                <?php endif; ?>
              </ul>

              <div class="text-center mt-3">
                <a href="#" class="btn btn-sm btn-primary">Add Files</a>
                <a href="#" class="btn btn-sm btn-warning">Report</a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include("footer.php"); ?>

</div>

<!-- JS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
