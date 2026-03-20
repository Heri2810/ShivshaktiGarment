<?php
session_start();
include __DIR__ . "/../config/db.php";

if(!isset($_SESSION['admin'])){
    header("Location: /ShivshaktiGarment/admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Logs</title>

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

tr:hover{
    background:#f1f1f1;
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
    <a href="admin_logs.php">Admin Logs</a>
    <a href="../logout.php">Logout</a>
</div>

<!-- CONTENT -->
<div class="content">

<h2>Admin Logs</h2>

<table>
<tr>
<th>ID</th>
<th>Admin ID</th>
<th>Action</th>
<th>Date</th>
</tr>

<?php
$res = mysqli_query($conn,"SELECT * FROM admin_logs ORDER BY id DESC");

while($row=mysqli_fetch_assoc($res)){
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['admin_id']; ?></td>
<td><?php echo $row['action']; ?></td>
<td><?php echo $row['created_at']; ?></td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>