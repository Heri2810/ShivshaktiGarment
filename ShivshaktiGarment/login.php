<?php
session_start();
include "config/db.php";

$error = "";

if(isset($_POST['login'])){

    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE mobile='$mobile' 
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        $_SESSION['mobile'] = $mobile;
        $_SESSION['username'] = $row['name'];

        $username = $row['name'];

        // Notification
        $message = "$username has logged in";

        mysqli_query($conn,"INSERT INTO login_notifications(username,message,status,created_at) 
VALUES('$username','$message','0',NOW())");

        // ✅ Redirect
        header("Location: Homepage.php");
        exit();

    } else {
        $error = "Invalid Mobile or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>

<style>
body{
    margin:0;
    padding:0;
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
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

h2{
    margin-bottom:20px;
    color:#333;
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:8px;
}

input:focus{
    border-color:#4facfe;
}

button{
    width:100%;
    padding:12px;
    background:#28a745;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#218838;
}

.text{
    margin-top:15px;
    color:#555;
}

.register-btn{
    width:100%;
    padding:12px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:8px;
    margin-top:10px;
}

.register-btn:hover{
    background:#0056b3;
}

.error{
    color:red;
    margin-top:10px;
}
</style>

</head>
<body>

<div class="container">

<h2>Login</h2>

<form method="POST">
    <input type="text" name="mobile" placeholder="Enter Mobile" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button name="login">Login</button>
</form>

<!-- Error Message -->
<?php if($error != ""){ ?>
    <div class="error"><?php echo $error; ?></div>
<?php } ?>

<div class="text">
    Don't have an account?
</div>

<form action="register.php">
    <button class="register-btn">Create Account</button>
</form>

</div>

</body>
</html>