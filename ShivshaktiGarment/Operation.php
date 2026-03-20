<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Shirt Operations</title>

<style>

body{
    font-family:Arial;
    background:#f4f4f4;
    padding:20px;
}

.container{
    width:500px;
    margin:auto;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    border:1px solid #000;
    padding:8px;
    text-align:center;
}

th{
    background:#ddd;
}

.select-btn{
    background:green;
    color:white;
    border:none;
    padding:5px 10px;
    cursor:pointer;
    border-radius:5px;
}

.select-btn:hover{
    background:darkgreen;
}

</style>

</head>
<body>

<div class="container">

<h2>SHIRT OPERATIONS</h2>

<table>

<tr>
<th>No</th>
<th>Operation</th>
<th>Rate</th>
<th>Select</th>
</tr>

<?php

$operations = [
["KAAJ PATTI",0.9],
["BUTTON PATTI",0.6],
["POCKET H-ATTACH",1.5],
["SHOULDER LABEL",0.5],
["SHOULDER ATTACH",1.3],
["KANDHI",1.4],
["SLEEVE PATTI",4.25],
["SLEEVE ATTACH",1.8],
["SLEEVE DORI",1.2],
["COLLAR MAKING",4.2],
["COLLAR ATTACH",2.7],
["SIDE",1.5],
["BOTTOM",1.5],
["CUFF MAKING",1.8],
["CUFF ATTACH",3.5],
["KAAJ",1.1],
["BUTTON",1]
];

for($i=0; $i<count($operations); $i++){

    $op = $operations[$i][0];
    $rate = $operations[$i][1];
    $no = $i + 1;

    echo "<tr>
            <td>$no</td>
            <td>$op</td>
            <td>$rate</td>
            <td>
                <button class='select-btn' onclick=\"selectOp('$op','$rate')\">Select</button>
            </td>
          </tr>";
}
?>

</table>

</div>

<script>

function selectOp(operation, rate){

    alert(operation + " selected (Rate: " + rate + ")");

    // Future: send to database
    /*
    fetch("save_operation.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:"operation="+operation+"&rate="+rate
    });
    */
}

</script>

</body>
</html>