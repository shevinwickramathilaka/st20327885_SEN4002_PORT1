<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price_from  = (float) $_POST['price_from'];
    $image_path  = trim($_POST['image_path']); // path only

    $stmt = $conn->prepare("
        INSERT INTO destinations (title, description, price_from, image_path)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("ssds", $title, $description, $price_from, $image_path);
    $stmt->execute();

    header("Location: destinations.php?added=1");
    exit;
}
?>

<h2>Add Destination</h2>
<p><a href="destinations.php">Back to Destinations</a></p>

<form method="POST">
    <label>Title</label>
    <input type="text" name="title" required>

    <label>Description</label>
    <textarea name="description" required></textarea>

    <label>Price From (LKR)</label>
    <input type="number" step="0.01" name="price_from" required>

    <label>Image Path (e.g. <code>uploads/destinations/sigiriya.jpg</code>)</label>
    <input type="text" name="image_path" required>

    <input type="submit" value="Add Destination">
</form>

<?php include 'footer.php'; ?>
