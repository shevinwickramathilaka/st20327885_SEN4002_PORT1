<?php

// Redirect helper
function redirect($url) {
    header("Location: $url");
    exit;
}

// Sanitize user input
function sanitize($conn, $data) {
    return mysqli_real_escape_string($conn, trim($data));
}

// Check if user is logged in
function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        redirect("login.php");
    }
}

// Display flash messages (success/error stored in session)
function displayMessage() {
    if (isset($_SESSION['success'])) {
        echo "<p class='success-msg'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p class='error-msg'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
}

?>
