<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; }
        .sidebar {
            width: 200px;
            background: #1a73e8;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            padding: 15px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #0c48a1;
        }
        .main {
            flex: 1;
            padding: 20px;
            background: #f4f4f4;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3 style="text-align:center;">Welcome Student</h3>
    <a href="pages/profile.php" target="contentFrame">Profile</a>
    <a href="pages/tasks.php" target="contentFrame">Tasks</a>
    <a href="pages/progress.php" target="contentFrame">Progress</a>
    <a href="pages/settings.php" target="contentFrame">Settings</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
    <iframe name="contentFrame" src="pages/profile.php"></iframe>
</div>

</body>
</html>
