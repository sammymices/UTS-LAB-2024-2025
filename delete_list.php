<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['list_id'])) {
    $list_id = $_GET['list_id'];

    $stmt = $pdo->prepare("DELETE FROM lists WHERE id = ? AND user_id = ?");
    
    $stmt->execute([$list_id, $_SESSION['user_id']]);

    header("Location: index.php");
    exit;
} else {
    echo "List ID tidak ditemukan!";
}
?>