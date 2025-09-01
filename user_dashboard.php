<?php
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");

include 'includes/config.php';
include 'includes/functions.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];
$bookings = $conn->query("
    SELECT b.booking_id, d.title AS destination, b.travelers, b.booking_date, b.status 
    FROM bookings b
    JOIN destinations d ON b.destination_id = d.destination_id
    WHERE b.user_id = $user_id
    ORDER BY b.created_at DESC
");
?>

<h2>My Bookings</h2>
<table border="1">
<tr>
    <th>ID</th>
    <th>Destination</th>
    <th>Travelers</th>
    <th>Booking Date</th>
    <th>Status</th>
</tr>
<?php while($row = $bookings->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['booking_id']; ?></td>
    <td><?php echo $row['destination']; ?></td>
    <td><?php echo $row['travelers']; ?></td>
    <td><?php echo $row['booking_date']; ?></td>
    <td><?php echo ucfirst($row['status']); ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php include 'includes/footer.php'; ?>