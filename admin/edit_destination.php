<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
include 'header.php';

if (empty($_GET['destination_id'])) {
    header("Location: destinations.php");
    exit;
}

$destination_id = (int) $_GET['destination_id'];

// Fetch row
$stmt = $conn->prepare("SELECT destination_id, title, description, price_from, image_path FROM destinations WHERE destination_id = ?");
$stmt->bind_param("i", $destination_id);
$stmt->execute();
$result = $stmt->get_result();
$dest = $result->fetch_assoc();

if (!$dest) {
    echo "<p class='alert alert-error'>Destination not found.</p>";
    include 'footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price_from  = (float) $_POST['price_from'];
    $image_path  = trim($_POST['image_path']);

    $stmt2 = $conn->prepare("
        UPDATE destinations
        SET title = ?, description = ?, price_from = ?, image_path = ?
        WHERE destination_id = ?
    ");
    $stmt2->bind_param("ssdsi", $title, $description, $price_from, $image_path, $destination_id);
    $stmt2->execute();

    header("Location: destinations.php?updated=1");
    exit;
}
?>

<h2>Edit Destination</h2>
<p><a href="destinations.php">Back to Destinations</a></p>

<form method="POST">
    <label>Title</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($dest['title']); ?>" required>

    <label>Description</label>
    <textarea name="description" required><?php echo htmlspecialchars($dest['description']); ?></textarea>

    <label>Price From (LKR)</label>
    <input type="number" step="0.01" name="price_from" value="<?php echo htmlspecialchars($dest['price_from']); ?>" required>

    <label>Image Path (stored in DB)</label>
    <input type="text" name="image_path" value="<?php echo htmlspecialchars($dest['image_path']); ?>" required>

    <p>Preview:</p>
    <?php if (!empty($dest['image_path'])): ?>
        <img src="../assets/<?php echo htmlspecialchars($dest['image_path']); ?>" alt="" style="height:90px;">
    <?php endif; ?>

    <input type="submit" value="Update Destination">
</form>

<?php include 'footer.php'; ?>
