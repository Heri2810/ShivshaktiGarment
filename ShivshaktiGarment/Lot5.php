<!DOCTYPE html>
<html>
<head>
<title>LOT 5</title>

<style>

body{
font-family:Arial;
background:#f0f8ff;
padding:20px;
}

table{
border-collapse:collapse;
margin:auto;
background:white;
}

th,td{
border:1px solid #999;
padding:8px 12px;
text-align:center;
}

th{
background:#87CEEB;
}

.ok-btn{
background:green;
color:white;
border:none;
padding:5px 10px;
cursor:pointer;
border-radius:5px;
}

</style>
</head>

<body>

<h2 style="text-align:center;">LOT 5</h2>

<table>

<tr>
<th colspan="3">S</th>
<th colspan="3">M</th>
<th colspan="3">L</th>
<th colspan="3">XL</th>
</tr>

<tr>

<th>BANDAL</th>
<th>PC</th>
<th>OK</th>

<th>BANDAL</th>
<th>PC</th>
<th>OK</th>

<th>BANDAL</th>
<th>PC</th>
<th>OK</th>

<th>BANDAL</th>
<th>PC</th>
<th>OK</th>

</tr>

<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
for($i=1;$i<=10;$i++)
{

echo "<tr>";

echo "<td>S$i</td>";
echo "<td>30</td>";
echo "<td><button class='ok-btn' onclick='sendOk(this,\"S$i\")'>OK</button></td>";

echo "<td>M$i</td>";
echo "<td>30</td>";
echo "<td><button class='ok-btn' onclick='sendOk(this,\"M$i\")'>OK</button></td>";

echo "<td>L$i</td>";
echo "<td>30</td>";
echo "<td><button class='ok-btn' onclick='sendOk(this,\"L$i\")'>OK</button></td>";

echo "<td>XL$i</td>";
echo "<td>30</td>";
echo "<td><button class='ok-btn' onclick='sendOk(this,\"XL$i\")'>OK</button></td>";

echo "</tr>";

}

?>

</table>

<script>
function sendOk(button, bundle){

let username = "<?php echo $username; ?>";

fetch("send_notification.php",{

method:"POST",

headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"bundle="+bundle+"&username="+username

})
.then(res=>res.text())
.then(data=>{

alert(username + " marked " + bundle + " as DONE");

button.disabled = true;
button.style.background = "gray";
button.innerHTML = "Done";

})

}

</script>

</body>
</html>