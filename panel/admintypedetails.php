<?php
include("../panel/util/statuscolour.php");
include("../includes/db.php");
include("../panel/util/session.php");





if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
  $id = $_POST['id'];
  try{
 // $sql="SELECT * FROM application WHERE id = ?";
 $sql = "SELECT 
 a.*, 
 p.*, 
 pv.*,
 a.status AS application_status
FROM application a
LEFT JOIN programs p 
 ON a.program_id = p.program_id
LEFT JOIN paymentverification pv 
 ON a.paymentverificationid = pv.PaymentVerificationID
WHERE a.id = ?
";

  
  $stmt = $db->prepare($sql);
  $stmt->execute([$id]);
  $applicationdata = $stmt->fetchAll();
  //echo "<pre>";print_r($applicationdata);die;

  foreach ($applicationdata as $app)

{
  $_SESSION['UserID'] = $app['UserID'];
  $_SESSION['email1'] = $app['email'];

}
//count for task
$stmt = $db->prepare("SELECT COUNT(*) FROM task WHERE studentid = :studentid");
$stmt->bindParam(':studentid', $_SESSION['UserID'], PDO::PARAM_INT);
$stmt->execute();
$taskCount = $stmt->fetchColumn();


//count for document
$stmt = $db->prepare("SELECT COUNT(*) FROM documents WHERE studentid = :studentid");
$stmt->bindParam(':studentid', $_SESSION['UserID'], PDO::PARAM_INT);
$stmt->execute();
$documentCount = $stmt->fetchColumn();

//count for ticket
$stmt = $db->prepare("SELECT COUNT(*) FROM ticket WHERE studentid = :studentid");
$stmt->bindParam(':studentid', $_SESSION['UserID'], PDO::PARAM_INT);
$stmt->execute();
$ticketCount = $stmt->fetchColumn();

//count for referal
$stmt = $db->prepare("SELECT COUNT(*) FROM referrals WHERE userid = :studentid");
$stmt->bindParam(':studentid', $_SESSION['UserID'], PDO::PARAM_INT);
$stmt->execute();
$referralCountdata = $stmt->fetchColumn();

// Count for application
$stmt = $db->prepare("SELECT COUNT(*) FROM application WHERE email = :email1");
$stmt->bindParam(':email1', $_SESSION['email1'], PDO::PARAM_STR); // use PARAM_STR for strings
$stmt->execute();
$applicationCount1 = $stmt->fetchColumn();

   
  }
  catch(Exception $e)
  {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
  }
} 
?>
<?php
try {
    $sql = "SELECT * FROM applicationstatus WHERE applicationid = ?";
    // Debugging (optional)
    // echo $sql; var_dump($id); die;

    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);   // ✅ Pass as array
    $applicationData = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    $logger->log(
        'ERROR',
        'Line ' . __LINE__ . ': Query - ' . $sql . ' , Exception Error = ' . $e->getMessage()
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin-Application | INDSAC SOFTECH</title>
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

  <!-- Main Content Wrapper -->
  <div class="content-wrapper">
    
    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <h1>Application Details</h1>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
    <?php foreach ($applicationdata as $app): ?>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-file-alt"></i> <?php echo htmlspecialchars($app['type']); ?>
      </h3>
    </div>
    <div class="card-body">
  <!-- Stat boxes -->
  <div class="row">
  
    <!-- Referral Count -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-light">
        <div class="inner">
          <h3><?php echo $referralCountdata ?></h3>
          <p>Total Referral Count</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-friends"></i>
        </div>
        <form action="adminreferral.php" method="POST">
          <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
          <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    View Referrals <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
  </form>
      </div>
    </div>

    <!-- Document Count -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-light">
        <div class="inner">
          <h3><?php echo $documentCount ?></h3>
          <p>Total Document Count</p>
        </div>
        <div class="icon">
          <i class="fas fa-file-alt"></i>
        </div>
        <form action="admindocument.php" method="POST">
          <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
          <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    View Documents <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
        </form>
      </div>
    </div>

    <!-- Task Count -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-light">
        <div class="inner">
          <h3><?php echo $taskCount ?></h3>
          <p>Total Task Count</p>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <form action="admintasks.php" method="POST">
          <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
          <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    View Tasks <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>  </form>
      </div>
    </div>

    <!-- Ticket Count -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-light">
        <div class="inner">
          <h3><?php echo $ticketCount ?></h3>
          <p>Total Ticket Count</p>
        </div>
        <div class="icon">
          <i class="fas fa-ticket-alt"></i>
        </div>
        <form action="admintickets.php" method="POST">
          <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
          <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    View Tickets <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
        </form>
      </div>
    </div>
     <!-- Ticket Count -->
    <!-- Application Count Box 1 -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-light">
    <div class="inner">
      <h3><?php echo $applicationCount1 ?? '--'; ?></h3>
      <p>Total Application Count</p>
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
</div>   </form>
  </div>
</div>

<!-- Application Count Box 2 -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-light">
    <div class="inner">
      <h3><?php echo $applicationCount2 ?? '--'; ?></h3>
      <p>--</p>
    </div>
    <div class="icon">
      <i class="fas fa-check-circle"></i>
    </div>
    <form action="#" method="POST">
      <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
      <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    -- <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
    </form>
  </div>
</div>

<!-- Application Count Box 3 -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-light">
    <div class="inner">
      <h3><?php echo $applicationCount3 ?? '--'; ?></h3>
      <p>--</p>
    </div>
    <div class="icon">
      <i class="fas fa-search"></i>
    </div>
    <form action="#" method="POST">
      <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
      <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    -- <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
    </form>
  </div>
</div>

<!-- Application Count Box 4 -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-light">
    <div class="inner">
      <h3><?php echo $applicationCount4 ?? '--'; ?></h3>
      <p>--</p>
    </div>
    <div class="icon">
      <i class="fas fa-times-circle"></i>
    </div>
    <form action="#" method="POST">
      <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
      <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    -- <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
    </form>
  </div>
</div>

  </div>
</div>

   <!-- Top Summary Info -->
      <div class="row">
        <div class="col-md-4">
          <div class="info-box bg-gradient-info">
            <div class="info-box-content text-center">
              <span class="info-box-text">Payment Verification Status</span>
              <span class="info-box-number"><?php echo htmlspecialchars($app['VerificationStatus'] ?? ''); ?>
</span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-box bg-gradient-success">
            <div class="info-box-content text-center">
              <span class="info-box-text">Payment Status</span>
              <span class="info-box-number"><?php echo htmlspecialchars($app['Status'] ?? ''); ?>
</span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-box bg-gradient-warning">
            <div class="info-box-content text-center">
              <span class="info-box-text">Amount Paid</span>
              <span class="info-box-number"><?php echo htmlspecialchars($app['AmountPaid'] ?? ''); ?>
</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Application Information -->
      <div class="row mt-4">
        <div class="col-md-4">
          <h5><i class="fas fa-user"></i> Applicant Info</h5>
          <ul class="list-group list-group-flush">
          <li class="list-group-item">ID: <b><?php echo htmlspecialchars($app['id'] ?? ''); ?></b></li>
<li class="list-group-item">Mobile: <b><?php echo htmlspecialchars($app['mobile'] ?? ''); ?></b></li>
<li class="list-group-item">Email: <b><?php echo htmlspecialchars($app['email'] ?? ''); ?></b></li>
<li class="list-group-item">Project: <b><?php echo htmlspecialchars($app['project'] ?? ''); ?></b></li>
<li class="list-group-item">Outcome: <b><?php echo htmlspecialchars($app['outcome'] ?? ''); ?></b></li>
<li class="list-group-item">Start Date: <b><?php echo htmlspecialchars($app['expected_start_date'] ?? ''); ?></b></li>
<li class="list-group-item">Program Type: <b><?php echo htmlspecialchars($app['type'] ?? ''); ?></b></li>
<li class="list-group-item">Status: <b><?php echo getStatusBadge($app['application_status'] ?? ''); ?></b></li>
<li class="list-group-item">Created Date: <b><?php echo htmlspecialchars($app['createddate'] ?? ''); ?></b></li>
<li class="list-group-item">
<form id="statusForm">
    <input type="hidden" name="applicationid" value="<?php echo htmlspecialchars($app['id'] ?? ''); ?>">
    <input type="hidden" name="oldstatus" value="<?php echo htmlspecialchars($app['application_status'] ?? ''); ?>">
    <input type="hidden" name="userid" value="<?php echo htmlspecialchars($_SESSION['user']['id'] ?? ''); ?>">

    <label for="application_status">Update Status:</label>
<select id="application_status" name="newstatus" class="form-select mt-1">
    <option value="">Select Status</option>

    <!-- Application Submission & Review Phase -->
    <optgroup label="Application Submission & Review">
        <option value="Submitted" <?php echo ($app['application_status'] ?? '') == 'Submitted' ? 'selected' : ''; ?>>Submitted</option>
        <option value="Under Review" <?php echo ($app['application_status'] ?? '') == 'Under Review' ? 'selected' : ''; ?>>Under Review</option>
        <option value="Shortlisted" <?php echo ($app['application_status'] ?? '') == 'Shortlisted' ? 'selected' : ''; ?>>Shortlisted</option>
        <option value="Interview Scheduled" <?php echo ($app['application_status'] ?? '') == 'Interview Scheduled' ? 'selected' : ''; ?>>Interview Scheduled</option>
        <option value="Interview Completed" <?php echo ($app['application_status'] ?? '') == 'Interview Completed' ? 'selected' : ''; ?>>Interview Completed</option>
        <option value="Selected" <?php echo ($app['application_status'] ?? '') == 'Selected' ? 'selected' : ''; ?>>Selected</option>
        <option value="Rejected" <?php echo ($app['application_status'] ?? '') == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
    </optgroup>

    <!-- Document & Verification Phase -->
    <optgroup label="Document & Verification">
        <option value="Document Upload Pending" <?php echo ($app['application_status'] ?? '') == 'Document Upload Pending' ? 'selected' : ''; ?>>Document Upload Pending</option>
        <option value="Document Submitted" <?php echo ($app['application_status'] ?? '') == 'Document Submitted' ? 'selected' : ''; ?>>Document Submitted</option>
        <option value="Document Verification Pending" <?php echo ($app['application_status'] ?? '') == 'Document Verification Pending' ? 'selected' : ''; ?>>Document Verification Pending</option>
        <option value="Document Approved" <?php echo ($app['application_status'] ?? '') == 'Document Approved' ? 'selected' : ''; ?>>Document Approved</option>
        <option value="Document Rejected / Re-upload Required" <?php echo ($app['application_status'] ?? '') == 'Document Rejected / Re-upload Required' ? 'selected' : ''; ?>>Document Rejected / Re-upload Required</option>
    </optgroup>

    <!-- Offer & Onboarding Phase -->
    <optgroup label="Offer & Onboarding">
        <option value="Offer Letter Sent" <?php echo ($app['application_status'] ?? '') == 'Offer Letter Sent' ? 'selected' : ''; ?>>Offer Letter Sent</option>
        <option value="Offer Letter Accepted" <?php echo ($app['application_status'] ?? '') == 'Offer Letter Accepted' ? 'selected' : ''; ?>>Offer Letter Accepted</option>
        <option value="Offer Letter Declined" <?php echo ($app['application_status'] ?? '') == 'Offer Letter Declined' ? 'selected' : ''; ?>>Offer Letter Declined</option>
        <option value="Joining Letter Sent" <?php echo ($app['application_status'] ?? '') == 'Joining Letter Sent' ? 'selected' : ''; ?>>Joining Letter Sent</option>
        <option value="Joining Confirmed" <?php echo ($app['application_status'] ?? '') == 'Joining Confirmed' ? 'selected' : ''; ?>>Joining Confirmed</option>
        <option value="Not Joined" <?php echo ($app['application_status'] ?? '') == 'Not Joined' ? 'selected' : ''; ?>>Not Joined</option>
    </optgroup>
</select>


    <label for="comment">Remarks:</label>
    <textarea id="comment" name="remarks" class="form-control mt-1" rows="3"><?php echo htmlspecialchars($app['comment'] ?? ''); ?></textarea>

    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>

<div id="statusMessage" class="mt-2"></div>

    </ul>
        </div>

        <!-- Program Details -->
        <div class="col-md-4">
          <h5><i class="fas fa-info-circle"></i> Program Details</h5>
          <ul class="list-group list-group-flush">
          <li class="list-group-item">Program ID: <b><?php echo htmlspecialchars($app['program_id'] ?? ''); ?></b></li>
<li class="list-group-item">Title: <b><?php echo htmlspecialchars($app['title'] ?? ''); ?></b></li>
<li class="list-group-item">Slug: <b><?php echo htmlspecialchars($app['slug'] ?? ''); ?></b></li>
<li class="list-group-item">Short Description: <b><?php echo htmlspecialchars($app['short_description'] ?? ''); ?></b></li>
<li class="list-group-item">Duration: <b><?php echo htmlspecialchars($app['duration'] ?? ''); ?></b></li>
<li class="list-group-item">Start Date: <b><?php echo htmlspecialchars($app['start_date'] ?? ''); ?></b></li>
<li class="list-group-item">Remote: <b><?php echo htmlspecialchars($app['is_remote'] ?? ''); ?></b></li>
<li class="list-group-item">Stipend: <b><?php echo getStatusBadge($app['stipend_amount'] ?? ''); ?></b></li>
<li class="list-group-item">Created At: <b><?php echo htmlspecialchars($app['created_at'] ?? ''); ?></b></li>
            <button type="button" class="btn btn-sm btn-primary" onclick="redirectToFormeditprograms('<?php echo $app['program_id']; ?>')">Edit</button>
          </ul>
        </div>

        <!-- Payment Verification -->
        <div class="col-md-4">
          <h5><i class="fas fa-credit-card"></i> Payment Verification</h5>
          <ul class="list-group list-group-flush">
          <li class="list-group-item">Payment ID: <b><?php echo htmlspecialchars($app['PaymentVerificationID'] ?? ''); ?></b></li>
<li class="list-group-item">User ID: <b><?php echo htmlspecialchars($app['UserID'] ?? ''); ?></b></li>
<li class="list-group-item">Payment Ref: <b><?php echo htmlspecialchars($app['PaymentID'] ?? ''); ?></b></li>
<li class="list-group-item">Bank RRN: <b><?php echo htmlspecialchars($app['BankRRN'] ?? ''); ?></b></li>
<li class="list-group-item">Order ID: <b><?php echo htmlspecialchars($app['OrderID'] ?? ''); ?></b></li>
<li class="list-group-item">Invoice ID: <b><?php echo htmlspecialchars($app['InvoiceID'] ?? ''); ?></b></li>
<li class="list-group-item">Email: <b><?php echo htmlspecialchars($app['Email'] ?? ''); ?></b></li>
<li class="list-group-item">Phone: <b><?php echo htmlspecialchars($app['Phone'] ?? ''); ?></b></li>
<li class="list-group-item">Created Date: <b><?php echo htmlspecialchars($app['CreateDate'] ?? ''); ?></b></li>
<button type="button" class="btn btn-sm btn-primary" onclick="redirectToForm('<?php echo $app['PaymentVerificationID']; ?>')">Edit</button>
          </ul>
        </div>
      </div>
    </div>
    <!-- Applications table -->
  <div class="card">
          <div class="card-header">
            <h3 class="card-title">Application Status History</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Application ID</th>
                  <th>User ID</th>
                  <th>Old Status</th>
                  <th>New Status</th>
                  <th>Remarks</th>
                  <th>Create Date</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($applicationData as $row): ?>
                  <tr class="clickable-row" data-id="<?= (int)$row['id'] ?>">
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['applicationid']) ?></td>
                    <td><?= htmlspecialchars($row['userid']) ?></td>
                    <td><?= getStatusBadge($row['oldstatus']) ?></td>
                    <td><?= htmlspecialchars($row['newstatus']) ?></td>
                    <td><?= htmlspecialchars($row['remarks']) ?></td>
                    <td><?= htmlspecialchars($row['createdat']) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Application ID</th>
                  <th>User ID</th>
                  <th>Old Status</th>
                  <th>New Status</th>
                  <th>Remarks</th>
                  <th>Create Date</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
  </div>
  
  <?php endforeach; ?>
  
    </section>
  </div>

  <?php include("footer.php"); ?>

</div>
<style>
.badge-orange {
    background-color: #fd7e14; /* Bootstrap's orange */
    color: #fff;
}
</style>
<form id="postRedirectFormedit" method="POST" action="editprograms.php" style="display:none;">
    <input type="hidden" name="program_id" id="posteditprogramid">
</form>


<script>
function redirectToFormeditprograms(id) {
    document.getElementById('posteditprogramid').value = id;
    document.getElementById('postRedirectFormedit').submit();
}
</script>
<form id="postRedirectForm" method="POST" action="paymentverificationform.php" style="display:none;">
    <input type="hidden" name="PaymentVerificationID" id="postPaymentVerificationID">
</form>


<script>
function redirectToForm(id) {
    document.getElementById('postPaymentVerificationID').value = id;
    document.getElementById('postRedirectForm').submit();
}
</script>
<script>
document.getElementById('statusForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent page reload

    const formData = new FormData(this);

    fetch('update_status.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const msgDiv = document.getElementById('statusMessage');
        if (data.success) {
            msgDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
        } else {
            msgDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }

        // 🔹 Automatically clear message after 3 seconds
        setTimeout(() => {
            msgDiv.innerHTML = '';
        }, 3000);
    })
    .catch(error => {
        console.error('Error:', error);
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
