<?php
session_start();

// Check if user is logged in and is a student
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 30px;
      background-color: #f9f9f9;
    }
    .profile-container {
      max-width: 600px;
      background: white;
      padding: 30px;
      margin: 0 auto;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
      border-radius: 10px;
    }
    h2 {
      margin-bottom: 20px;
      color: #1a73e8;
      text-align: center;
    }
    .info {
      margin-bottom: 15px;
    }
    .label {
      font-weight: bold;
      color: #333;
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <h2>Student Profile</h2>
    <div class="info">
      <div class="label">Full Name:</div>
      <div><?= htmlspecialchars($user['full_name']) ?></div>
    </div>
    <div class="info">
      <div class="label">Email:</div>
      <div><?= htmlspecialchars($user['email']) ?></div>
    </div>
    <div class="info">
      <div class="label">Phone:</div>
      <div><?= htmlspecialchars($user['phone']) ?></div>
    </div>
    <div class="info">
      <div class="label">Role:</div>
      <div><?= htmlspecialchars($user['role']) ?></div>
    </div>
  </div>
</body>
</html>
 