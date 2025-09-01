<?php
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/header.php';
?>

<h1>All Destinations</h1>
<div class="destinations">
    <?php
    $result = $conn->query("SELECT * FROM destinations ORDER BY title ASC");
    while($row = $result->fetch_assoc()): ?>
        <div class="destination-card">
            <img src="assets/<?php echo $row['image_path']; ?>" 
                 alt="<?php echo $row['title']; ?>">
            <h3><?php echo $row['title']; ?></h3>
            <p>Price: LKR <?php echo number_format($row['price_from'], 2); ?></p>
            <a href="destination.php?id=<?php echo $row['destination_id']; ?>">View Details</a>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>