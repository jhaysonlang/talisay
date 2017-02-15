<html>
<head>
	<script src="js/jquery.min.js"></script>
	<style>
	body
	{
		display: none;
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
</head>
<body>
<?php 
session_start();
include '../dbconnect.php';
$id = $_GET['id'];
$username = $_SESSION['username'];
$qry1 = mysql_query("SELECT * FROM users WHERE username = '$username'");
$row1 = mysql_fetch_array($qry1);
$qry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '$id'");
$row = mysql_fetch_array($qry);
$qry2 = mysql_query("SELECT * FROM billing WHERE transactionNo = '$id'");
$row2 = mysql_fetch_array($qry2);
$days = (strtotime($row['checkout']) - strtotime($row['checkin'])) / (60*60*24);
$value = array();
?>
<table width="100%" class="table" align = "center">
	<tr>
		<td colspan="5">
			<table><tr>
				<td>
					<img src="logos.png">
				</td>
				<td><center>
					<h1>OFFICIAL RECEIPT</h1>
					Non Vat TIN: <b>124-389-861-000</b><br>
					Talisay Green Lake Resort <br>
					Telephone: (043) 773 0247 <br>
Mobile: 0917 810 9192 / 0918 900 4870<br></center>
				</td>
				
			</tr></table>
		</td>
	</tr>
	<tr><td style="border-top: 2px solid;" colspan="5"> </td></tr>
			
			<tr>
				<td class="bold">Guest Name:</td>
				<td colspan="2"><?php echo $row['guestName'];?></td>
				<td class="bold">Email Add:</td>
				<td><?php echo $row['email'];?></td>
			</tr>
			<tr>
				<td class="bold">Contact Number:</td>
				<td colspan="2"><?php echo $row['mobileNumber'];?></td>
				<td class="bold">Duration:</td>
				<td><?php echo date("M j, Y",strtotime($row['checkin'])).' - '.date("M j, Y",strtotime($row['checkout']));?></td>
			</tr>
			<tr>
				<td class="bold">Date:</td>
				<td colspan="2"><?php echo date("M j, Y | g:i A",strtotime($row['reservationDate']));?></td>
				<td class="bold">No. of Guests:</td>
				<td><?php echo $row['numberofperson'];?></td>
			</tr>
			<tr>
				<td class="bold">Transaction No:</td>
				<td colspan="2"><?php echo $row['transactionNo'];?></td>
			</tr>
			<tr>
				<td class="bold"></td>
				<td colspan="2"></td>
				<td class="bold"></td>
				<td></td>
			</tr>
			<tr>
				<td class="bold"></td>
				<td colspan="2"></td>
				<td class="bold"></td>
				<td></td>
			</tr>
	
	<tr><td style="border-bottom: 2px solid;" colspan="5"> </td></tr>
	
	<tr align="center" class="bold" >
		<td colspan="2">Breakdown of Expenses</td>
		<td>Reference</td>
		<td>Deposit</td>
		<td>Amount</td>		
	</tr>
	
	<tr><td style="border-top: 2px solid;" colspan="5">
		<table width="100%">
		<?php 
		$values = explode(',', $row['roomType']);
		$values1 = explode(',', $row['numberofRooms']);
		$ctr = 0;
		foreach ($values as $values) {
		$room = mysql_query("SELECT * FROM roomcategory WHERE roomType = '$values'");
		if(mysql_num_rows($room) != 0)
		{
			$roomrow = mysql_fetch_array($room);
			$counter = $roomrow['capacity'] * $values1[$ctr];
			$price = $roomrow['roomRate'] * $values1[$ctr] * $days;
		}
		$cottage = mysql_query("SELECT * FROM cottagecategory WHERE cottageType = '$values'");
		if(mysql_num_rows($cottage) != 0)
		{
			$cottagerow = mysql_fetch_array($cottage);
			$price = $cottagerow['cottageRate'] * $values1[$ctr] * $days;
		}
		?>
		<tr>
				<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $values;?></td>
				<td> <?php echo$row['referenceno']?>  </td>
				<td> </td>
				<td align = "right"><?php echo '&#x20b1; ' . number_format($price,2);?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
		<?php
		$ctr++;
		}
		if((isset($counter)) AND $row['numberofperson'] > $counter)
		{
			?>
			<tr>
				<td colspan="2">Additional Fees</td>
				<td> </td>
				<td> </td>
				<td align = "center"><?php echo '&#x20b1; ' . number_format(($row['numberofperson'] - $counter) * 500,2);?></td>
			</tr>
			<?php
		}
		if(!isset($counter))
		{
			?>
			<tr>
				<td colspan="2">Additional Fees</td>
				<td> </td>
				<td> </td>
				<td align = "center"><?php echo '&#x20b1; ' . number_format($row['numberofperson'] * 175,2)?></td>

			</tr>
			<?php
		}
		if($row['amenity'] != '')
		{
			$amenity = explode(',', $row['amenity']);
			$number = explode(',', $row['amenitycount']);
			$ctrxx = 0;
			foreach ($amenity as $amenity) {
				$qryy = mysql_query("SELECT * FROM amenities WHERE amenityName = '$amenity'");
				$roww = mysql_fetch_array($qryy);
				if($amenity == 'Food')
				{
					$value[] = $number[$ctrxx];
				}
				else
				{
					$value[] = $roww['amenityRate'] * $number[$ctrxx];
				}
				if($number[$ctrxx] != '')
				{
					?>
					<tr>
					<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $amenity?></td>
					<td> </td>
					<td> </td>
					<td align = "right"><?php echo '&#x20b1; ' .  number_format((int)$value[$ctrxx],2)?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

			</tr>
					<?php
				}
			$ctrxx++;
			}
		}

		?>
			
	
		</table>
	</td></tr>
	
	<tr>
		<td colspan="2"> </td>
		<td> </td>
		<td> </td>
		<td> </td>
	</tr>
	<tr>
		<td colspan="4" class="bold">TOTAL</td>
		<td align="right" style="color:red;"><?php echo '&#x20b1; ' . number_format($row2['totalAmount'],2);?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
	<tr><td style="border-top: 1px solid;" colspan="5"> </td></tr>
	<tr>		
		<td>Prepared by:</td>
		<td colspan="2"><?php echo $row1['name'] . ' ' . $row1['lname'];?></td>
		<td>Date:</td>
		<td><?php echo date("F j, Y");?></td>				
	</tr>
	</tr>
	<tr><td style="border-top: 1px solid;" colspan="5"> </td></tr>
	<tr>
		<td align="center" colspan="5" style="border-top: 2px solid;">Brgy. Sta. Maria, Talisay, Batangas, Philippines</td>
	</tr>
</table>



</body>
</html>

<script>
	window.print();
</script>
