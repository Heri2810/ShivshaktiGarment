<?php
session_start();
include __DIR__ . "/../config/db.php";

if(!isset($_SESSION['admin'])){
    header("Location: /ShivshaktiGarment/admin_login.php");
    exit();
}

// GET ID
if(!isset($_GET['id'])){
    die("Invalid ID");
}

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM lots WHERE id=$id"));

if(!$data){
    die("Record not found");
}

// UPDATE
if(isset($_POST['update'])){
    mysqli_query($conn,"UPDATE lots SET 
    name='{$_POST['name']}',
    style='{$_POST['style']}',
    color='{$_POST['color']}',
    size_s='{$_POST['s']}',
    size_m='{$_POST['m']}',
    size_l='{$_POST['l']}',
    size_xl='{$_POST['xl']}'
    WHERE id=$id");

    header("Location: lots.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit LOT</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:#f4f6f9;
}

/* HEADER */
.header{
    width:100%;
    height:60px;
    background:#2c3e50;
    color:white;
    display:flex;
    align-items:center;
    padding:0 20px;
    font-size:20px;
    position:fixed;
    top:0;
    left:0;
}

/* SIDEBAR */
.sidebar{
    width:220px;
    height:100vh;
    background:#34495e;
    position:fixed;
    top:60px;
    left:0;
    padding-top:20px;
}

.sidebar a{
    display:block;
    color:white;
    padding:12px 20px;
    text-decoration:none;
}

.sidebar a:hover{
    background:#2c3e50;
}

/* CONTENT */
.content{
    margin-left:220px;
    margin-top:60px;
    padding:20px;
}

/* CARD */
.card{
    background:white;
    padding:25px;
    border-radius:10px;
    width:400px;
    margin:auto;
    box-shadow:0 5px 10px rgba(0,0,0,0.1);
}

/* FORM */
input{
    width:100%;
    padding:10px;
    margin:8px 0;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    width:100%;
    padding:10px;
    background:#2c3e50;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#1a252f;
}

</style>

</head>
<body>

<!-- HEADER -->
<div class="header">
    Shivshakti Garments - Admin Panel
</div>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="index.php">Dashboard</a>
    <a href="lots.php">Lots</a>
    <a href="operations.php">Operations</a>
    <a href="../logout.php">Logout</a>
</div>

<!-- CONTENT -->
<div class="content">

<div class="card">
<h2>Edit LOT</h2>

<form method="POST">
<input name="name" value="<?php echo $data['name']; ?>" required>
<input name="style" value="<?php echo $data['style']; ?>">
<input name="color" value="<?php echo $data['color']; ?>">
<input name="s" value="<?php echo $data['size_s']; ?>">
<input name="m" value="<?php echo $data['size_m']; ?>">
<input name="l" value="<?php echo $data['size_l']; ?>">
<input name="xl" value="<?php echo $data['size_xl']; ?>">

<button name="update">Update</button>
<a href="lots.php" class="cancel-btn" onclick="return confirm('Cancel editing?')">Cancel</a>
</form>

</div>

</div>

</body>
</html>