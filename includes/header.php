<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'explore_lk');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Explore LK</title>
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="assets/logo.jpeg">
    <link rel="stylesheet" href="/explore_lk/assets/css/style.css">
    <script src="/explore_lk/assets/js/script.js"></script>
</head>
<body>
<header>
    <img src="/explore_lk/assets/logo.jpeg" alt="Explore LK Logo" class="logo">
    <nav>
        <a href="/explore_lk/index.php">Home</a>
        <a href="/explore_lk/destinations.php">Destinations</a>
        <a href="/explore_lk/contact.php">Contact</a>
        
        <?php if(isset($_SESSION['user_id'])): ?>
            <!-- If normal user logged in -->
            <a href="/explore_lk/user_dashboard.php">Dashboard</a>
            <a href="/explore_lk/logout.php">Logout</a>
        
        <?php elseif(isset($_SESSION['admin_id'])): ?>
            <!-- If admin logged in -->
            <a href="/explore_lk/admin/admin_dashboard.php">Admin Dashboard</a>
            <a href="/explore_lk/admin/logout.php">Logout</a>
        
        <?php else: ?>
            <!-- If nobody logged in -->
            <a href="/explore_lk/login.php">Login</a>
            <a href="/explore_lk/register.php">Register</a>
            <a href="/explore_lk/admin/admin_login.php">Admin Login</a>
        <?php endif; ?>
    </nav>
</header>
<main>
