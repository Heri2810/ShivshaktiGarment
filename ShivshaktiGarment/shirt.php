<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lot Selection</title>

<style>
/* BODY & BACKGROUND */
body{
    margin:0;
    padding:0;
    font-family:Arial;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(135deg, #74ebd5, #ACB6E5);
}

/* MAIN CONTAINER */
.container{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    width:450px;
    max-width:95%;
}

/* HEADER: OPERATION BUTTON LEFT, TITLE CENTER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.header h1{
    margin:0;
    font-size:22px;
    text-align:center;
    flex-grow:1;
}

/* OPERATION BUTTON */
.operation-btn{
    background:#27ae60;
    color:white;
    border:none;
    padding:8px 16px;
    border-radius:8px;
    cursor:pointer;
    font-size:14px;
    transition:0.3s;
}

.operation-btn:hover{
    background:#219150;
}

/* LOT ROWS */
.lot-row{
    display:flex;
    justify-content:center;
    gap:10px;
    margin-bottom:12px;
    flex-wrap:wrap;
}

/* LOT BUTTON */
.lot-btn{
    background:#3498db;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
    min-width:90px;
}

.lot-btn:hover{
    background:#2c80b4;
}

/* MODAL */
.modal{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
    display:none;
    justify-content:center;
    align-items:flex-start;
    opacity:0;
    transition:0.3s;
    padding-top:40px;
    z-index:1000;
}

.modal.show{
    display:flex;
    opacity:1;
}

/* MOBILE-FRIENDLY MODAL CONTENT */
.modal-content{
    background:white;
    padding:15px;
    border-radius:12px;
    width:90%;
    max-width:400px;
    max-height:80vh;
    overflow:auto;
    box-shadow:0 5px 20px rgba(0,0,0,0.3);
    animation:slideDown 0.3s ease;
}

@keyframes slideDown{
    from { transform: translateY(-20px); opacity:0; }
    to { transform: translateY(0); opacity:1; }
}

/* CLOSE BUTTON */
.close-btn{
    float:right;
    cursor:pointer;
    font-size:18px;
}

/* SEARCH BOX */
.search-box{
    width:100%;
    padding:6px;
    margin-bottom:10px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:14px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

th,td{
    border:1px solid #ccc;
    padding:6px;
    text-align:center;
}

th{
    background:#3498db;
    color:white;
}

/* SELECT BUTTON */
.select-btn{
    background:#27ae60;
    color:white;
    border:none;
    padding:4px 8px;
    border-radius:5px;
    cursor:pointer;
    font-size:13px;
}

.select-btn:hover{
    background:#1e8449;
}

/* Responsive adjustments */
@media (max-width:480px){
    .lot-btn{
        flex:1;
        min-width:70px;
        padding:6px 8px;
        font-size:13px;
    }
    .operation-btn{
        padding:6px 12px;
        font-size:13px;
    }
}
</style>

</head>
<body>

<!-- MAIN CONTAINER -->
<div class="container"> 

    <!-- HEADER -->
    <div class="header">
        <button class="operation-btn" onclick="openModal()">Operation</button>
        <h1>LOT SELECTION</h1>
    </div>

    <!-- LOT BUTTONS -->
    <div class="lot-row">
        <a href="lot1.php"><button class="lot-btn">LOT 1</button></a>
        <a href="lot2.php"><button class="lot-btn">LOT 2</button></a>
        <a href="lot3.php"><button class="lot-btn">LOT 3</button></a>
    </div>
    <div class="lot-row">
        <a href="lot4.php"><button class="lot-btn">LOT 4</button></a>
        <a href="lot5.php"><button class="lot-btn">LOT 5</button></a>
        <a href="lot6.php"><button class="lot-btn">LOT 6</button></a>
    </div>
    <div class="lot-row">
        <a href="lot7.php"><button class="lot-btn">LOT 7</button></a>
        <a href="lot8.php"><button class="lot-btn">LOT 8</button></a>
        <a href="lot9.php"><button class="lot-btn">LOT 9</button></a>
    </div>
    <div class="lot-row">
        <a href="lot10.php"><button class="lot-btn">LOT 10</button></a>
    </div>

</div>

<!-- MODAL -->
<div id="operationModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">✖</span>
        <h3>Shirt Operations</h3>

        <input type="text" id="searchInput" class="search-box" placeholder="Search operation..." onkeyup="searchOp()">

        <!-- FORM to submit selected operation -->
        <form id="operationForm" action="history.php" method="post">
        <input type="hidden" name="operation" id="formOp">
        <input type="hidden" name="rate" id="formRate">

        <table id="operationTable">
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
                echo "<tr>
                        <td>".($i+1)."</td>
                        <td>$op</td>
                        <td>$rate</td>
                        <td><button type='button' class='select-btn' onclick=\"selectOp('$op','$rate')\">Select</button></td>
                      </tr>";
            }
            ?>
        </table>
        </form>
    </div>
</div>

<!-- JS -->
<script>
function openModal(){
    document.getElementById("operationModal").classList.add("show");
}
function closeModal(){
    document.getElementById("operationModal").classList.remove("show");
}

// Send operation + rate to history.php
function selectOp(op, rate){
    document.getElementById('formOp').value = op;
    document.getElementById('formRate').value = rate;
    document.getElementById('operationForm').submit();
}

// Search filter
function searchOp(){
    let input = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll("#operationTable tr");
    for(let i=1; i<rows.length; i++){
        let text = rows[i].innerText.toLowerCase();
        rows[i].style.display = text.includes(input) ? "" : "none";
    }
}
</script>

</body>
</html>