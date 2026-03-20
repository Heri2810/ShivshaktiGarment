<?php
session_start();

// saare session destroy karo
session_unset();
session_destroy();

// homepage par redirect
header("Location: /ShivshaktiGarment/Homepage.php");
exit();
?>