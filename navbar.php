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
    <div class="navbar-container">
        <div class="navbar-brand">
            <span>Welcome back, <?= htmlspecialchars($username) ?>!</span>
            <span><?= ucfirst($current_page) ?></span>
        </div>
        <div class="burger-menu" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul class="navbar-list">
            <li><a href="dashboard.php" >Dashboard</a></li>
            <li><a href="profile.php" >Profile</a></li>
            <li><a href="about-us.php" >About Us</a></li>
            <li><a href="logout.php" >Logout</a></li>
        </ul>
    </div>
</nav>

<!-- Optional CSS for Navbar -->
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    /* Navbar Styling */
    .navbar {
        background-color: #333;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
    }

    .navbar-brand {
        color: white;
        font-size: 18px;
    }

    .burger-menu {
        display: none;
        cursor: pointer;
    }

    .burger-menu .bar {
        width: 25px;
        height: 3px;
        background-color: white;
        margin: 4px 0;
    }

    .navbar-list {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .navbar-list li {
        margin-right: 15px;
    }

    .navbar-list li a {
        color: white;
        text-decoration: none;
        padding: 10px;
    }

    .navbar-list li a:hover {
        text-shadow: 0 0 10px #fff,  
                         0 0 20px #fff,  
                         0 0 30px #ff00ff,  
                         0 0 40px #ff00ff,  
                         0 0 50px #ff00ff,  
                         0 0 60px #ff00ff,  
                         0 0 70px #ff00ff; 
        background-color: rgba(202, 220, 255, 0.2);
        transition-duration: 400ms;
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .burger-menu {
            display: block;
        }

        .navbar-list {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #333;
            width: 100%;
        }

        .navbar-list li {
            text-align: center;
            margin: 0;
            padding: 10px;
            border-bottom: 1px solid #444;
        }

        .navbar-list li a {
            display: block;
            padding: 10px 0;
        }

        .navbar-list.active {
            display: flex;
        }
    }
</style>

<!-- Optional JavaScript for Toggling Menu -->
<script>
    function toggleMenu() {
        var navbarList = document.querySelector('.navbar-list');
        navbarList.classList.toggle('active');
    }
</script>
