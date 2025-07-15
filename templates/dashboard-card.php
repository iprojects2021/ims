<?php
require("../includes/db.php");

// Fetch statistics
$total_users     = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$total_interns   = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'intern'")->fetch_assoc()['total'];
$total_lecturers = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'lecturer'")->fetch_assoc()['total'];
$total_personnel = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'personnel'")->fetch_assoc()['total'];

$total_programs  = $conn->query("SELECT COUNT(*) as total FROM programs")->fetch_assoc()['total'];
$total_tasks     = $conn->query("SELECT COUNT(*) as total FROM tasks")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard | Cards</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f7fa;
      margin: 0;
      padding: 0;
    }
    .dashboard {
      max-width: 1200px;
      margin: 50px auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 20px;
    }
    .card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      text-align: center;
    }
    .card h2 {
      font-size: 2.5rem;
      color: #1a73e8;
      margin: 0;
    }
    .card p {
      font-size: 1.1rem;
      color: #555;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="dashboard">
  <div class="card">
    <h2><?= $total_users ?></h2>
    <p>Total Users</p>
  </div>
  <div class="card">
    <h2><?= $total_interns ?></h2>
    <p>Total Interns</p>
  </div>
  <div class="card">
    <h2><?= $total_lecturers ?></h2>
    <p>Total Lecturers</p>
  </div>
  <div class="card">
    <h2><?= $total_personnel ?></h2>
    <p>Total Personnel</p>
  </div>
  <div class="card">
    <h2><?= $total_programs ?></h2>
    <p>Total Programs</p>
  </div>
  <div class="card">
    <h2><?= $total_tasks ?></h2>
    <p>Total Tasks</p>
  </div>
</div>

</body>
</html>
