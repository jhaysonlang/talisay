<?php
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
$headers.= 'From: Talisay Green Lake Resort <no-reply@talisaygreenlakeresort.ph>';
$recipient = $email;
$subject = "Transaction Details";
$message ='
     <html>
 <head>
 <style>
 }
 .info{
    font-size: 1.4em;
 }
	a{
	color:#e60000;
	}
table{
}
 </style>
 </head>
     <body>
	 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="http://talisay.skyhotelcubao.com/talisay/images/logos.png" height="80px">
     <h1 style="color:green;">Talisay Green Lake Resort</h1>
	 <h4>Brgy. Sta. Maria, Talisay, Batangas.</h4>
     <p class="top">
     <hr>
     <h3>Dear <b>'.$guestName.'</b>,</h3><br> Thank you for booking with us.<br>
	 Please follow the instructions carefully to confirm your reservation.
    <br><br>Your booking ID is:&nbsp;&nbsp;<b>'.$transno.'</b><br>
	<hr>
	To confirm your reservation, please deposit ____ through the provided<br>
	bank account.
	<br><br><b>BDO</b><br>
	Account Number: &nbsp;&nbsp;<b>8912-2100-23</b><br><br>
	Account Branch: &nbsp;&nbsp;<b>BDO Talisay</b><br>
	Account Name: &nbsp;&nbsp;<b> Talisay Green Lake </b>
	<hr>
	&nbsp;&nbsp;&nbsp;&nbsp;RESERVATION SUMMARY
	<br><br>
	<b>'.$checkin.'&nbsp;-&nbsp;'.$checkout.'</b><br>
	Number of person:&nbsp;&nbsp;$numberofpersons<br>
	<table border="1px">
	<th> Accomodation </th>
	<th> Rate </th>
	<th> No of Rooms </th>
	<th> No of Days </th>
	<tr>
	<td>'.$row['roomType'].'</td>
	<td>'.$numrows['rate'].'</td>
	<td>'.$numrows['numberofRooms'].'</td>
	</tr>
	</table>
	Total Amount : $totalAmount
    <hr>
      <p>view your <a href="yujinnhostel.com/altaroca/index_login.php"> reservation </a> now.</p>
   </body>
   </html>
     ';

mail($recipient, $subject, $message, $headers);
header("location:index-reservation.php");
?>
