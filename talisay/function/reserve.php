<?php 
include '../dbconnect.php';
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$combineName = $_POST['combineName'];
$combineCount = $_POST['combineCount'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$email = $_POST['email']; 
$contactnumber = $_POST['contactnumber'];
$totalAmount = $_POST['totalAmount'];
$paymentType = $_POST['paymentType'];
$numberofdays = (strtotime($checkout) - strtotime($checkin)) / (60*60*24);
if(isset($_POST['reference']))
{
$reference = $_POST['reference'];   
}
$numberofperson = $_POST['numberofperson'];
$guestName = $fname . ' ' . $lname;
$process = $_POST['process'];
$reservationDate = date("Y-m-d H:i:s");

if(isset($_POST['modeOfPayment']))
{
$modeOfPayment = $_POST['modeOfPayment'];
}



$name = explode(',', $combineName);
$count = explode(',', $combineCount);
$ctr = 0;
$roomName = '';
$holdName = array();
$realName = '';
$contentRemove = array();

foreach ($name as $name) 
{
	$qry = mysql_query("SELECT * FROM roomcategory WHERE roomType = '$name'");
	$row = mysql_fetch_array($qry);
	$qry1 = mysql_query("SELECT * FROM reservation WHERE (status = 'Pending' OR status = 'Reserved' OR status = 'Check In') AND roomType LIKE '%".$row['roomType']."%'");
 	if(mysql_num_rows($qry1) == 0)
    {
        $ctrNum = 1;
        $qrycat1 = mysql_query("SELECT * FROM rooms WHERE id = '".$row['id']."'");
    	while($rowcat1 = mysql_fetch_array($qrycat1))
    	{
    		$roomName = $roomName . ',' . $rowcat1['roomNum'];
    		if($ctrNum == $count[$ctr])
    		{
    			  break;
    		}
    		$ctrNum++;
    	}
    	$holdName[] = substr($roomName,1);
    	$roomName = ''; 
        $holder2[] = implode(' ', $holdName) . ' '; 
    }
    else
    {
        while($row1 = mysql_fetch_array($qry1)) 
            {
            if((strtotime($row1['checkin']) <= strtotime($checkin) && strtotime($row1['checkout']) >= strtotime($checkin)) || (strtotime($row1['checkin']) <= strtotime($checkout) && strtotime($row1['checkout']) >= strtotime($checkout)) || (strtotime($checkin) < strtotime($row1['checkin']) && strtotime($checkin) < strtotime($row1['checkout']) && strtotime($checkout) > strtotime($row1['checkin']) && strtotime($checkout) > strtotime($row1['checkout'])))
                {
                $explode1 = explode(',',trim($row1['roomType']));
                $explode2 = explode(' ',trim($row1['roomName']));
                $explodetry = explode(',',trim($row1['roomType']));
                $transtry = 0;
                foreach ($explodetry as $explodetry) {
                    if($explodetry == $row['roomType'])
                    {
                        break;
                    }
                $transtry++;
                }
                if($transtry <= count($explode2))
                {
                  $explodearr[] = $explode2[$transtry];   
                }   
            }
            }
            if(isset($explodearr))
            {
            $wachow = true;
            $values = array();
            $realctr = 0;
            foreach ($explodearr as $real) {
            $values[] = $real;
            $realctr++;
            }
            $realValue = implode(',', $values);
            $roomNum1 = array();
            $holder1 = array();               
            foreach ($explode1 as $explode1) {
            if($explode1 == $row['roomType'])
            {
            $qrycat3 = mysql_query("SELECT * FROM rooms WHERE id = '".$row['id']."'");
            while ($rowcat3 = mysql_fetch_array($qrycat3)) {
            $roomNum1[] = $rowcat3['roomNum'];
            }
            $holder1[] = implode(',',array_slice(array_diff($roomNum1,explode(',',$realValue)),0,$count[$ctr]));
            $realName = $realName . $holder1[0] . ' ';
            $holder1 = array();
            break;
            }
            }
            }
            else
            {
                $ctrNum = 1;
                $qrycat1 = mysql_query("SELECT * FROM rooms WHERE id = '".$row['id']."'");
                while($rowcat1 = mysql_fetch_array($qrycat1))
                {
                $roomName = $roomName . ',' . $rowcat1['roomNum'];
                if($ctrNum == $count[$ctr])
                {
                  break;
                }
                $ctrNum++;
                }
                $holdName[] = substr($roomName,1);
                $roomName = ''; 
                $holder2[] = implode(' ', $holdName) . ' '; 
            }      
    }
$ctr++;
}




$cotname = explode(',', $combineName);
$cotcount = explode(',', $combineCount);
$cotctr = 0;
$cottageName = '';
$cotholdName = array();
$cotrealName = '';
$cotcontentRemove = array();

foreach ($cotname as $cotname) 
{
    $cotqry = mysql_query("SELECT * FROM cottagecategory WHERE cottageType = '$cotname'");
    $cotrow = mysql_fetch_array($cotqry);
    $cotqry1 = mysql_query("SELECT * FROM reservation WHERE (status = 'Pending' OR status = 'Reserved' OR status = 'Check In') AND roomType LIKE '%".$cotrow['cottageType']."%'");
    if(mysql_num_rows($cotqry1) == 0)
    {
        $cotctrNum = 1;
        $cotqrycat1 = mysql_query("SELECT * FROM cottages WHERE id = '".$cotrow['id']."'");
        while($cotrowcat1 = mysql_fetch_array($cotqrycat1))
        {
            $cottageName = $cottageName . ',' . $cotrowcat1['cottageID'];
            
            if($cotctrNum == $cotcount[$cotctr])
            {
                  break;
            }
            $cotctrNum++;
        }
        $cotholdName[] = substr($cottageName,1);
        $cottageName = ''; 
        $cotholder2[] = implode(' ', $cotholdName) . ' '; 
    }
    else
    {
        while($cotrow1 = mysql_fetch_array($cotqry1)) 
            {
            if((strtotime($cotrow1['checkin']) <= strtotime($checkin) && strtotime($cotrow1['checkout']) >= strtotime($checkin)) || (strtotime($cotrow1['checkin']) <= strtotime($checkout) && strtotime($cotrow1['checkout']) >= strtotime($checkout)) || (strtotime($checkin) < strtotime($cotrow1['checkin']) && strtotime($checkin) < strtotime($cotrow1['checkout']) && strtotime($checkout) > strtotime($cotrow1['checkin']) && strtotime($checkout) > strtotime($cotrow1['checkout'])))
                {
                $cotexplode1 = explode(',',trim($cotrow1['roomType']));
                $cotexplode2 = explode(' ',trim($cotrow1['cottageName']));

                $cotexplodetry = explode(',',trim($cotrow1['roomType']));
                $cottranstry = 0;
                foreach ($cotexplodetry as $cotexplodetry) {
                    if($cotexplodetry == $cotrow['cottageType'])
                    {    
                        $cottranstry++;
                        break;
                    }
                    
                }
                $cotexplodearr[] = $cotexplode2[$cottranstry]; 

            }
            }
            if(isset($cotexplodearr))
            {
            $cotvalues = array();
            $cotrealctr = 0;
            foreach ($cotexplodearr as $cotreal) {
            $cotvalues[] = $cotreal;
            $cotrealctr++;
            }
            $cotrealValue = implode(',', $cotvalues);
            $cottageNum1 = array();
            $cotholder1 = array();               
            foreach ($cotexplode1 as $cotexplode1) {
            if($cotexplode1 == $cotrow['cottageType'])
            {
            $cotqrycat3 = mysql_query("SELECT * FROM cottages WHERE id = '".$cotrow['id']."'");
            while ($cotrowcat3 = mysql_fetch_array($cotqrycat3)) {
            $cottageNum1[] = $cotrowcat3['cottageID'];
            }
            $cotholder1[] = implode(',',array_slice(array_diff($cottageNum1,explode(',',$cotrealValue)),0,$cotcount[$cotctr]));
            $cotrealName = $cotrealName . $cotholder1[0] . ' ';
            $cotholder1 = array();
            break;
            }
            }
            }
             else
            {
                $cotctrNum = 1;
                $cotqrycat1 = mysql_query("SELECT * FROM cottages WHERE id = '".$cotrow['id']."'");
                while($cotrowcat1 = mysql_fetch_array($cotqrycat1))
                {
                $cottageName = $cottageName . ',' . $cotrowcat1['cottageID'];
            
                if($cotctrNum == $cotcount[$cotctr])
                {
                  break;
                }
                $cotctrNum++;
                }
                $cotholdName[] = substr($cottageName,1);
                $cottageName = ''; 
                $cotholder2[] = implode(' ', $cotholdName) . ' ';
            }      
    }
$cotctr++;
}



if(isset($holder2))
{
    $realName = $realName . implode(' ',array_unique(explode(' ',implode('', array_unique($holder2)))));
}



if(isset($cotholder2))
{
    $cotrealName = $cotrealName . implode(' ',array_unique(explode(' ',implode('', array_unique($cotholder2)))));
}



$lastname = explode(',', $combineName);
foreach ($lastname as $lastname) 
{
            $qry = mysql_query("SELECT * FROM roomcategory WHERE roomType = '$lastname'");
            $row = mysql_fetch_array($qry);
            $qry1 = mysql_query("SELECT * FROM reservation WHERE (status = 'Pending' OR status = 'Reserved' OR status = 'Check In') AND roomType LIKE '%$lastname%'");
            $qrycat1 = mysql_query("SELECT * FROM rooms WHERE id = '".$row['id']."'");
            $numcat1 = mysql_num_rows($qrycat1);
            while($row1 = mysql_fetch_array($qry1)) 
            {
            if((strtotime($row1['checkin']) <= strtotime($checkin) && strtotime($row1['checkout']) >= strtotime($checkin)) || (strtotime($row1['checkin']) <= strtotime($checkout) && strtotime($row1['checkout']) >= strtotime($checkout)) || (strtotime($checkin) < strtotime($row1['checkin']) && strtotime($checkin) < strtotime($row1['checkout']) && strtotime($checkout) > strtotime($row1['checkin']) && strtotime($checkout) > strtotime($row1['checkout'])))
            {
            $explode1 = explode(',',trim($row1['roomType']));
            if(count($explode1) > 0)
            {
            $key1 = 0;
            foreach ($explode1 as $explode1) {
            if($explode1 == $row['roomType'])
            {
              break;
            }
            $key1++;
            }
            $explode11 = explode(',',trim($row1['numberofRooms']));
          $numcat1 = $numcat1 - $explode11[$key1];
            }
            else
            {
            $numcat1 = $numcat1 - $row1['numberofRooms'];
            }
            }
            }
            if($numcat1 < 0)
            {
                $valid = false;
                break;
            }
            else
            {
                $valid = true;
            }
}


$lastname1 = explode(',', $combineName);
foreach ($lastname1 as $lastname1) 
{
        $qryy = mysql_query("SELECT * FROM cottagecategory WHERE cottageType = '$lastname1'");
        $roww = mysql_fetch_array($qryy);
        $qryy1 = mysql_query("SELECT * FROM reservation WHERE (status = 'Pending' OR status = 'Reserved' OR status = 'Check In') AND roomType LIKE '%lastname1%'");
        $qryycat1 = mysql_query("SELECT * FROM cottages WHERE id = '".$roww['id']."'");
        $nummcat1 = mysql_num_rows($qryycat1);
        while($roww1 = mysql_fetch_array($qryy1)) 
        {
          if((strtotime($roww1['checkin']) <= strtotime($checkin) && strtotime($roww1['checkout']) >= strtotime($checkin)) || (strtotime($roww1['checkin']) <= strtotime($checkout) && strtotime($roww1['checkout']) >= strtotime($checkout)) || (strtotime($checkin) < strtotime($roww1['checkin']) && strtotime($checkin) < strtotime($roww1['checkout']) && strtotime($checkout) > strtotime($roww1['checkin']) && strtotime($checkout) > strtotime($roww1['checkout'])))
          {
          $explodee1 = explode(',',trim($roww1['roomType']));
          if(count($explodee1) > 0)
          {
          $keyy1 = 0;
            foreach ($explodee1 as $explodee1) {
            if($explodee1 == $roww['cottageType'])
            {
              break;
            }
            $keyy1++;
            }
          $explodee11 = explode(',',trim($roww1['numberofRooms']));
          $nummcat1 = $nummcat1 - $explodee11[$keyy1];
          }
          else
          {
          $nummcat1 = $nummcat1 - $roww1['numberofRooms'];
          }
          }
          }
          if($numcat1 < 0)
          {
          $valid1 = false;
          break;
          }
          else
          {
          $valid1 = true;
          }
}

if(!isset($valid))
{
$valid = true;
}
if(!isset($valid1))
{
$valid = false;
}


if($valid == true AND $valid1 == true)
{

do 
{
    $transno  = uniqid();
    $qry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '$transno'");
    $numrows = mysql_num_rows($qry);
}
while($numrows != 0);



$qry10= mysql_query("SELECT * FROM customers WHERE email = '$email'");
if(mysql_num_rows($qry10) == 0)
{
    $password = substr($transno,0,5);
    mysql_query("INSERT INTO customers(name,lname,email,mobile,password) VALUES('$fname','$lname','$email','$contactnumber','$password')");
}
else
{
$row10 = mysql_fetch_array($qry10);
$password = $row10['password'];
}



if($process == 'Walk-in')
{
    if($paymentType == 'Full Payment')
    {
	$paid = $totalAmount;
    $balance = 0;
    }
    else
    {
	$paid = $totalAmount/2;
    $balance = $totalAmount/2;
    }

    if($checkin == date("Y-m-d"))
    {
    mysql_query("INSERT INTO billing(transactionNo,paid,balance,totalAmount) VALUES('$transno','$paid','$balance','$totalAmount')");
    mysql_query("INSERT INTO reservation(transactionNo,referenceno,guestName,reservationDate,checkin,checkout,rate,roomType,numberofRooms,email,mobileNumber,paymentType,numberofperson,roomName,cottageName,process,modeofpayment,status) VALUES('$transno','$reference','$guestName','$reservationDate','$checkin','$checkout','$totalAmount','$combineName','$combineCount','$email','$contactnumber','$paymentType','$numberofperson','$realName','$cotrealName','$process','$modeOfPayment','Reserved')");
    }
    else
    {
    mysql_query("INSERT INTO billing(transactionNo,paid,balance,totalAmount) VALUES('$transno','$paid','$paid','$totalAmount')");
    mysql_query("INSERT INTO reservation(transactionNo,referenceno,guestName,reservationDate,checkin,checkout,rate,roomType,numberofRooms,email,mobileNumber,paymentType,numberofperson,roomName,cottageName,process,modeofpayment,status) VALUES('$transno','$reference','$guestName','$reservationDate','$checkin','$checkout','$totalAmount','$combineName','$combineCount','$email','$contactnumber','$paymentType','$numberofperson','$realName','$cotrealName','$process','$modeOfPayment','Pending')");
    }
   
}
else
{
mysql_query("INSERT INTO reservation(transactionNo,guestName,reservationDate,checkin,checkout,rate,roomType,numberofRooms,email,mobileNumber,paymentType,numberofperson,process,roomName,cottageName,status) VALUES('$transno','$guestName','$reservationDate','$checkin','$checkout','$totalAmount','$combineName','$combineCount','$email','$contactnumber','$paymentType','$numberofperson','$process','$realName','$cotrealName','Pending')")or die(mysql_error());
}
if($paymentType == 'Full Payment')
{
$remainingbal = 0;
}
else
{
$remainingbal = $totalAmount/2;
}
$emailqry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '$transno'");
$rowemail = mysql_fetch_array($emailqry);
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
	Account Number: &nbsp;&nbsp;<b>8912-2100-23</b><br>
	Account Branch: &nbsp;&nbsp;<b>BDO Talisay</b><br>
	Account Name: &nbsp;&nbsp;<b> Talisay Green Lake </b>
	<hr>
	&nbsp;&nbsp;&nbsp;&nbsp;RESERVATION SUMMARY
	<br><br>
	Guest Name:&nbsp;&nbsp;'.$guestName.'<br>
	Reservation Date:&nbsp;&nbsp;<b>'.$checkin.'&nbsp;-&nbsp;'.$checkout.'</b><br>
	Contact Number:&nbsp;&nbsp;<b>'.$contactnumber.'</b><br> 
	<table border="2px">
	<th> Accomodation </th>
	<th> Rate </th>
	<th> No. of Rooms </th>
	<th> No. of days</th>
	<tr>
	<td>'.$rowemail['roomType'].'</td>
	<td>'.$rowemail['rate'].'</td>
	<td><center>'.$rowemail['numberofRooms'].'</center></td>
	<td><center>'.$numberofdays.'</center></td>
	</tr>
	</table><br>
	Payment Arrangement: '.$paymentType.'<br>
	Total Amount : '.$totalAmount.'<br>
	Remaining balance : '.$remainingbal.'
    <hr>
      <p>view your <a href="talisaygreenlake.skyhotelcubao.com/index_login.php"> reservation </a> now.</p>
   </body>
   </html>
     ';

mail($recipient, $subject, $message, $headers);
echo "Your reservation has been accepted, please check your email for the reservation invoice containing the billing details.";
echo '<script>alert("Your reservation has been accepted, please check your email for the reservation invoice containing the billing details."); location.href="index-reservation.php";</script>';
}
else
{
echo '<script>location.href="reservation-1.php?occupied";</script>';
}
?>
