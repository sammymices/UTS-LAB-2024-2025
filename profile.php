<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data user
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    if ($stmt->execute([$username, $email, $user_id])) {
        echo "Profil berhasil diupdate!";
    } else {
        echo "Gagal mengupdate profil!";
    }
}
?>

<h2>Profil Anda</h2>
<form method="post" action="">
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    <button type="submit">Update Profil</button>
</form>
<a href="index.php">Kembali</a>
