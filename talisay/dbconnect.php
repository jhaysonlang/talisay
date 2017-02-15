<?php
if(!mysql_connect("localhost","root",""))
{
     die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("talisay"))
{
     die('oops database selection problem ! --> '.mysql_error());
}

date_default_timezone_set('Etc/GMT-8');
$qry = mysql_query("SELECT * FROM reservation WHERE status = 'Pending'");
while($row = mysql_fetch_array($qry))
{
	if(strtotime(date("Y-m-d H:i:s",strtotime("+1 days",strtotime($row['reservationDate'])))) < strtotime(date("Y-m-d H:i:s")))
	{
		mysql_query("UPDATE reservation SET status = 'Cancelled' WHERE transactionNo = '".$row['transactionNo']."'");
	}
}
$qry1 = mysql_query("SELECT * FROM reservation WHERE status = 'Reserved'");
while($row1 = mysql_fetch_array($qry1))
{
	if(strtotime(date("Y-m-d",strtotime("+1 days",strtotime($row1['checkin'])))) < strtotime(date("Y-m-d")))
	{
		mysql_query("UPDATE reservation SET status = 'No-show' WHERE transactionNo = '".$row1['transactionNo']."'");
	}
}
?>