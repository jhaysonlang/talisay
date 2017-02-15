<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/sweetalert2.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
</head>

<?php 
include '../dbconnect.php';
$qry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '".$_GET['id']."'");
$row = mysql_fetch_array($qry);
$qry1 = mysql_query("SELECT * FROM billing WHERE transactionNo = '".$_GET['id']."'");
$row1 = mysql_fetch_array($qry1);
if(isset($_POST['transactionNo']))
{
$id = $_POST['transactionNo'];
if(isset($_POST['paybalance']))
{
  $qry2 = mysql_query("SELECT * FROM billing WHERE transactionNo = '$id'");
  $row2 = mysql_fetch_array($qry2);
  $totalAmount = $row2['totalAmount'];
  $paid = $totalAmount;
  $balance = 0;
  mysql_query("UPDATE billing SET paid = '$totalAmount' , balance = '$balance' WHERE transactionNo = '$id'");   
}
mysql_query("UPDATE reservation SET status = 'Check Out' WHERE transactionNo = '$id'");

echo '<script>location.href="index-reservation.php";</script>';
}
?>

  <br>
    <div class="container">
            <div class="row">
            <table border = "0" width = "60%" cellpadding = "10px" align = "center">
            <tr>
			<th colspan = "2"><h3>Check-out</h3></th>
            </tr>
            <tr>
            <th colspan = "2"><h5>Guest Details</h5></th>
            </tr>
            <tr>
            <td>Guest Name:</td>
            <td><?php echo $row['guestName'];?></td>
            </tr>
            <tr>
            <td>Email:</td>
            <td><?php echo $row['email'];?></td>
            </tr>
             <tr>
            <td>Contact Number:</td>
            <td><?php echo $row['mobileNumber'];?></td>
            </tr>
            <tr>
            <th colspan = "2"><h5>Reservation Details</h5></th>
            </tr>
			<tr>
			</tr>
             <tr>
            <td>Reservation Date:</td>
            <td><?php echo date("F j, Y | g:i A",strtotime($row['reservationDate']))?></td>
            </tr>
            <tr>
            <td>Check-in:</td>
            <td><?php echo date("F j, Y",strtotime($row['checkin']))?></td>
            </tr>
			<tr>
            <td>Check-out:</td>
            <td><?php echo date("F j, Y",strtotime($row['checkout']))?></td>
            </tr>
            <tr>
            <td>Room/Cottage Assigned:</td>
            <td><?php 
			$rooms = explode(',', $row['roomType']);
			$ctr = 0;
			$combineName = array_merge(explode(' ', trim($row['roomName'])),explode(' ', trim($row['cottageName'])));
			foreach ($rooms as $rooms) {
				 echo $rooms . '(' . $combineName[$ctr] .')' . '<br>';
			$ctr++;
			}
			?></td>
            </tr>
			
			<tr>
			<td>Amount</td>
			<td><?php echo '&#x20b1; '.$row['rate']?> </td>
			</tr>
			
			<tr>
			<td>Amenity</td>
			<?php
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
					</tr>
					<td> </td>
					<td><?php echo $amenity?>
					(<?php echo ' &#x20b1; '.number_format((int)$value[$ctrxx],2);?> )
					<?php	
				}
			$ctrxx++;
			}
		}
			

		?>
			<tr>
            <td>Balance:</td>
            <td><?php echo '&#x20b1; ' . number_format($row1['balance'],2)?></td>
            </tr>
            <tr>
            <td>Total Amount:</td>
            <td><?php echo '&#x20b1; ' . number_format($row1['totalAmount'],2)?></td>
            </tr>
			<tr>
			</table>
			<br>
			<div class="row" align = "center">
			<form class = "frm" action = "" method = "POST">
			<input type ="hidden" name = "transactionNo" value = "<?php echo $row['transactionNo'];?>">
            <input type ="hidden" name = "type" class = "type" value = "<?php echo $row1['balance'];?>">
			<?php 
			if($row1['balance'] != 0)
			{
				?>
				<input type="checkbox" class = "paybalance" name="paybalance" value = "Yes"/> Pay Balance
				<?php
			}
			?>
			<br>
			<br>
			<input type="submit" class = "btn btn-success submit" name="checkin" value="Check-out" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a class="btn btn-primary" href="index-reservation.php">Back</a>
			</div>
			</form>
    </div> <!-- /container -->
  </body>
</html>
        
<script>
$('.submit').on('click', function(e){
e.preventDefault();
if($(".paybalance").prop('checked') || $('.type').val() == '0')
{
    swal({   
        title: 'Are you sure?',   
        text: 'You want to check-out?',   
        type: 'warning',   
        showCancelButton: true,   
        confirmButtonColor: '#3085d6',   
        cancelButtonColor: '#d33',   
        confirmButtonText: 'Yes',   
        closeOnConfirm: false }, function() {   
    swal({   
        title: 'Verified!',   
        text: '',   
        type: 'success',   
        confirmButtonText: 'Ok' },
        function()
        {   
        window.open('../report/SOA.php?id=<?php echo $row['transactionNo'];?>','_blank');
        $('.frm').submit();
        });        
    });
}
else
{
swal({   
        title: 'Error!',   
        text: 'Check box is required!',   
        type: 'error',   
        confirmButtonText: 'Ok' });
}
});
</script>
