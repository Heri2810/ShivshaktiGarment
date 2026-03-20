<?php
session_start();
include __DIR__ . "/../config/db.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: /ShivshaktiGarment/admin_login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>

/* Reset */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

/* Body */
body{
    display:flex;
    background:#f4f6f9;
}

/* Sidebar */
.sidebar{
    width:220px;
    height:100vh;
    background:#2c3e50;
    color:white;
    position:fixed;
    padding-top:20px;
}

.sidebar h2{
    text-align:center;
    margin-bottom:20px;
}

.sidebar a{
    display:block;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    transition:0.3s;
}

.sidebar a:hover{
    background:#34495e;
}

/* Header */
.header{
    width:100%;
    height:60px;
    background:#34495e;
    color:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 20px;
    position:fixed;
    left:220px;
    top:0;
}

/* Content */
.content{
    margin-left:220px;
    margin-top:70px;
    padding:20px;
    width:100%;
}

/* Cards */
.cards{
    display:flex;
    gap:20px;
    margin-top:20px;
}

.card{
    flex:1;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    text-align:center;
    font-size:18px;
    font-weight:bold;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

</style>

</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="index.php">Dashboard</a>
    <a href="lots.php">Lots</a>
    <a href="operations.php">Operations</a>
    <a href="logs.php">Logs</a>
    <a href="logout.php">Logout</a>
</div>

<!-- Header -->
<div class="header">
    <div>Shivshakti Garments</div>
    <div>Welcome, <?php echo $_SESSION['admin']; ?></div>
</div>

<!-- Content -->
<div class="content">
    <h2>Dashboard</h2>

<?php
$lots = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM lots"));
$ops  = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM operations"));
?>

<div class="cards">
    <div class="card">Lots: <?php echo $lots; ?></div>
    <div class="card">Operations: <?php echo $ops; ?></div>
</div>

</div>
<div id="notify" style="position:fixed; top:10px; right:10px; width:250px;"></div>

<script>
setInterval(()=>{
    fetch("admin_notification.php")
    .then(res=>res.text())
    .then(data=>{
        document.getElementById("notify").innerHTML = data;
    });
}, 3000);
</script>

</body>
</html>