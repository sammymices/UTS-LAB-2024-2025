<?php
include 'navbar.php';

include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

function markTaskAsCompleted($pdo, $list) {
    $stmt = $pdo->prepare("INSERT INTO completed_tasks (user_id, title, description, deadline, completed_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$list['user_id'], $list['title'], $list['description'], $list['deadline']]);

    $stmt = $pdo->prepare("DELETE FROM lists WHERE id = ?");
    $stmt->execute([$list['id']]);
}

$stmt = $pdo->prepare("SELECT * FROM lists WHERE user_id = ? AND is_completed = 0 ORDER BY deadline ASC");
$stmt->execute([$user_id]);
$lists = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = "Guest";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['list_id'])) {
    $list_id = $_POST['list_id'];

    $stmt = $pdo->prepare("SELECT * FROM lists WHERE id = ? AND user_id = ?");
    $stmt->execute([$list_id, $user_id]);
    $list = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($list) {
        markTaskAsCompleted($pdo, $list);
        
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style-index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            background-image: url("css/gambar/background1.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            display: flex;
            flex-direction: column;
        }
        

    </style>

</head>
<body>
   <br>
    <br>
    <br>
    <br>
<div id="bungkus">
<a href="create_list.php">Buat To-Do List Baru</a>
<h3>To-Do Lists:</h3>
<ul>
    <?php foreach ($lists as $list): ?>
        <?php
        $current_time = new DateTime();
        $deadline_time = new DateTime($list['deadline']);
        $is_overdue = $current_time > $deadline_time;
        ?>

        <li class="todo-list-item <?= $is_overdue ? 'overdue' : '' ?>">
            <div class="todo-title"><?= htmlspecialchars($list['title']) ?></div>
            <div class="todo-description"><?= htmlspecialchars($list['description']) ?></div>
            <div class="todo-deadline">Deadline: <?= htmlspecialchars($list['deadline']) ?></div>
            <div class="todo-actions">
                <form method="post" action="" style="display:inline;">
                    <input type="hidden" name="list_id" value="<?= $list['id'] ?>">
                    <button type="submit" class="done">✔ Selesai</button>
                </form>
                <a href="delete_list.php?list_id=<?= $list['id'] ?>" class="delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus to-do list ini?')">Delete</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<a href="logout.php">Logout</a>
</div>

</body>
</html>
