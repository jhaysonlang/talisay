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
$id = $_GET['id'];
$qry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '$id'");
$row = mysql_fetch_array($qry);
$namee = explode(' ', $row['guestName']);
$fname = implode(' ', array_diff($namee, array($namee[count($namee)-1])));
$lname = $namee[count($namee)-1];
$email = $row['email'];
$contactnumber = $row['mobileNumber'];
$numberofperson = $row['numberofperson'];
$checkin = $row['checkin'];
$checkout = $row['checkout'];
$amenity = $_GET['amenity'];
$number = $_GET['number'];
$amenities = $amenity;
$numbers = $number;
$food = $_GET['food'];
$value = array();
$totalAmount = 0;
?>
<body>

    <br><br>
<center>
<div class="reservation">
		<br><h2>Additional Charges</h2>
		<br>
		<h4><?php echo date("F j, Y",strtotime($checkin)) . ' - ' . date("F j, Y",strtotime($checkout));?></h4>
	<form action = "amenityprocess.php" method = "POST">
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
			<td> &nbsp;</td>
			<td><b>Number of Persons:</b></td>
			<td><?php echo $numberofperson;?></td>	
		</tr>
		<tr>
			<td><b>Email:</b></td>
			<td><?php echo $email;?></td>		
		</tr>
		
	</table>
	<br>
	<!--ADDITIONAL DETAIL-->
	<h4>Additional Details: </h4>
	<table border="0" width="70%" align="center" cellpadding="10">
		
		<tr>
			<th>Additional Charge</th>
			<th>Rate</th>
			<th>Quantity</th>
			<th>Price</th>
		</tr>
		
		<?php 
		$ctr = 0;
		foreach ($amenities as $amenities) {
		if($numbers[$ctr] != '')
		{
			$qryy = mysql_query("SELECT * FROM amenities WHERE amenityName = '$amenities'");
			$roww = mysql_fetch_array($qryy);
			$value[] = $roww['amenityRate'] * $numbers[$ctr];
			$totalAmount = $totalAmount + ($roww['amenityRate'] * $numbers[$ctr]);
			?>
			<tr>
			<th><?php echo $amenities;?></th>
			<th><?php echo '&#x20b1; ' .  number_format($roww['amenityRate'],2) . ' per ' . $roww['quantity'] . ' ' . $roww['description'] ;?></th>
			<th><?php echo $numbers[$ctr];?></th>
			<th><?php echo '&#x20b1; ' .  number_format($value[$ctr],2)?></th>
			</tr>
			<?php
		}
		else
		{
			$value[] = 0;
		}
		$ctr++;
		}
		if($food != '')
		{
			$amenity[] = 'Food';
			$number[] = $food;
			$totalAmount = $totalAmount + $food;
			?>
			<tr>
			<th>Food and Beverage</th>
			<th><?php echo '&#x20b1; ' . number_format((int)$food,2);?></th>
			<th></th>
			<th><?php echo '&#x20b1; ' . number_format((int)$food,2);?></th>
			</tr>
			<?php
		}
		?>
	</table>
	<br><br>
	<!--BILLING DETAIL-->
	<?php 
	?>
	<h4>Billing Details: </h4>
	<?php 
	$qryval = mysql_query("SELECT * FROM billing WHERE transactionNo = '$id'");
	$rowval = mysql_fetch_array($qryval);
	?>
	<table border="0" width="70%" align="center" cellpadding="10">
		<tr>
			<td><b>Balance:</b></td>
			<td><?php echo '&#x20b1; ' .  number_format($rowval['balance'],2);?></td>
		</tr>
		<tr>
			<td><b>Total Additional Charge:</b></td>
			<td><?php echo '&#x20b1; ' .  number_format($totalAmount,2);?></td>
		</tr>
	
		<tr>
			<td><b>New Total Amount:</b></td>
			<td><?php echo '&#x20b1; ' .  number_format($rowval['balance']+$totalAmount,2);?></td>
		</tr>
		
	</table>
	<br>
		<table>
		<tr>
			<td colspan="2">
				<center>
				<input type = "hidden" name = "id" value = "<?php echo $id?>">
				<input type = "hidden" name = "amenity" value = "<?php echo implode(',',$amenity)?>">
				<input type = "hidden" name = "number" value = "<?php echo implode(',', $number)?>">
				<input type = "hidden" name = "additional" value = "<?php echo $totalAmount?>">
				<input type="submit" name="submit" class="btn btn-success" value="Finish" />
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" name="check" class="btn btn-primary" value="Back" onclick="javascript:history.back(1)">
				
				
				</center></td>
		</tr>
		</table>

	</form>
<br><br><br>

    


</body>
</html>

<script>
$(document).ready(function() {
$('.value').html($('.totalAmount').val());

$('.value').html('<?php echo "&#x20b1; " . number_format($totalAmount,2);?>');

$('.radio1').on('click',function(e){
$('.value').html('<?php echo "&#x20b1; " . number_format($totalAmount,2);?>');
});
$('.radio2').on('click',function(e){
$('.value').html('<?php echo "&#x20b1; " . number_format($totalAmount/2,2);?>');
});
});
</script>