<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/sweetalert2.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
<style>
.sweet-alert
{
  top:300px !important;
}
/* Style the Image Used to Trigger the Modal */
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 190px;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
	max-height: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption { 
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>

<?php 
include '../dbconnect.php';
$qry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '".$_GET['id']."'");
$qry1 = mysql_query("SELECT * FROM billing WHERE transactionNo = '".$_GET['id']."'");
$row = mysql_fetch_array($qry);
$row1 = mysql_fetch_array($qry1);

if(isset($_POST['transactionNo']))
{
$id = $_POST['transactionNo'];
$referenceno = $_POST['referenceno'];
$totalAmount = $_POST['totalAmount'];
$paymentType = $_POST['paymentType'];
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
mysql_query("UPDATE reservation SET referenceno = '$referenceno' , status = 'Reserved' WHERE transactionNo = '$id'");
mysql_query("INSERT INTO billing(transactionNo,paid,balance,totalAmount) VALUES('$id','$paid','$balance','$totalAmount')");
echo '<script>location.href="index-reservation.php";</script>';
}
?>

  <br>
    <div class="container">
            <div class="row">
            <table border = "0" width = "60%" cellpadding = "10px" align = "center">
            <tr>
			<th colspan = "2"><h3>Verify Reservation</h3></th>
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
            <td>Rooms/Cottages:</td>
            <td><?php 
			$rooms = explode(',', $row['roomType']);
			foreach ($rooms as $rooms) {
				 echo $rooms . '<br>';
			}
			?></td>
            </tr>
            <tr>
            <td>Total Amount:</td>
            <td><?php echo '&#x20b1; ' . number_format($row['rate'],2)?></td>
            </tr>
            <tr>
            <td>Balance:</td>
            <td><?php echo '&#x20b1; ' . number_format($row['rate'],2)?></td>
            </tr>
			<tr>
			<td> Receipt Image: </td>
			<td> <?php if(!empty($row['image']))
						{
						echo '<img id="myImg" src="../guest/img/receipt'.$row['image'].'" height="200px" width="200px">' ;
						echo '<center><div id="myModal" class="modal">';
						echo '<span class="close">&times;</span>';
						echo '<img class="modal-content" id="img01">';
						echo '<div id="caption"></div>';
						echo '</div></center>';
						}
						else
						{
						echo '<p style="color:red";>No image uploaded</p>';
						}
				?>	</td>
			</table>
			<br>
			<div class="row" align = "center">
			<form class = "frm" action = "" method = "POST">
			<input type ="hidden" name = "transactionNo" value = "<?php echo $row['transactionNo'];?>">
			<input type ="hidden" name = "totalAmount" value = "<?php echo $row['rate'];?>">
			<input type ="hidden" name = "paymentType" value = "<?php echo $row['paymentType'];?>">
			<br>
							  
			<h4 >Reference Number: <input type="text" class = "referenceno" name="referenceno" placeholder="Transaction Number"></h4>
			<input type="submit" class="btn btn-success submit verify" value = "Verify">
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
    swal({   
        title: 'Are you sure?',   
        text: 'You want to verify this reservation?',   
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
        $('.frm').submit();
        });        
    });
});  

// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>