<?php
// booking.php – handles booking form submission

session_start();
include 'includes/config.php';
include 'includes/functions.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=Please login to make a booking");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id          = $_SESSION['user_id'];
    $destination_id   = intval($_POST['destination_id']);
    $booking_date     = mysqli_real_escape_string($conn, $_POST['booking_date']); // ✅ matches DB column
    $travelers        = intval($_POST['travelers']);
    $special_requests = mysqli_real_escape_string($conn, $_POST['requests']);

    // Insert booking
    $sql = "INSERT INTO bookings (user_id, destination_id, booking_date, travelers, special_requests, status) 
            VALUES ('$user_id', '$destination_id', '$booking_date', '$travelers', '$special_requests', 'pending')";

    if (mysqli_query($conn, $sql)) {
        header("Location: user_dashboard.php?success=Booking placed successfully");
        exit;
    } else {
        header("Location: destination.php?id=$destination_id&error=Booking failed, try again");
        exit;
    }
} else {
    header("Location: destinations.php");
    exit;
}
?>