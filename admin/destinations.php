<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include 'header.php'; // contains $conn

// Handle delete
if (isset($_GET['action'], $_GET['destination_id']) && $_GET['action'] === 'delete') {
    $destination_id = (int) $_GET['destination_id'];
    $stmt = $conn->prepare("DELETE FROM destinations WHERE destination_id = ?");
    $stmt->bind_param("i", $destination_id);
    $stmt->execute();
    header("Location: destinations.php?deleted=1");
    exit;
}

// Fetch all destinations
$destinations = $conn->query("
    SELECT destination_id, title, price_from, image_path, description, created_at
    FROM destinations
    ORDER BY created_at DESC
");
?>
<h2>Manage Destinations</h2>
<p>
    <a href="admin_dashboard.php">Back to Dashboard</a> |
    <a href="add_destination.php">Add New</a>
</p>

<?php if (isset($_GET['deleted'])): ?>
<div class="alert alert-success">Destination deleted.</div>
<?php endif; ?>
<?php if (isset($_GET['added'])): ?>
<div class="alert alert-success">Destination added.</div>
<?php endif; ?>
<?php if (isset($_GET['updated'])): ?>
<div class="alert alert-success">Destination updated.</div>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Preview</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price (LKR)</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>
    <?php while($row = $destinations->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['destination_id']; ?></td>
        <td>
            <?php if (!empty($row['image_path'])): ?>
                <img src="../assets/<?php echo htmlspecialchars($row['image_path']); ?>" alt="" style="height:50px;">
            <?php endif; ?>
        </td>
        <td><?php echo htmlspecialchars($row['title']); ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo number_format($row['price_from'], 2); ?></td>
        <td><?php echo $row['created_at']; ?></td>
        <td>
            <a href="edit_destination.php?destination_id=<?php echo $row['destination_id']; ?>">Edit</a> |
            <a class="confirm-action" href="destinations.php?action=delete&destination_id=<?php echo $row['destination_id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>
