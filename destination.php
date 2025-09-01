<?php
session_start();
include 'includes/config.php';
include 'includes/functions.php';

// Get destination ID from URL
if (!isset($_GET['id'])) {
    header("Location: destinations.php");
    exit;
}
$destination_id = intval($_GET['id']);

// Fetch destination details
$sql = "SELECT * FROM destinations WHERE destination_id = $destination_id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: destinations.php?error=Destination not found");
    exit;
}
$destination = mysqli_fetch_assoc($result);

include 'includes/header.php';
?>

<div class="destination-wrapper">
    <div class="destination-details">
        <h1><?php echo htmlspecialchars($destination['title']); ?></h1>
        <img src="assets/<?php echo htmlspecialchars($destination['image_path']); ?>" 
             alt="<?php echo htmlspecialchars($destination['title']); ?>" 
             class="destination-img">
        <p><?php echo nl2br(htmlspecialchars($destination['description'])); ?></p>
        <p><strong>Price:</strong> LKR <?php echo number_format($destination['price_from'], 2); ?></p>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="booking-card">
        <h2>Book Your Trip</h2>
        <form method="POST" action="booking.php" id="bookingForm">
            <input type="hidden" name="destination_id" value="<?php echo $destination['destination_id']; ?>">

            <label for="booking_date">Travel Date:</label>
            <input type="date" id="booking_date" name="booking_date" required>

            <label for="travelers">Number of Travelers:</label>
            <input type="number" id="travelers" name="travelers" min="1" value="1" required>

            <label for="requests">Special Requests:</label>
            <textarea id="requests" name="requests" rows="4"></textarea>

            <button type="submit">Book Now</button>
        </form>
    </div>
    <?php else: ?>
        <p class="login-prompt"><a href="login.php">Login</a> to make a booking.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>