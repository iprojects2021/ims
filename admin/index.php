// admin/index.php
<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
</head>
<body>
  <h2>Welcome to Admin Dashboard</h2>
  <p>Hello, <?= htmlspecialchars($_SESSION['user']['full_name']) ?>!</p>
  <ul>
    <li><a href="create-task.php">➕ Create Task</a></li>
    <li><a href="assign-task.php">📌 Assign Task</a></li>
    <li><a href="../logout.php">🚪 Logout</a></li>
  </ul>
</body>
</html>
