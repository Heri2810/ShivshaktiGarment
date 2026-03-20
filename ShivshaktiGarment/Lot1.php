<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$lotName = "LOT 1";

// ✅ Get completed bundles
$doneData = mysqli_query($conn,"SELECT bundle FROM history WHERE lot='$lotName'");
$doneBundles = [];
while($row = mysqli_fetch_assoc($doneData)){
    $doneBundles[] = $row['bundle'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $lotName; ?></title>

<style>
body{ font-family:Arial; background:#f0f8ff; padding:20px; }
table{ border-collapse:collapse; margin:auto; background:white; }
th,td{ border:1px solid #999; padding:8px 12px; text-align:center; }
th{ background:#87CEEB; }
.ok-btn{ background:green; color:white; border:none; padding:5px 10px; cursor:pointer; border-radius:5px; }
.ok-btn:disabled{ background:gray; cursor:not-allowed; }
</style>

</head>
<body>

<h2 style="text-align:center;"><?php echo $lotName; ?></h2>

<table>
<tr>
<th colspan="3">S</th>
<th colspan="3">M</th>
<th colspan="3">L</th>
<th colspan="3">XL</th>
<th colspan="3">XXL</th>
</tr>

<tr>
<th>BUNDLE</th><th>PC</th><th>OK</th>
<th>BUNDLE</th><th>PC</th><th>OK</th>
<th>BUNDLE</th><th>PC</th><th>OK</th>
<th>BUNDLE</th><th>PC</th><th>OK</th>
<th>BUNDLE</th><th>PC</th><th>OK</th>
</tr>

<?php
for($i=1;$i<=10;$i++){
    echo "<tr>";
    $sizes = ["S","M","L","XL","XXL"];
    
    foreach($sizes as $size){
        $bundle = $size.$i;
        $pc = 30;

        $disabled = in_array($bundle, $doneBundles) ? "disabled" : "";
        $text = in_array($bundle, $doneBundles) ? "Done" : "OK";

        echo "<td>$bundle</td>";
        echo "<td>$pc</td>";
        echo "<td>
        <button class='ok-btn' $disabled 
        onclick='sendOk(this,\"$bundle\",\"$pc\",\"$lotName\")'>$text</button>
        </td>";
    }
    echo "</tr>";
}
?>
</table>

<script>
let username = "<?php echo $username; ?>";

function sendOk(button, bundle, pc, lot){
    fetch("Admin/send_notification.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:"bundle="+bundle+"&pc="+pc+"&lot="+lot+"&username="+username
    })
    .then(res=>res.text())
   .then(data=>{
    alert(data); // 👈 ab yaha custom message aayega

    if(data.includes("ne")){ // success check
        button.disabled = true;
        button.innerHTML = "Done";
    }
});
}
</script>

</body>
</html>