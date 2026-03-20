<?php
include "config/db.php";

$pass = password_hash("Admin@123", PASSWORD_DEFAULT);

mysqli_query($conn,"UPDATE admins SET password='$pass' WHERE username='admin'");

echo "Password Hashed Updated!";
?>