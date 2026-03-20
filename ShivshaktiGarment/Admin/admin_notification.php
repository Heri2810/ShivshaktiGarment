<?php
include "../config/db.php";

$data = mysqli_query($conn,"SELECT * FROM notifications ORDER BY id DESC LIMIT 5");

while($row = mysqli_fetch_assoc($data)){
    echo "<div style='background:#27ae60;color:white;padding:8px;margin:5px;border-radius:5px;'>
            {$row['message']}
          </div>";
}
?>