<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];

    $stmt = $pdo->prepare("INSERT INTO lists (user_id, title, description, deadline) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $description, $deadline]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create To-Do List</title>
    <link rel="stylesheet" href="css/style-create-list.css">
</head>
<body>

<h2>Buat To-Do List Baru</h2>

<form method="POST" action="create_list.php">
    <label for="title">Judul To-Do List</label>
    <input type="text" id="title" name="title" placeholder="Masukkan judul" required>

    <label for="description">Deskripsi</label>
    <textarea id="description" name="description" placeholder="Masukkan deskripsi tugas" required></textarea>

    <label for="deadline">Deadline</label>
    <input type="datetime-local" id="deadline" name="deadline" required>

    <button type="submit">Buat To-Do List</button>
</form>

<a href="index.php" class="back-link">Kembali ke Dashboard</a>

</body>
</html>
