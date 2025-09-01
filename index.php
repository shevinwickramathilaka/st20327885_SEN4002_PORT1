<?php
include 'includes/config.php';
include 'includes/functions.php';
include 'includes/header.php';
?>

<?php if(isset($_SESSION['user_id'])): 
    // Fetch logged-in user name
    $user_id = $_SESSION['user_id'];
    $user_result = $conn->query("SELECT name FROM users WHERE user_id = $user_id");
    $user = $user_result->fetch_assoc();
?>
    <div class="welcome-message">
        Welcome back, <?php echo htmlspecialchars($user['name']); ?>!
    </div>
<?php endif; ?>

<h1>Explore.lk</h1>
<div class="destinations">
    <?php
    $result = $conn->query("SELECT * FROM destinations ORDER BY created_at DESC LIMIT 4");
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
