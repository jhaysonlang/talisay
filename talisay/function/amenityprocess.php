<?php 
include '../dbconnect.php';
$id = $_POST['id'];
$amenity = $_POST['amenity'];
$number = $_POST['number'];
$additional = $_POST['additional'];
$qry = mysql_query("SELECT * FROM billing WHERE transactionNo = '$id'");
$row = mysql_fetch_array($qry);
$qry1 = mysql_query("SELECT * FROM reservation WHERE transactionNo = '$id'");
$row1 = mysql_fetch_array($qry1);
if($row1['amenity'] != '')
{
	$amenity = $row1['amenity'].','.$amenity;
	$number = $row1['amenitycount'].','.$number;
}

$balance = $row['balance'] + $additional;
$totalAmount = $row['totalAmount'] + $additional;

mysql_query("UPDATE reservation SET amenity = '$amenity', amenitycount = '$number' WHERE transactionNo = '$id'");
mysql_query("UPDATE billing SET balance = '$balance' , totalAmount = '$totalAmount' WHERE transactionNo = '$id'");
header("location: index-amenity.php");
?>