<?php
session_start();
include 'includes/config.php';
include 'includes/functions.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email exists
    $check = "SELECT * FROM users WHERE email='$email'";
    $res = mysqli_query($conn, $check);

    if (mysqli_num_rows($res) > 0) {
        $message = "Email already registered!";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['user_name'] = $name;
            header("Location: user_dashboard.php");
            exit;
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="auth-container">
    <h2>Register</h2>
    <?php if ($message) echo "<p class='error'>$message</p>"; ?>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

<?php include 'includes/footer.php'; ?>