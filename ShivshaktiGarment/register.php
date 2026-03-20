<?php
include "config/db.php";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $check = mysqli_query($conn,"SELECT * FROM users WHERE mobile='$mobile'");

    if(mysqli_num_rows($check) > 0){

        echo "<script>alert('Mobile already registered');</script>";

    } else {

        mysqli_query($conn,"INSERT INTO users(name,mobile,password) 
        VALUES('$name','$mobile','$password')");

        echo "<script>
        alert('Registration Successful, Please Login');
        window.location='login.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<style>
body{
    margin:0;
    font-family: Arial;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
}
.container{
    width:320px;
    margin:100px auto;
    padding:30px;
    background:white;
    border-radius:15px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}
input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:12px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:8px;
}
.login-btn{
    display:block;
    margin-top:10px;
    padding:12px;
    background:#28a745;
    color:white;
    text-decoration:none;
    border-radius:8px;
}
</style>

</head>
<body>

<div class="container">
<h2>Create Account</h2>

<form method="POST">
<input type="text" name="name" placeholder="Enter Name" required>
<input type="text" name="mobile" placeholder="Enter Mobile" required>
<input type="password" name="password" placeholder="Enter Password" required>
<button name="register">Register</button>
</form>

<p>Already have an account?</p>
<a href="login.php" class="login-btn">Login</a>

</div>

</body>
</html>