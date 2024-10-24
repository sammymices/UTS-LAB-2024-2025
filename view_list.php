<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$list_id = $_GET['list_id'];
$user_id = $_SESSION['user_id'];

// Ambil data list dan tugas
$stmt = $pdo->prepare("SELECT * FROM lists WHERE id = ? AND user_id = ?");
$stmt->execute([$list_id, $user_id]);
$list = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$list) {
    echo "To-Do List tidak ditemukan!";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE list_id = ?");
$stmt->execute([$list_id]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<form method="get" action="">
    <input type="hidden" name="list_id" value="<?= $list_id ?>">
    <input type="text" name="search" placeholder="Cari tugas..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <select name="status">
        <option value="all">Semua</option>
        <option value="completed">Selesai</option>
        <option value="incomplete">Belum Selesai</option>
    </select>
    <button type="submit">Cari/Filter</button>
</form>


<h2>To-Do List: <?= htmlspecialchars($list['title']) ?></h2>

<form method="post" action="add_task.php">
    <input type="text" name="task" placeholder="Tambahkan tugas baru" required>
    <input type="hidden" name="list_id" value="<?= $list_id ?>">
    <button type="submit">Tambah Tugas</button>
</form>

<h3>Daftar Tugas:</h3>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <?= htmlspecialchars($task['task']) ?>
            <a href="delete_task.php?task_id=<?= $task['id'] ?>">Hapus</a>
        </li>
    <?php endforeach; ?>
</ul>

<a href="index.php">Kembali</a>
