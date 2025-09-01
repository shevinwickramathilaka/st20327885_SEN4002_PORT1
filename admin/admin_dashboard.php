<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit;
}

include 'header.php';

// Dashboard counts
$total_dest = $conn->query("SELECT COUNT(*) AS total FROM destinations")->fetch_assoc()['total'];
$total_bookings = $conn->query("SELECT COUNT(*) AS total FROM bookings")->fetch_assoc()['total'];
$pending = $conn->query("SELECT COUNT(*) AS total FROM bookings WHERE status='pending'")->fetch_assoc()['total'];
$confirmed = $conn->query("SELECT COUNT(*) AS total FROM bookings WHERE status='confirmed'")->fetch_assoc()['total'];

// Latest bookings
$latest_bookings = $conn->query("
    SELECT b.booking_id, u.name AS user, d.title AS destination, b.travelers, b.booking_date, b.status
    FROM bookings b
    JOIN users u ON b.user_id = u.user_id
    JOIN destinations d ON b.destination_id = d.destination_id
    ORDER BY b.created_at DESC
    LIMIT 5
");

// Latest destinations
$latest_dest = $conn->query("SELECT * FROM destinations ORDER BY created_at DESC LIMIT 5");
?>

<div class="cards-container">
    <div class="card">
        <h2><?php echo $total_dest; ?></h2>
        <p>Total Destinations</p>
    </div>
    <div class="card">
        <h2><?php echo $total_bookings; ?></h2>
        <p>Total Bookings</p>
    </div>
    <div class="card">
        <h2><?php echo $pending; ?></h2>
        <p>Pending Requests</p>
    </div>
    <div class="card">
        <h2><?php echo $confirmed; ?></h2>
        <p>Confirmed Bookings</p>
    </div>
</div>

<h2>Latest Bookings</h2>
<table>
<tr>
    <th>ID</th><th>User</th><th>Destination</th><th>Travelers</th><th>Booking Date</th><th>Status</th><th>Action</th>
</tr>
<?php while($row = $latest_bookings->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['booking_id']; ?></td>
    <td><?php echo htmlspecialchars($row['user']); ?></td>
    <td><?php echo htmlspecialchars($row['destination']); ?></td>
    <td><?php echo $row['travelers']; ?></td>
    <td><?php echo $row['booking_date']; ?></td>
    <td><?php echo ucfirst($row['status']); ?></td>
    <td>
        <?php if($row['status'] == 'pending'): ?>
            <a href="bookings.php?action=confirm&id=<?php echo $row['booking_id']; ?>">Confirm</a> |
            <a href="bookings.php?action=cancel&id=<?php echo $row['booking_id']; ?>">Cancel</a>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>

<h2>Latest Destinations</h2>
<table>
<tr>
    <th>ID</th><th>Title</th><th>Price</th><th>Actions</th>
</tr>
<?php while($d = $latest_dest->fetch_assoc()): ?>
<tr>
    <td><?php echo $d['destination_id']; ?></td>
    <td><?php echo htmlspecialchars($d['title']); ?></td>
    <td>LKR <?php echo number_format($d['price_from'], 2); ?></td>
    <td>
        <a href="edit_destination.php?destination_id=<?php echo $d['destination_id']; ?>">Edit</a> |
        <a href="destinations.php?action=delete&destination_id=<?php echo $d['destination_id']; ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>
