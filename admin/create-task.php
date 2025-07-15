<?php
session_start();
require_once("../includes/db.php");

// Allow only admins
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Handle form submit
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title && $description) {
        $stmt = $db->prepare("INSERT INTO tasks (title, description) VALUES (:title, :description)");
        $stmt->execute([
            'title' => $title,
            'description' => $description
        ]);
        $message = "✅ Task created successfully!";
    } else {
        $message = "❌ Please enter both title and description.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create New Task</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f5f7fa; padding:40px; }
        .box { max-width:500px; margin:auto; background:white; padding:30px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);}
        h2 { color:#1a73e8; text-align:center; }
        label { display:block; margin-top:15px; font-weight:600; }
        input, textarea { width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:6px; }
        textarea { resize: vertical; height: 120px; }
        button { margin-top:20px; background:#1a73e8; color:white; padding:12px; border:none; width:100%; border-radius:6px; cursor:pointer; }
        .msg { margin-top:20px; padding:12px; background:#e8f5e9; border-left:5px solid #4CAF50; }
        .error { background:#ffebee; border-left-color:#f44336; }
        a.back { display:inline-block; margin-top:20px; color:#1a73e8; text-decoration:none; }
    </style>
</head>
<body>

<div class="box">
    <h2>Create New Task</h2>

    <?php if ($message): ?>
        <div class="msg <?= str_contains($message, '❌') ? 'error' : '' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <label>Task Title</label>
        <input type="text" name="title" required placeholder="Enter task title">

        <label>Description</label>
        <textarea name="description" required placeholder="Enter task description"></textarea>

        <button type="submit">Create Task</button>
    </form>

    <a class="back" href="index.php">← Back to Dashboard</a>
</div>

</body>
</html>
