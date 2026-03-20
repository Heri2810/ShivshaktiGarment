<?php
include "../config/db.php";

$data = mysqli_query($conn, "SELECT * FROM history ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

/* LAYOUT */
body{
    display:flex;
}

/* SIDEBAR */
.sidebar{
    width:220px;
    height:100vh;
    background:#2c3e50;
    color:white;
    padding:20px;
    position:fixed;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:10px;
    margin:10px 0;
    border-radius:5px;
}

.sidebar a:hover{
    background:#34495e;
}

/* HEADER */
.header{
    position:fixed;
    left:220px;
    top:0;
    width:calc(100% - 220px);
    background:#3498db;
    color:white;
    padding:15px;
    font-size:18px;
}

/* MAIN CONTENT */
.main{
    margin-left:220px;
    margin-top:60px;
    padding:20px;
    width:100%;
    background:#f4f6f9;
    min-height:100vh;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

th, td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

th{
    background:#3498db;
    color:white;
}

tr:hover{
    background:#f1f1f1;
}

h2{
    margin-bottom:15px;
}

</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Admin</h2>
    <a href="index.php">Dashboard</a>
    <a href="admin_history.php">History</a>
    <a href="admin_notification">Notifications</a>
    <a href="../logout.php">Logout</a>
</div>

<!-- HEADER -->
<div class="header">
    Welcome Admin Panel
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <h2>History Data</h2>

    <table>
      <tr>
        <th>User</th>
        <th>Bundle</th>
        <th>PC</th>
        <th>Lot</th>
        <th>Time</th>
      </tr>

      <?php while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
          <td><?php echo $row['username']; ?></td>
          <td><?php echo $row['bundle']; ?></td>
          <td><?php echo $row['pc']; ?></td>
          <td><?php echo $row['lot']; ?></td>
          <td><?php echo $row['created_at']; ?></td>
        </tr>
      <?php } ?>

    </table>

</div>

</body>
</html>