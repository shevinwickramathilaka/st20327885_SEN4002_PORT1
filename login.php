<?php
session_start();
include 'includes/config.php';
include 'includes/functions.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];  // your DB uses user_id
            $_SESSION['user_name'] = $user['name'];
            header("Location: user_dashboard.php");
            exit;
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "No account found with that email.";
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="auth-container">
    <h2>Login</h2>
    <?php if ($message) echo "<p class='error'>$message</p>"; ?>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don’t have an account? <a href="register.php">Register here</a></p>
</div>

<?php include 'includes/footer.php'; ?>