<?php
$password = "admin123";  // The password you want to hash
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;
?>