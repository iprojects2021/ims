<?php
session_start();
require_once("../../includes/db.php");

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../../login.php");
    exit();
}

$user = $_SESSION['user'];

// Update settings if form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];

    $stmt = $db->prepare("UPDATE users SET full_name = :name, phone = :phone WHERE id = :id");
    $stmt->execute([
        'name' => $full_name,
        'phone' => $phone,
        'id' => $user['id']
    ]);

    // Update session
    $_SESSION['user']['full_name'] = $full_name;
    $_SESSION['user']['phone'] = $phone;

    $msg = "✅ Profile updated successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings | Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f7f9fc; }
        .container { max-width: 500px; margin: auto; background: white; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.05); border-radius: 10px; }
        h2 { color: #1a73e8; text-align: center; }
        label { display: block; margin-top: 20px; font-weight: bold; }
        input { width: 100%; padding: 10px; margin-top: 5px; border-radius: 6px; border: 1px solid #ccc; }
        button { margin-top: 30px; width: 100%; padding: 12px; background: #1a73e8; color: white; border: none; border-radius: 6px; cursor: pointer; }
        .msg { background: #e0ffe0; padding: 10px; margin-bottom: 20px; border-left: 4px solid #4caf50; }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Your Profile</h2>

    <?php if (isset($msg)) echo "<div class='msg'>$msg</div>"; ?>

    <form method="post">
        <label>Full Name</label>
        <input type="text" name="full_name" required value="<?= htmlspecialchars($user['full_name']) ?>">

        <label>Phone Number</label>
        <input type="text" name="phone" required value="<?= htmlspecialchars($user['phone']) ?>">

        <button type="submit">Update Settings</button>
    </form>
</div>

</body>
</html>
