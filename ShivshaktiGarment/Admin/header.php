<?php
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>

<div class="topbar">
    <h2>Shivshakti Admin Panel</h2>
    <div>
        Welcome, <?php echo $_SESSION['admin']; ?>
        <a href="logout.php">Logout</a>
    </div>
</div>