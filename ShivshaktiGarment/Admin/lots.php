<?php
session_start();
include "../config/db.php";

// DELETE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM lots WHERE id=$id");
    header("Location: lots.php");
}

// UPDATE
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $lot = $_POST['lot_name'];
    mysqli_query($conn,"UPDATE lots SET lot_name='$lot' WHERE id=$id");
    header("Location: lots.php");
}

// ADD
if(isset($_POST['add'])){
    $lot = $_POST['lot_name'];
    mysqli_query($conn,"INSERT INTO lots(lot_name) VALUES('$lot')");
    header("Location: lots.php");
}

// FETCH DATA (ADVANCED)
$data = mysqli_query($conn,"
SELECT 
    id,
    lot_name,
    SUM(pc) as total_pc,
    GROUP_CONCAT(CONCAT(username,'(',pc,')') SEPARATOR ', ') as users
FROM lots
GROUP BY lot_name
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin - Lots</title>

<style>
body{
    margin:0;
    font-family:Arial;
    display:flex;
}

/* Sidebar */
.sidebar{
    width:220px;
    height:100vh;
    background:#2c3e50;
    color:white;
    padding:20px;
}
.sidebar h2{
    text-align:center;
}
.sidebar a{
    display:block;
    color:white;
    padding:10px;
    text-decoration:none;
    margin:5px 0;
}
.sidebar a:hover{
    background:#34495e;
}

/* Main */
.main{
    flex:1;
    background:#f4f6f9;
}

/* Header */
.header{
    background:#34495e;
    color:white;
    padding:15px;
    font-size:20px;
}

/* Content */
.content{
    padding:20px;
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

th,td{
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
}

th{
    background:#3498db;
    color:white;
}

/* Buttons */
button{
    padding:6px 10px;
    border:none;
    cursor:pointer;
    border-radius:4px;
}

.add-btn{ background:green; color:white; }
.update-btn{ background:orange; color:white; }
.delete-btn{ background:red; color:white; }

/* Form */
.add-form{
    margin-bottom:20px;
}
.add-form input{
    padding:8px;
    width:200px;
}
</style>

</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="index.php">Dashboard</a>
    <a href="lots.php">Manage Lots</a>
    <a href="admin_history.php">History</a>
    <a href="../logout.php">Logout</a>
</div>

<!-- Main -->
<div class="main">

    <!-- Header -->
    <div class="header">
        📦 Lot Management
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Add Lot -->
        <form method="POST" class="add-form">
            <input type="text" name="lot_name" placeholder="Enter Lot Name" required>
            <button name="add" class="add-btn">Add Lot</button>
        </form>

        <!-- Table -->
        <table>
            <tr>
                <th>ID</th>
                <th>Lot Name</th>
                <th>Total PC</th>
                <th>User Work</th>
                <th>Action</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($data)){ ?>
            <tr>

                <td><?php echo $row['id']; ?></td>

                <td>
                    <form method="POST" style="display:flex; gap:5px; justify-content:center;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="lot_name" value="<?php echo $row['lot_name']; ?>">
                        <button name="update" class="update-btn">Update</button>
                    </form>
                </td>

                <td><?php echo $row['total_pc']; ?></td>

                <td>
                    <?php echo $row['users'] ? $row['users'] : "No Work"; ?>
                </td>

                <td>
                    <a href="lots.php?delete=<?php echo $row['id']; ?>" 
                    onclick="return confirm('Delete this lot?')">
                        <button class="delete-btn">Delete</button>
                    </a>
                </td>

            </tr>
            <?php } ?>

        </table>

    </div>
</div>

</body>
</html>