<?php 
include 'header.php'; 

// Handle confirm/cancel actions
if(isset($_GET['action'], $_GET['id'])){
    $id = intval($_GET['id']);
    if($_GET['action'] == 'confirm') $conn->query("UPDATE bookings SET status='confirmed' WHERE booking_id=$id");
    if($_GET['action'] == 'cancel') $conn->query("UPDATE bookings SET status='cancelled' WHERE booking_id=$id");
    header("Location: bookings.php");
    exit;
}

// Fetch all bookings
$bookings = $conn->query("
    SELECT b.booking_id, u.name AS user, d.title AS destination, b.travelers, b.booking_date, b.status, b.special_requests
    FROM bookings b
    JOIN users u ON b.user_id=u.user_id
    JOIN destinations d ON b.destination_id=d.destination_id
    ORDER BY b.created_at DESC
");
?>

<h2>Manage Bookings</h2>
<a href="admin_dashboard.php">Back to Dashboard</a>

<table>
<tr>
    <th>ID</th>
    <th>User</th>
    <th>Destination</th>
    <th>Travelers</th>
    <th>Booking Date</th>
    <th>Special Requests</th>
    <th>Status</th>
    <th>Action</th>
</tr>
<?php while($row = $bookings->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['booking_id']; ?></td>
    <td><?php echo htmlspecialchars($row['user']); ?></td>
    <td><?php echo htmlspecialchars($row['destination']); ?></td>
    <td><?php echo $row['travelers']; ?></td>
    <td><?php echo $row['booking_date']; ?></td>
    <td><?php echo $row['special_requests']; ?></td>
    <td><?php echo ucfirst($row['status']); ?></td>
    <td>
        <?php if($row['status']=='pending'): ?>
            <a href="bookings.php?action=confirm&id=<?php echo $row['booking_id']; ?>">Confirm</a> | 
            <a href="bookings.php?action=cancel&id=<?php echo $row['booking_id']; ?>">Cancel</a>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>