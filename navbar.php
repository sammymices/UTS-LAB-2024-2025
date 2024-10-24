<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil nama user dari sesi
$username = $_SESSION['username'];

// Ambil nama halaman saat ini
$current_page = basename($_SERVER['PHP_SELF'], ".php");
?>

<nav class="navbar">
    <ul>
        <li>Welcome back, <?= htmlspecialchars($username) ?>!</li>
        <li><?= ucfirst($current_page) ?></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="view_list.php">View To-Do List</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<!-- Optional CSS for Navbar -->
<style>
    .navbar {
        background-color: #333;
        overflow: hidden;
    }

    .navbar ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .navbar ul li {
        float: left;
        padding: 14px 20px;
        color: white;
    }

    .navbar ul li a {
        color: white;
        text-decoration: none;
        padding: 14px 20px;
    }

    .navbar ul li a:hover {
        background-color: #575757;
    }
</style>
