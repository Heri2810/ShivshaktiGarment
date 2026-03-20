<?php
session_start();

// If user is not logged in, redirect to login page
if(!isset($_SESSION['mobile'])){
    header("Location: login.php");
    exit();
}

// Check if admin is already logged in
if(isset($_SESSION['admins_id'])){
    header("Location: Admin/index.php"); // admin dashboard
    exit();
}

$user_mobile = $_SESSION['mobile'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shivshakti Garments - Home</title>
<style>
/* ----------- Page Background ----------- */
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #74ebd5, #ACB6E5);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ----------- Navbar ----------- */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background: rgba(0,0,0,0.7);
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.navbar .title {
    color: white;
    font-size: 28px;
    font-weight: bold;
    text-align: center;
    flex: 1;
}

.navbar .nav-links {
    display: flex;
    gap: 20px;
}

.navbar .nav-links a {
    text-decoration: none;
    color: white;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 6px;
    transition: 0.3s;
}

.navbar .nav-links a:hover {
    background: #74ebd5;
    color: #333;
}

/* ----------- Welcome Message ----------- */
.welcome {
    text-align: center;
    margin-top: 40px;
    font-size: 22px;
    color: #fff;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
}

/* ----------- Main Buttons / Categories ----------- */
.category-buttons {
    display: flex;
    justify-content: center;
    gap: 50px;
    margin: 80px auto 0 auto;
    flex-wrap: wrap;
}

.category-buttons a {
    text-decoration: none;
    text-align: center;
    background: #fff;
    color: #74ebd5;
    font-size: 18px;
    font-weight: bold;
    border-radius: 12px;
    padding: 20px 30px;
    width: 180px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    transition: 0.3s;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.category-buttons a:hover {
    background: #4ac1c1;
    color: #fff;
    transform: scale(1.05);
}

/* ----------- Category Icons ----------- */
.category-buttons img {
    width: 100px;
    height: 100px;
    margin-bottom: 15px;
}

/* ----------- Footer ----------- */
footer {
    text-align: center;
    padding: 15px 0;
    background: rgba(0,0,0,0.5);
    color: white;
    font-weight: 500;
    position: fixed;
    bottom: 0;
    width: 100%;
}

footer a {
    color: #74ebd5;
    text-decoration: none;
    margin-left: 15px;
}

footer a:hover {
    color: #fff;
    text-decoration: underline;
}

/* ----------- Responsive ----------- */
@media (max-width: 600px){
    .navbar { flex-direction: column; gap: 10px; padding: 15px 20px; }
    .navbar .title { font-size: 24px; }
    .category-buttons { gap: 20px; margin-top: 50px; }
    .category-buttons a { width: 140px; font-size: 16px; padding: 15px; }
    .category-buttons img { width: 60px; height: 60px; margin-bottom: 10px; }
    .welcome { font-size: 18px; margin-top: 30px; }
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div></div> <!-- Empty left space -->
    <div class="title">Shivshakti Garments</div>
    <div class="nav-links">
        <a href="admin_login.php">Admin</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- Welcome Message -->
<div class="welcome">
    Welcome, <?php echo $_SESSION['username']; ?>! Explore our latest collection.
</div>

<!-- Categories -->
<div class="category-buttons">
    <a href="shirt.php">
        <img src="image/Shirt.png" alt="Shirts">
        Shirts
    </a>
    <a href="boxer.php">
        <img src="image/boxer.png" alt="Boxers">
        Boxers
    </a>
</div>

<!-- Footer -->
<footer>
    &copy; <?php echo date('Y'); ?> Shivshakti Garments. All rights reserved.
    <a href="history.php">History</a>
</footer>

</body>
</html>