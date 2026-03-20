<?php
include "config/db.php";

$result = mysqli_query($conn,"SELECT * FROM history ORDER BY id DESC");
?>

<h2>History</h2>

<table border="1" cellpadding="10">
<tr>
<th>User</th>
<th>Bundle</th>
<th>PC</th>
<th>Lot</th>
<th>Time</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) ?>
<tr>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['bundle']; ?></td>
<td><?php echo $row['pc']; ?></td>
<td><?php echo $row['lot']; ?></td>
<td><?php echo $row['created_at']; ?></td>
</tr>
<?php  ?>
</table>