<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit;
}
$conn = new mysqli('localhost', 'root', '', 'explore_lk');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Explore LK</title>
    <!-- Use admin.css instead of frontend style.css -->
    <link rel="stylesheet" href="../assets/css/admin.css">
        <script src="../assets/js/main.js" defer></script>
</head>
<body>
<header>
    <h1>Explore LK Admin Panel</h1>
    <nav>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="destinations.php">Destinations</a>
        <a href="bookings.php">Bookings</a>
        <a href="users.php">Users</a>
        <a href="admin_logout.php">Logout</a>
    </nav>
</header>
<main class="main-content">
