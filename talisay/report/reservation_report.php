<script src="js/jquery.min.js"></script>
<html>
<style>
body
{
	display: none;
}
@media print
	{
		@page { size: landscape; }
		body{
		display: block !important;
		font-family: calibri !important;
		font-size: .8em !important;
		}
		.bold{
		font-weight: bold !important;
		font-size: 1.1em !important;
		}
		.slip{
		background-color: #538DD5 !important;
		font-weight: bold !important;
		font-size: 1.3em !important;
		}
		.table{
		border-style: solid !important;
		cellspacing: 10 !important;
		}
		.line{
		border: 1px solid black !important;
		border-collapse: collapse !important;
		}
	}
</style>
<body>
<?php
include '../dbconnect.php';
$d1 = $_GET['d1'];
$d2 = $_GET['d2'];
$status = trim($_GET['status']);
$total = 0;
$numdates = (strtotime($d2) - strtotime($d1)) / (60*60*24);
$ctr = 0;
$exist = array();
?>
<div align = "center">
<div align = "center">
	<table><tr>
				<td>
					<img src="logos.png">
				</td>
				<td><center>
					<h2>RESERVATION REPORT</h2>
					From <?php echo date("F j, Y",strtotime($d1)) ;?> To <?php echo date("F j, Y",strtotime($d2));?>
					<br>
					Status: <b><?php echo $status;?></b>
					</center>
				</td>				
			</tr>
			</table><br>
</div>
</div>
<!--transaction report-->
<table align = "center" cellpadding="10" border="1" width="100%" style="border:1px solid black;border-collapse:collapse;">
	<tr>
		<th width="15%">TRANSACTION NO</th>
		<th width="20%">GUEST NAME</th>
		<th>RESERVATION DATE</th>
		<th>CHECK-IN DATE</th>
		<th>CHECK-OUT DATE</th>
		<th>TOTAL AMOUNT</th>
		<th>STATUS</th>
	</tr>
	<?php 
	while($numdates > $ctr)
	{
	$date = date("Y-m-d",strtotime("+ ".$ctr."days",strtotime($d1)));
	if($status == 'All')
	{
		$qry = mysql_query("SELECT * FROM reservation WHERE reservationDate LIKE '%$date%'");
	}
	else
	{
		$qry = mysql_query("SELECT * FROM reservation WHERE status = '$status' AND reservationDate LIKE '%$date%'");
	}
	while($row = mysql_fetch_array($qry))
	{
	if(!in_array($row['transactionNo'], $exist))
	{
	?>
	<tr>
		<td><?php echo $row['transactionNo'];?></td>
		<td><?php echo $row['guestName'];?></td>
		<td align="right"><?php echo date("M j, Y g:i A",strtotime($row['reservationDate']));?></td>
		<td align="right"><?php echo date("M j, Y",strtotime($row['checkin']));?></td>
		<td align="right"><?php echo date("M j, Y",strtotime($row['checkout']));?></td>
		<td align="right"><?php echo '&#x20b1; ' . number_format($row['rate'],2);?></td>
		<td align="right"><?php echo $row['status'];?></td>
	</tr>
	<?php
	}
	$exist[] = $row['transactionNo'];
	}
	$ctr++;
	}
	?>
	

</table>


</body>
</html>

<script>
	window.print();
</script>