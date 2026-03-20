<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include __DIR__ . "/config/db.php";

if(isset($_POST['login'])){
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    $q = mysqli_query($conn, "SELECT * FROM admins WHERE username='$user'");

    if(mysqli_num_rows($q) > 0){
        $row = mysqli_fetch_assoc($q);

        if(password_verify($pass, $row['password'])){
            
            $_SESSION['admin'] = $row['username'];
            $_SESSION['admin_id'] = $row['id'];

            mysqli_query($conn,"INSERT INTO admin_logs(admin_id,action) VALUES({$row['id']},'Login')");

            header("Location: /ShivshaktiGarment/Admin/index.php");
            exit();

        } else {
            $error = "❌ Wrong Password!";
        }

    } else {
        $error = "❌ Username not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
body{
    margin:0;
    padding:0;
    font-family: Arial, sans-serif;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.login-box{
    background:#fff;
    padding:40px;
    width:320px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    text-align:center;
}

.login-box h2{
    margin-bottom:20px;
    color:#333;
}

.login-box input{
    width:100%;
    padding:10px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:5px;
    outline:none;
    transition:0.3s;
}

.login-box input:focus{
    border-color:#667eea;
}

.login-box button{
    width:100%;
    padding:10px;
    background:#667eea;
    color:#fff;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
    transition:0.3s;
}

.login-box button:hover{
    background:#5a67d8;
}

.error{
    color:red;
    margin-bottom:10px;
    font-size:14px;
}
</style>

</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>
</div>

</body>
</html>