<?php

$role = $_SESSION['user']['role'] ?? null;
$userid = $_SESSION['user']['id'] ?? null;

// Function to get unread notification count
function getNotificationCount($db, $userid, $menu_item, $role) {
    try {
        $sql = "SELECT COUNT(*) FROM notification 
                WHERE userid = :userid 
                  AND menu_item = :menu_item 
                  AND isread = 0";
        $stmt = $db->prepare($sql);

        if ($role === 'admin') {
            $stmt->execute([
                ':userid' => 'admin',
                ':menu_item' => $menu_item
            ]);
        } else {
            $stmt->execute([
                ':userid' => $userid,
                ':menu_item' => $menu_item
            ]);
        }

        return $stmt->fetchColumn();
    } catch (Exception $e) {
        error_log("Error fetching notification count for $menu_item: " . $e->getMessage());
        return 0;
    }
}

// Function to fetch unread notification messages
function getUnreadNotifications($db, $userid, $menu_item, $role, $limit = 5) {
    try {
        $sql = "SELECT message, createdAt 
                FROM notification 
                WHERE userid = :userid 
                  AND menu_item = :menu_item 
                  AND isread = 0 
                ORDER BY createdAt DESC 
                LIMIT :limit";
        $stmt = $db->prepare($sql);

        if ($role === 'admin') { 
            $stmt->bindValue(':userid','admin', PDO::PARAM_STR);
        } else {
            $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
        }

        $stmt->bindValue(':menu_item', $menu_item, PDO::PARAM_STR);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("Error fetching unread notifications: " . $e->getMessage());
        return [];
    }
}

// Notification counts
$notificationCounts = [
    'tickets' => getNotificationCount($db, $userid, 'tickets', $role),
    'application'    => getNotificationCount($db, $userid, 'application', $role),
    'task'    => getNotificationCount($db, $userid, 'task', $role),
    'document'    => getNotificationCount($db, $userid, 'document', $role),
];
$totalNotifications = $notificationCounts['tickets'] + $notificationCounts['application']+$notificationCounts['task']+$notificationCounts['document'];

// Notification messages
$ticketMessages = getUnreadNotifications($db, $userid, 'tickets', $role);
$applicationMessages   = getUnreadNotifications($db, $userid, 'application', $role);
$taskMessages   = getUnreadNotifications($db, $userid, 'task', $role);
$documentMessages   = getUnreadNotifications($db, $userid, 'document', $role);
$applicationMessages   = getUnreadNotifications($db, $userid, 'application', $role);

?>



<!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <?php if ($totalNotifications > 0): ?>
            <span class="badge badge-warning navbar-badge"><?= $totalNotifications ?></span>
        <?php endif; ?>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header"><?= $totalNotifications ?> Notifications</span>

        <div class="dropdown-divider"></div>

        <!-- Ticket Messages -->
        <?php foreach ($ticketMessages as $ticket): ?>
            <a href="admintickets.php" class="dropdown-item">
                <i class="fas fa-ticket-alt mr-2"></i>
                <?= htmlspecialchars($ticket['message']) ?>
                <span class="float-right text-muted text-sm"><?= date('H:i', strtotime($ticket['createdAt'])) ?></span>
            </a>
        <?php endforeach; ?>
<!-- document Messages -->
<?php foreach ($documentMessages as $document): ?>
            <a href="admintickets.php" class="dropdown-item">
                <i class="fas fa-ticket-alt mr-2"></i>
                <?= htmlspecialchars($document['message']) ?>
                <span class="float-right text-muted text-sm"><?= date('H:i', strtotime($document['createdAt'])) ?></span>
            </a>
        <?php endforeach; ?>

<!-- application Messages -->
<?php foreach ($applicationMessages as $apllication): ?>
            <a href="admintickets.php" class="dropdown-item">
                <i class="fas fa-ticket-alt mr-2"></i>
                <?= htmlspecialchars($apllication['message']) ?>
                <span class="float-right text-muted text-sm"><?= date('H:i', strtotime($apllication['createdAt'])) ?></span>
            </a>
        <?php endforeach; ?>

        
<!-- task Messages -->
<?php foreach ($taskMessages as $task): ?>
            <a href="studenthelp.php" class="dropdown-item">
                <i class="fas fa-life-ring mr-2"></i>
                <?= htmlspecialchars($task['message']) ?>
                <span class="float-right text-muted text-sm"><?= date('H:i', strtotime($task['createdAt'])) ?></span>
            </a>
        <?php endforeach; ?>

        <div class="dropdown-divider"></div>
        <a href="all-notifications.php" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">INDSAC SOFTECH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block"><?php echo isset($_SESSION["user"]["name"]) ? $_SESSION["user"]["name"] : "";?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  
  <?php if ($role === 'admin'): ?>
    <!-- Show ONLY for Admin -->
    <li class="nav-item">
      <a href="admin_dashboard.php" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Dashboard
         <!-- <span class="right badge badge-danger">New</span>-->
        </p>
      </a>
    </li>

    <li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Programs
      <i class="right fas fa-angle-left"></i> <!-- Dropdown arrow -->
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="admin_addprogrms.php" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Add Program</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="viewprograms.php" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>View Programs</p>
      </a>
    </li>
  </ul>
