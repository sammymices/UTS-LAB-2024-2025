<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-login.css">
    <title>Login</title>
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
    <h2>Welcome To TODOLIST</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <a href="register.php">Belum mempunyai akun? Register sekarang</a>
</form>

</body>
</html>
