<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<?php 
include '../dbconnect.php';
$qry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '".$_GET['id']."'");
$qry1 = mysql_query("SELECT * FROM billing WHERE transactionNo = '".$_GET['id']."'");
$row = mysql_fetch_array($qry);
$row1 = mysql_fetch_array($qry1);

if(isset($_POST['transactionNo']))
{
$id = $_POST['transactionNo'];
mysql_query("UPDATE reservation SET status = 'Check In' WHERE transactionNo = '$id'");
header("location: index-reservation.php");
}
?>

  <br>
    <div class="container">
    		<form action = "" method = "POST">
            <div class="row">
			<h3>Check-in</h3>
            <h4>Transaction No.: <?php echo $row['transactionNo'];?></h4>
            <h4>Guest Name: <?php echo $row['guestName']?></h4>
			<h4>E-mail: <?php echo $row['email']?></h4>
			<h4>Contact No.: <?php echo $row['mobileNumber']?></h4>
			<h4>Reservation Date: <?php echo date("F j, Y | g:i",strtotime($row['reservationDate']))?></h4>
			<h4>Check-in: <?php echo date("F j, Y",strtotime($row['checkin']))?></h4>
			<h4>Check-out: <?php echo date("F j, Y",strtotime($row['checkout']))?></h4>
			<h4>Rooms: 
			<?php 
			$rooms = explode(',', $row['roomType']);
			foreach ($rooms as $rooms) {
				 echo $rooms . ' ';
			}
			?></h4>
			<h4>Total Amount: <?php echo $row['totalAmount'];?></h4>
			<h4>Balance: <?php echo $row1['balance'];?></h4>			
			<br>
			<h4>Reference Number: <input type="text" name="tNumber" placeholder="Transaction Number"></h4>
            </div>
			<br>
			<div class="row">
			<br>
			<input type ="hidden" name = "transactionNo" value = "<?php echo $row['transactionNo'];?>">
			<input type="submit" class="btn btn-success submit" value = "Check In">
			</div>
			</form>
    </div> <!-- /container -->
  </body>
</html>
        
<script>
$('.submit').on('click', function(e){
e.preventDefault();
if($(".paybalance").prop('checked') == true)
{


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