<?php
session_start();
include '../includes/header.php';// include normal site header (adjust path if needed)
$conn = new mysqli('localhost', 'root', '', 'explore_lk');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare statement with correct column names
    $stmt = $conn->prepare("SELECT admin_id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($admin_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['admin_id'] = $admin_id;
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No such admin found!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Explore LK</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/js/main.js" defer></script>
</head>
<body>
    <div class="main-content">
        <h2>Admin Login</h2>

        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>