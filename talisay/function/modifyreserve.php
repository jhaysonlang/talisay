<?php 
include '../dbconnect.php';
$id = $_POST['id'];
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
$guestName = $fname . ' ' . $lname;
$reservationDate = date("Y-m-d H:i:s");
$numberofperson = $_POST['numberofperson'];

$qry10 = mysql_query("SELECT * FROM customers WHERE email = '$email'");
$row10 = mysql_fetch_array($qry10);
$password = $row10['password'];

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
	$qry1 = mysql_query("SELECT * FROM reservation WHERE (status = 'Pending' OR status = 'Reserved' OR status = 'Check In') AND transactionNO != '$id' AND roomType LIKE '%".$row['roomType']."%'");
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
            if($explodearr)
            {
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
    $cotqry1 = mysql_query("SELECT * FROM reservation WHERE (status = 'Pending' OR status = 'Reserved' OR status = 'Check In') AND transactionNO != '$id' AND roomType LIKE '%".$cotrow['cottageType']."%'");
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

$headers = 'From: Altaroca <no-reply@altaroca.ph>\n';
$headers.= 'Content-type: text/html; charset=utf-8\n';
$recipient = $email;
$subject = "Transaction Details";
$message = '
     <html>
     <body>
     <h1>AltaRoca Mountain Resort and Events Place</h1>
     <p style="font-size:1.2em;">
     Hello '.$guestName.'! Thank you for creating a reservation in our resort. Please take note of your following details:
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction Number:'.$id.'
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-mail:'.$email.'
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password:'.$password.'
    </p>
   </body>
   </html>
     ';

mail($recipient, $subject, $message, $headers);




$qry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '$id'");
$row = mysql_fetch_array($qry);
if($row['status'] == 'Reserved')
{
mysql_query("UPDATE billing SET totalAmount = '$totalAmount' WHERE transactionNo = '$id'");
mysql_query("UPDATE reservation SET guestName = '$guestName' , reservationDate = '$reservationDate', checkin = '$checkin', checkout = '$checkout' , rate = '$totalAmount' , roomType = '$combineName' , rate = '$totalAmount' , numberofRooms = '$combineCount' , email = '$email' , mobileNumber = '$contactnumber' WHERE transactionNo = '$id'");
header("location:index-reservation.php");
}
else
{
mysql_query("UPDATE reservation SET guestName = '$guestName' , reservationDate = '$reservationDate', checkin = '$checkin', checkout = '$checkout' , rate = '$totalAmount' , roomType = '$combineName' , numberofRooms = '$combineCount' , email = '$email' , mobileNumber = '$contactnumber' , paymentType = '$paymentType' , numberofperson = 
'$numberofperson' , roomName = '$realName' , cottageName = '$cotrealName' WHERE transactionNo = '$id'");
header("location:index-reservation.php");
}
}
else
{
echo '<script>location.href="modifyreservation1.php?occupied";</script>';   
}
?>