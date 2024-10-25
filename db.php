<?php
$host = 'localhost';
$dbname = 'u913450082_todo_app';
$user = 'u913450082_todo_app'; 
$pass = 'Gading135246_';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>
