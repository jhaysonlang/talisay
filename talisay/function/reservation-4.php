<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" content="http-equiv" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Altaroca Resort</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">  
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<?php 
include '../dbconnect.php';
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$email = $_GET['email'];
$contactnumber = $_GET['contactnumber'];
$numberofperson = $_GET['numberofperson'];
$checkin = $_GET['checkin'];
$checkout = $_GET['checkout'];
$roomCount = $_GET['roomCount'];
$roomName = $_GET['roomName'];
$cottageCount = $_GET['cottageCount'];
$cottageName = $_GET['cottageName'];
$totalAmount = '';
$numberofdays = (strtotime($checkout) - strtotime($checkin)) / (60*60*24);
$combineName = '';
$combineCount = '';
$combineName1 = '';
$combineCount1 =  '';
$capacity = 0;
?>
<body>

    <br><br>
<center>
<div class="reservation">
		<img src="../website/images2/step4.jpg" width="700" height="140">
		<br><h2>Reservation Summary</h2>
		<br>
		<h4><?php echo date("F j, Y",strtotime($checkin)) . ' - ' . date("F j, Y",strtotime($checkout));?></h4>
	<form action = "reserve.php" method = "POST">
		<?php
 		if(isset($_GET['process']))
  		{
    	echo '<input type = "hidden" name = "process" value = "'.$_GET['process'].'">';
  		}
  		?>
	<!--GUEST DETAIL-->
	<h4>Guest Details: </h4>
	<table border="0" width="70%" align="center" cellpadding="10">
		<tr>
			<td><b>Last Name:</b></td>
			<td><?php echo $lname;?></td>		
			<td>&nbsp;</td>
			<td><b>First Name:</b></td>
			<td><?php echo $fname;?></td>		
		</tr>
		<tr>
			<td><b>Contact Number:</b></td>
			<td><?php echo $contactnumber;?></td>
			<td>&nbsp;</td>
			<td><b>Number of Persons:</b></td>
			<td><?php echo $numberofperson;?></td>
		</tr>
		<tr>
			<td><b>Email:</b></td>
			<td><?php echo $email;?></td>		
		</tr>
		
	</table>
	<br>
	<!--RESERVATION DETAIL-->
	<h4>Reservation Details: </h4>
	<table border="0" width="70%" align="center" cellpadding="10">
		<tr>
			<th>Accommodation</th>
			<th>Rate</th>
			<th>No of Rooms</th>
			<th>No of Days</th>
			<th>Price</th>
		</tr>
		<?php 
		if(!empty($roomName))
		{
		$rooms = explode(',', $roomName);
		$count = explode(',', $roomCount);
		$ctr = 0;
		foreach ($rooms as $rooms) {
			$qry = mysql_query("SELECT * FROM roomcategory WHERE roomType = '$rooms'");
			$row = mysql_fetch_array($qry);
			?>
			<tr>
			<th><?php echo $row['roomType'];?></td>
			<th><?php echo '&#x20b1; ' . number_format($row['roomRate'],2);?></td>
			<th><?php echo $count[$ctr];?></td>
			<th><?php echo $numberofdays;?></td>
			<th><?php echo '&#x20b1; ' . number_format($row['roomRate'] * $count[$ctr] * $numberofdays,2);?></td>
			</tr>
			<?php
			$capacity = $capacity + ($row['capacity'] * $count[$ctr]);
			$totalAmount = $totalAmount + ($row['roomRate'] * $count[$ctr] * $numberofdays);
			$combineName = $combineName . ',' . $row['roomType'];
			$ctr++;
		}
		foreach ($count as $count) {
			$combineCount = $combineCount . ',' . $count;
		}
		}



		if(!empty($cottageName))
		{
		$cottages = explode(',', $cottageName);
		$count = explode(',', $cottageCount);
		$ctr = 0;
		foreach ($cottages as $cottages) {
			$qry = mysql_query("SELECT * FROM cottagecategory WHERE cottageType = '$cottages'");
			$row = mysql_fetch_array($qry);
			?>
			<tr>
			<th><?php echo $row['cottageType'];?></td>
			<th><?php echo '&#x20b1; ' . number_format($row['cottageRate'],2);?></td>
			<th><?php echo $count[$ctr];?></td>
			<th><?php echo $numberofdays;?></td>
			<th><?php echo '&#x20b1; ' . number_format($row['cottageRate'] * $count[$ctr] * $numberofdays,2);?></td>
			</tr>
			<?php

			$totalAmount = $totalAmount + ($row['cottageRate'] * $count[$ctr] * $numberofdays);
			$combineName1 = $combineName1 . ',' . $row['cottageType'];
			$ctr++;
		}
		foreach ($count as $count) {
			$combineCount1 = $combineCount1 . ',' . $count;
		}
		}

		$combineName = substr($combineName, 1);
		$combineCount = substr($combineCount, 1);
		$combineName1 = substr($combineName1, 1);
		$combineCount1 = substr($combineCount1, 1);

		$combineAll = '';
		$combineCountAll = '';
		if($combineName == '')
		{
			$combineAll = $combineName1;
			$combineCountAll = $combineCount1;
		}
		else if ($combineName1 == '') {
			$combineAll = $combineName;
			$combineCountAll = $combineCount;
		}
		else
		{
			$combineAll = $combineName . ',' . $combineName1;
			$combineCountAll = $combineCount . ',' . $combineCount1;
		}
		?>
		
	</table>
	<br>
	<!--BILLING DETAIL-->
	<h4>Billing Details: </h4>
	<table border="0" width="40%" align="center" cellpadding="10">
		<tr>
			<td><b>Total Amount:</b></td>
			<td><?php echo '&#x20b1; ' . number_format($totalAmount,2);?></td>
		</tr>
		<?php if($numberofperson > $capacity AND $capacity != 0)
		{
		$additional = 500 * ($numberofperson - $capacity);
		$totalAmount += $additional;
		?>
		<tr>
			<td>Additional &#x20b1; 500.00 for every excess person<br>
				Total Room Capacity: <?php echo $capacity?> Number of Person: <?php echo $numberofperson?>
			</td>
			<td>
				<?php echo '&#x20b1; ' . number_format($additional,2)?>
			</td>
		</tr>
		<?php 
		}
		if($capacity == 0)
		{
		$additional = 175 * $numberofperson;
		$totalAmount += $additional;
		?>
		<tr>
			<td>Additional &#x20b1; 175.00 entrance fee<br>
				Number of Person: <?php echo $numberofperson?>
			</td>
			<td>
				<?php echo '&#x20b1; ' . number_format($additional,2)?>
			</td>
		</tr>
		<?php 
		}

			if($_GET['process'] == 'Walk-in')
			{
				?>
				<tr>
				<td colspan="2">Mode of Payment:<br>
				<input type="radio"  name = "modeOfPayment" value="Cash" required> Cash
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name = "modeOfPayment"  value="Credit Card" required> Credit Card</td>
				</tr>
				<tr class = "referenceno" style = "display:none;">
				<td colspan="2">Reference Number: 
					<input type "text" name = "reference" class = "reference">
				</td>
				</tr>
				<?php
				}
				?>
				<tr>
				<td colspan="2">Payment Arrangement:<br>
					<input type="radio" checked class = "radio1" name = "paymentType" value="Full Payment" required> Full Payment
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name = "paymentType" class = "radio2" value="Half Payment" required> Half Payment</td>
				</tr>

		
		<tr>
			<td><b>Amount Due:</b></td>
			<td class = "value"></td>
		</tr>
		
	</table>
	<br>
		<table>
		<tr>
			<td colspan="2">
				<center>
		<input type = "hidden" name = "checkin" value = "<?php echo $_GET['checkin'];?>">
		<input type = "hidden" name = "checkout" value = "<?php echo $_GET['checkout'];?>">
		<input type = "hidden" name = "combineName" value = "<?php echo $combineAll;?>">
		<input type = "hidden" name = "combineCount" value = "<?php echo $combineCountAll;?>">
		<input type = "hidden" name = "numberofperson" value = "<?php echo $_GET['numberofperson'];?>">
		<input type = "hidden" name = "lname" value = "<?php echo $lname;?>">
		<input type = "hidden" name = "fname" value = "<?php echo $fname;?>">
		<input type = "hidden" name = "email" value = "<?php echo $email;?>">
		<input type = "hidden" name = "contactnumber" value = "<?php echo $contactnumber;?>">
		<input type = "hidden" name = "totalAmount" class = "totalAmount" value = "<?php echo $totalAmount;?>">
				<input type="button" name="check" class="btn btn-primary" value="Back" onclick="javascript:history.back(1)">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" name="submit" class="btn btn-success" value="Finish" />
				</center></td>
		</tr>
		</table>
		
		
	</form>
<br><br><br>

    


</body>
</html>

<script>
$(document).ready(function() {
$("input[type='radio'][name='modeOfPayment']").on('click',function(){
if($(this).val() != 'Cash')
{
	$('.referenceno').css('display','');
	$('.reference').prop('required',true);
}
else
{
	$('.referenceno').css('display','none');
	$('.reference').prop('required',false);
}
});

$('.value').html('<?php echo "&#x20b1; " . number_format($totalAmount,2);?>');

$('.radio1').on('click',function(e){
$('.value').html('<?php echo "&#x20b1; " . number_format($totalAmount,2);?>');
});
$('.radio2').on('click',function(e){
$('.value').html('<?php echo "&#x20b1; " . number_format($totalAmount/2,2);?>');
});
});
</script>