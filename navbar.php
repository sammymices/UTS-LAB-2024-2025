<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style-navbar.css">
</head>
<body>
<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-brand">
            <span>Welcome back, <?= htmlspecialchars($username) ?>!</span>
        </div>

        <input type="checkbox" id="checkbox1" class="checkbox1 visuallyHidden" onclick="toggleMenu()">
        <label for="checkbox1" class="cursor-pointer md:hidden">
            <div class="hamburger hamburger1">
                <span class="bar bar1"></span>
                <span class="bar bar2"></span>
                <span class="bar bar3"></span>
                <span class="bar bar4"></span>
            </div>
        </label>

        <ul class="navbar-list md:flex hidden">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</nav>

<script>
    function toggleMenu() {
        var navbarList = document.querySelector('.navbar-list');
        navbarList.classList.toggle('active');
    }
</script>

</body>
</html>
