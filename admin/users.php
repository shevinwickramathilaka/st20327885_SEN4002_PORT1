<?php include 'header.php'; ?>

<?php
$users = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
?>

<h2>Registered Users</h2>
<a href="admin_dashboard.php">Back to Dashboard</a>
<table>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Registered At</th></tr>
<?php while($row=$users->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['user_id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>
