<?php
session_start();
require_once("../../includes/db.php");

// Check if user is logged in and is a student
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../../login.php");
    exit();
}

$studentId = $_SESSION['user']['id'];

// Fetch progress data for this student
$stmt = $db->prepare("
    SELECT t.title, p.due_date, p.status
    FROM intern_task_progress p
    JOIN tasks t ON p.task_id = t.id
    WHERE p.intern_id = :studentId
    ORDER BY p.due_date DESC
");
$stmt->execute(['studentId' => $studentId]);
$progress = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Progress</title>
  <style>
    body {
      font-family: Segoe UI, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 40px;
    }
    h2 {
      color: #1a73e8;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      margin-top: 30px;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background: #1a73e8;
      color: white;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }
    .status {
      padding: 5px 10px;
      border-radius: 4px;
      font-weight: bold;
      color: white;
    }
    .assigned { background: #007bff; }
    .in-progress { background: orange; }
    .completed { background: green; }
  </style>
</head>
<body>

<h2>Task Progress</h2>

<?php if (count($progress) === 0): ?>
  <p style="text-align: center;">You have no tasks assigned yet.</p>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>Task Title</th>
        <th>Due Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($progress as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= htmlspecialchars($row['due_date']) ?></td>
          <td>
            <span class="status <?= strtolower(str_replace(' ', '-', $row['status'])) ?>">
              <?= ucfirst($row['status']) ?>
            </span>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

</body>
</html>
