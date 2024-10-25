<?php
include 'navbar.php';
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style-profile.css">
    <style>
     body {
    margin: 0;
    padding: 0;
    height: 100vh;
    justify-content: center;
    align-items: center;
    background-image: url("css/gambar/background1.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; 
    display: flex;
    flex-direction: column;
    font-family: Arial, sans-serif;
}
</style>
</head>
<body>
  
<form method="post" action="">
    <h2>Profil Anda</h2>
    <r>email yang ingin dirubah</r>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
    <button type="submit">Update Profil</button>
    <a href="dashboard.php">Kembali</a>  
</form>

</body>

</html>