</li>
<!-- Tickets Menu Item -->
<li class="nav-item">
  <a href="admintickets.php" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Tickets
      <?php if ($notificationCounts['tickets'] > 0): ?>
        <span class="right badge badge-danger">
          New <?php echo $notificationCounts['tickets']; ?>
        </span>
      <?php endif; ?>
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="application.php" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Application
      <?php if ($notificationCounts['application'] > 0): ?>
        <span class="right badge badge-danger">
          New <?php echo $notificationCounts['application']; ?>
        </span>
      <?php endif; ?>
    </p>
  </a>
</li>

<li class="nav-item">
  <a href="admintasks.php" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Task
      <?php if ($notificationCounts['task'] > 0): ?>
        <span class="right badge badge-danger">
          New <?php echo $notificationCounts['task']; ?>
        </span>
      <?php endif; ?>
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="admindocument.php" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Document
      <?php if ($notificationCounts['document'] > 0): ?>
        <span class="right badge badge-danger">
          New <?php echo $notificationCounts['document']; ?>
        </span>
      <?php endif; ?>
    </p>
  </a>
</li>


    <li class="nav-item">
      <a href="adminreferral.php" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
        Referral Dashboard
     
         <!-- <span class="right badge badge-danger">New</span>-->
        </p>
      </a>
    </li>
   <li class="nav-item">
       <a href="verificationpage.php" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          PaymentVerification
         <!-- <span class="right badge badge-danger">New</span>-->
        </p>
      </a>
    </li>
  
    <li class="nav-item">
      <a href="adminlogout.php" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          LogOut
          
        </p>
      </a>
    </li>


  <?php else: ?>
    <!-- Show for Students or other roles (non-admin) -->
    <li class="nav-item menu-open">
      <a href="student-dashboard.php" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="browseprograms.php" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Browse Programs
          <span class="right badge badge-danger">New</span>
        </p>
      </a>
    </li>


    <li class="nav-item">
      <a href="applicationdata.php" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>My Applications</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="userattendance.php" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>Attendance</p>
      </a>
    </li>

    
    <li class="nav-item has-treeview <?php echo ($page == 'create_task' || $page == 'view_task') ? 'menu-open' : ''; ?>">
  <a href="#" class="nav-link <?php echo ($page == 'create_task' || $page == 'view_task') ? 'active' : ''; ?>">
  <i class="nav-icon fas fa-copy"></i>
    <p>
      Task
      <?php if ($notificationCounts['task'] > 0): ?>
        <span class="right badge badge-danger">
          New <?php echo $notificationCounts['task']; ?>
        </span>
      <?php endif; ?>
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="tasks.php" class="nav-link <?php echo ($page == 'create_task') ? 'active' : ''; ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Create Task</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="view_task.php" class="nav-link <?php echo ($page == 'view_task') ? 'active' : ''; ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>View Task</p>
      </a>
    </li>
  </ul>
</li>

    <li class="nav-item">
      <a href="uploaddocuments.php" class="nav-link">
        <i class="nav-icon fas fa-file"></i>
        <p>Documents <?php if ($notificationCounts['document'] > 0): ?>
        <span class="right badge badge-danger">
          New <?php echo $notificationCounts['document']; ?>
        </span>
      <?php endif; ?>
   </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="evaluations.php" class="nav-link">
        <i class="nav-icon fas fa-clipboard-check"></i>
        <p>Evaluations</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="notifications.php" class="nav-link">
        <i class="nav-icon fas fa-bell"></i>
        <p>Notifications</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="learningresource.php" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>Learning Resources</p>
      </a>
    </li>

    <!-- Support Menu Item -->
    <li class="nav-item has-treeview <?php echo ($page == 'create_ticket' || $page == 'view_tickets') ? 'menu-open' : ''; ?>">
  <a href="#" class="nav-link <?php echo ($page == 'create_ticket' || $page == 'view_tickets') ? 'active' : ''; ?>">
    <i class="nav-icon fas fa-headset"></i>
    <p>
      Support
      <?php if ($notificationCounts['tickets'] > 0): ?>
        <span class="right badge badge-danger">
          New <?php echo $notificationCounts['tickets']; ?>
        </span>
      <?php endif; ?>
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="studenthelp.php" class="nav-link <?php echo ($page == 'create_ticket') ? 'active' : ''; ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>Create Ticket</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="view_ticket.php" class="nav-link <?php echo ($page == 'view_tickets') ? 'active' : ''; ?>">
        <i class="far fa-circle nav-icon"></i>
        <p>View Tickets</p>
      </a>
    </li>
  </ul>
</li>


    <li class="nav-item">
      <a href="profile.php" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Profile</p>
      </a>
    </li>

     <li class="nav-item">
      <a href="student-referral-dashboard.php" class="nav-link">
        <i class="nav-icon fas fa-gift"></i>
        <p>Referral</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="studentlogout.php" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
      </a>
    </li>
  <?php endif; ?>

</ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>