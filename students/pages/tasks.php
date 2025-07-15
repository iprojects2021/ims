<?php
session_start();
require_once("../../includes/db.php");

// Check student login
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../../login.php");
    exit();
}

$studentId = $_SESSION['user']['id'];

// Fetch assigned tasks
$stmt = $db->prepare("
    SELECT t.title, t.description, itp.status, itp.due_date
    FROM intern_task_progress itp
    JOIN tasks t ON itp.task_id = t.id
    WHERE itp.intern_id = :intern_id
    ORDER BY itp.due_date ASC
");
$stmt->execute(['intern_id' => $studentId]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Tasks</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f7fa;
      margin: 0;
      padding: 40px;
    }
    .container {
      max-width: 800px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #1a73e8;
      margin-bottom: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #1a73e8;
      color: white;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    .status {
      font-weight: bold;
      text-transform: capitalize;
    }
    .status.assigned { color: #ff9800; }
    .status.in-progress { color: #2196f3; }
    .status.completed { color: #4caf50; }
  </style>
</head>
<body>

<div class="container">
  <h2>Assigned Tasks</h2>

  <?php if (count($tasks) === 0): ?>
    <p>No tasks assigned yet.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Status</th>
          <th>Due Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tasks as $task): ?>
          <tr>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= htmlspecialchars($task['description']) ?></td>
            <td class="status <?= strtolower($task['status']) ?>">
              <?= ucfirst($task['status']) ?>
            </td>
            <td><?= date("d M Y", strtotime($task['due_date'])) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

</body>
</html>
