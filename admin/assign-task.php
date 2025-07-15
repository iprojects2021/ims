<?php
// admin/assign-task.php
session_start();
require_once("../includes/db.php");

/* 1️⃣  Authorisation check */
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

/* 2️⃣  Handle form submission */
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = intval($_POST['student_id'] ?? 0);
    $taskId    = intval($_POST['task_id']    ?? 0);
    $dueDate   = $_POST['due_date']          ?? '';

    if ($studentId && $taskId && $dueDate) {
        $stmt = $db->prepare("
            INSERT INTO intern_task_progress (intern_id, task_id, due_date, status)
            VALUES (:student, :task, :due_date, 'assigned')
        ");
        $stmt->execute([
            'student'   => $studentId,
            'task'      => $taskId,
            'due_date'  => $dueDate
        ]);
        $msg = "✅ Task assigned successfully.";
    } else {
        $msg = "❌ Please choose student, task and due‑date.";
    }
}

/* 3️⃣  Fetch dropdown data */
$students = $db->query("
        SELECT id, full_name 
        FROM users 
        WHERE role = 'student' 
        ORDER BY full_name
    ")->fetchAll(PDO::FETCH_ASSOC);

$tasks = $db->query("
        SELECT id, title 
        FROM tasks 
        ORDER BY title
    ")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Task to Student</title>
    <style>
        body      {font-family: Segoe UI, sans-serif; background:#f5f7fa; margin:0; padding:40px;}
        .box      {max-width:500px; margin:auto; background:#fff; padding:30px; border-radius:8px;
                   box-shadow:0 2px 8px rgba(0,0,0,.1);}
        h2        {color:#1a73e8; text-align:center; margin-top:0;}
        label     {display:block; margin-top:18px; font-weight:600;}
        select,
        input     {width:100%; padding:10px; margin-top:6px; border:1px solid #ccc; border-radius:6px;}
        button    {width:100%; margin-top:25px; padding:12px; border:none; background:#1a73e8;
                   color:#fff; font-size:16px; border-radius:6px; cursor:pointer;}
        .msg      {margin:15px 0; padding:10px; border-left:4px solid #4caf50; background:#e8f5e9;}
        .error    {border-left-color:#f44336; background:#ffebee;}
        a.back    {display:inline-block; margin-top:25px; color:#1a73e8; text-decoration:none;}
    </style>
</head>
<body>

<div class="box">
    <h2>Assign Task</h2>

    <?php if ($msg): ?>
        <div class="msg <?= str_contains($msg,'❌') ? 'error' : '' ?>"><?= $msg ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Student</label>
        <select name="student_id" required>
            <option value="">-- select student --</option>
            <?php foreach ($students as $s): ?>
                <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['full_name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Task</label>
        <select name="task_id" required>
            <option value="">-- select task --</option>
            <?php foreach ($tasks as $t): ?>
                <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['title']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Due date</label>
        <input type="date" name="due_date" required>

        <button type="submit">Assign</button>
    </form>

    <a class="back" href="javascript:history.back()">← Back to admin panel</a>
</div>

</body>
</html>
