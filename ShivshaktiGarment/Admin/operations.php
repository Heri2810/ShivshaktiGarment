<?php
session_start();
include __DIR__ . "/../config/db.php";

if(!isset($_SESSION['admin'])){
    header("Location: /ShivshaktiGarment/admin_login.php");
    exit();
}

// INSERT
if(isset($_POST['add'])){
    $operation = $_POST['operation'];
    $rate = $_POST['rate'];

    mysqli_query($conn,"INSERT INTO operations(operation_name,rate) VALUES('$operation','$rate')");
    header("Location: operations.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Operations</title>

<style>

/* RESET */
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
    z-index:1000;
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

/* FORM */
.form-box{
    background:white;
    padding:20px;
    border-radius:10px;
    width:400px;
    margin-bottom:20px;
    box-shadow:0 5px 10px rgba(0,0,0,0.1);
}

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

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 5px 10px rgba(0,0,0,0.1);
}

th,td{
    padding:12px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#2c3e50;
    color:white;
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

<h2>Operations Management</h2>

<!-- FORM -->
<div class="form-box">
<form method="POST">
<input type="text" name="operation" placeholder="Operation Name (Cutting, Stitching)" required>
<input type="number" name="rate" placeholder="Rate" required>
<button name="add">Add Operation</button>
</form>
</div>

<!-- TABLE -->
<table>
<tr>
<th>ID</th>
<th>Operation</th>
<th>Rate</th>
</tr>

<?php
$res = mysqli_query($conn,"SELECT * FROM operations ORDER BY id DESC");

while($row=mysqli_fetch_assoc($res)){
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['operation_name']; ?></td>
<td><?php echo $row['rate']; ?></td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>