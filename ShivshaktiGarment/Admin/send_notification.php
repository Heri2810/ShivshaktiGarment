<?php
include "../config/db.php";

if(isset($_POST['bundle'], $_POST['pc'], $_POST['lot'], $_POST['username'])){

    $bundle = $_POST['bundle'];
    $pc = $_POST['pc'];
    $lot = $_POST['lot'];
    $username = $_POST['username'];

    // duplicate check
    $check = mysqli_query($conn,"SELECT * FROM history WHERE bundle='$bundle' AND lot='$lot'");
    
    if(mysqli_num_rows($check) > 0){
        echo "Already Done!";
        exit();
    }

    // insert
    $sql = "INSERT INTO history(bundle, pc, lot, username) 
            VALUES('$bundle','$pc','$lot','$username')";

    if(mysqli_query($conn,$sql)){

        // 🔥 notification message
        $msg = "$username ne $pc PC kiye ($lot - $bundle)";

        // optional: notification table (agar use kar rahe ho)
        mysqli_query($conn,"INSERT INTO notifications(message) VALUES('$msg')");

        echo $msg; // 👈 yahi alert me show hoga
    } else {
        echo "Error: ".mysqli_error($conn);
    }
}
?>