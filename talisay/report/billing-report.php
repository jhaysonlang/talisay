<script src="js/jquery.min.js"></script>
<html>
<style>
body
{
	display: none;
}
.doubleUnderline {
    text-decoration:underline;
    border-bottom: 1px solid #000;
}

@media print
	{
		body{
		display: block !important;
		font-family: calibri !important;
		font-size: 1em !important;
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
$totalPayment = 0;
$totalAmt = 0;
$balance = 0;
?>
<div align = "center">
	<table><tr>
				<td>
					<img src="logos.png">
				</td>
				<td><center>
					<h2>BILLING REPORT</h2>
					From <?php echo date("F j, Y",strtotime($d1)) ;?> To <?php echo date("F j, Y",strtotime($d2));?>
					<br>
					Status:<b> <?php echo $status;?></b>
					</center>
				</td>				
			</tr>
			</table><br>
</div>
<!--transaction report-->
<table align = "center" cellpadding="10" border="1" width="100%" style="border:1px solid black;border-collapse:collapse;">
	<tr>
		<th width="20%">TRANSACTION NO</th>
		<th>GUEST NAME</th>
		<th width="17%">TOTAL AMOUNT</th>
		<th width="17%">PAYMENT</th>
		<th width="17%">BALANCE</th>
	</tr>
	<?php 
	while($numdates > $ctr)
	{
	$date = date("Y-m-d",strtotime("+ ".$ctr."days",strtotime($d1)));
	if($status == 'All')
	{
		$qry = mysql_query("SELECT * FROM reservation WHERE (status != 'Cancelled' AND status != 'Pending') AND reservationDate LIKE '%$date%'");
	}
	else
	{
		$qry = mysql_query("SELECT * FROM reservation WHERE status = '$status' AND reservationDate LIKE '%$date%'");
	}
	if(mysql_num_rows($qry) > 0)
	{
	while($row = mysql_fetch_array($qry))
	{
	$qry1 = mysql_query("SELECT * FROM billing WHERE transactionNo = '".$row['transactionNo']."'");
	$row1 = mysql_fetch_array($qry1);
	if(!in_array($row['transactionNo'], $exist))
	{
		$totalPayment = $totalPayment + $row1['paid'];
		$balance = $balance + $row1['balance'];
		$totalAmt = $totalAmt + $row1['totalAmount'];
	?>
	<tr>
		<td><?php echo $row['transactionNo'];?></td>
		<td><?php echo $row['guestName'];?></td>
		<td align="right"><?php echo '&#x20b1; ' . number_format($row1['totalAmount'],2);?></td>
		<td align="right"><?php echo '&#x20b1; ' . number_format($row1['paid'],2);?></td>
		<td align="right"><?php echo '&#x20b1; ' . number_format($row1['balance'],2);?></td>
	</tr>
	<?php
	}
	$exist[] = $row['transactionNo'];
	}
	}
	$ctr++;
	}

	?>

	<tr>
		<td colspan="2"><b>TOTAL:</b> </td>
		<td width="17%" align="right"><span class="doubleUnderline"><?php echo '&#x20b1; ' . number_format($totalAmt,2);?></span></td>
		<td width="17%" align="right"><span class="doubleUnderline"><?php echo  '&#x20b1; ' . number_format($totalPayment,2);?></span></td>
		<td width="17%" align="right"><span class="doubleUnderline"><?php echo '&#x20b1; ' . number_format($balance,2);?></span></td>
	</tr>
</table>


</body>
</html>

<script>
	window.print();
</script>