<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" content="http-equiv" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Altaroca Resort</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<?php 
include '../dbconnect.php';
$rooms = $_GET['rooms'];
$cottages = $_GET['cottages'];
$checkin = $_GET['checkin'];
$checkout = $_GET['checkout'];
$roomCount = '';
$roomName = '';
$cottageCount = '';
$cottageName = '';
if(!empty($rooms))
{
$ctr = 1;
foreach ($rooms as $rooms) {
	$qry = mysql_query("SELECT * FROM roomcategory WHERE id = '$ctr'");
	$row = mysql_fetch_array($qry);
	if($rooms != '')
	{
		$roomName = $roomName . ',' . $row['roomType'];
		$roomCount = $roomCount . ',' . $rooms;
	}
	$ctr++;
}
}
if(!empty($cottages))
{
$ctr = 1;
foreach ($cottages as $cottages) {
	$qry = mysql_query("SELECT * FROM cottagecategory WHERE id = '$ctr'");
	$row = mysql_fetch_array($qry);
	if($cottages != '')
	{
		$cottageName = $cottageName . ',' . $row['cottageType'];
		$cottageCount = $cottageCount . ',' . $cottages;
	}
	$ctr++;
}
}
$roomName = substr($roomName, 1);
$roomCount = substr($roomCount, 1);
$cottageName = substr($cottageName, 1);
$cottageCount = substr($cottageCount, 1);
?>
<body>

    <br><br>
<center>
<div class="reservation">
		<img src="../website/images2/step3.jpg" width="700" height="140">
		<br><h2>Guest Details</h2>
		<br>

	<form action = "reservation-4.php" method = "GET">
	<!--roomcategory-->
	<table border="0" width="35%" align="center" cellpadding="10">
		<?php 
		session_start();
		if($_SESSION['usertype'] == 'guest')
		{
		$qry = mysql_query("SELECT * FROM customers WHERE email = '".$_SESSION['username']."'");
		$row = mysql_fetch_array($qry);
			?>
			<tr>
			<td align="right">Last Name:</td>
			<td align="center"><input type="text" value = "<?php echo $row['lname'];?>" name="lname" placeholder="Last Name" readonly/></td>		
			</tr>
			<tr>
			<td align="right">First Name:</td>
			<td align="center"><input type="text" value = "<?php echo $row['name'];?>" name="fname" placeholder="First Name" readonly/></td>		
			</tr>
			<tr>
			<td align="right">Contact Number:</td>
			<td align="center"><input type="text" value = "<?php echo $row['mobile'];?>" name="contactnumber" placeholder="Contact Number" readonly/></td>		
			</tr>
			<tr>
			<td align="right">Email:</td>
			<td align="center"><input type="text"value = "<?php echo $row['email'];?>"  name="email" placeholder="Email" readonly/></td>		
			</tr>
			<?php
		}
		else
		{
			?>
			<tr>
			<td align="right">Last Name:</td>
			<td align="center"><input type="text" name="lname" placeholder="Last Name" required/></td>		
			</tr>
			<tr>
			<td align="right">First Name:</td>
			<td align="center"><input type="text" name="fname" placeholder="First Name" required/></td>		
			</tr>
			<tr>
			<td align="right">Contact Number:</td>
			<td align="center"><input type="text" name="contactnumber" placeholder="Contact Number" required/></td>		
			</tr>
			<tr>
			<td align="right">Email:</td>
			<td align="center"><input type="text" name="email" placeholder="Email" required/></td>		
			</tr>
			<?php
		}
		?>
		<tr>
			<td colspan="2">
				<center>
				<input type="button" name="check" class="btn btn-primary" value="Back" onclick="javascript:history.back(1)">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" name="btn" class = "btn btn-success" value="Proceed" />
				</center></td>
		</tr>
	</table>

	<input type = "hidden" name = "process" value = "<?php echo $_GET['process'];?>">
	<input type = "hidden" name = "checkin" value = "<?php echo $_GET['checkin'];?>">
	<input type = "hidden" name = "checkout" value = "<?php echo $_GET['checkout'];?>">
	<input type = "hidden" name = "numberofperson" value = "<?php echo $_GET['numberofperson'];?>">
	<input type = "hidden" name = "roomCount" value = "<?php echo $roomCount;?>">
	<input type = "hidden" name = "roomName" value = "<?php echo $roomName;?>">
	<input type = "hidden" name = "cottageCount" value = "<?php echo $cottageCount;?>">
	<input type = "hidden" name = "cottageName" value = "<?php echo $cottageName;?>">
</form>
<br><br><br>

    

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>