<?php
// Database configuration
$host = "localhost";     // usually "127.0.0.1"
$user = "root";          // your MySQL username
$pass = "";              // your MySQL password
$db   = "explore_lk";    // your database name

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Start session (only if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
