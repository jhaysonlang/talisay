<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/sweetalert2.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
</head>
<body>
  <br>
  <center>
    <div class="container">
    
            <div class="row">
				<h2>Select Range:</h2>
        <br><br>
            </div>
            <div class="row">
              <input type="radio" name = "type" class = "type" value="Billing" checked required> Billing
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" name = "type" class = "type" value="Reservation" required> Reservation</td>
              <br><br>
              <div class = "forreserve" style = "display:none;">
              Filter: <select name = "status" class = "status">
                    <option hidden selected><?php echo (!isset($_GET['status'])?'All':$_GET['status'])?></option>
                    <option value = "All">All</option>
                    <option value = "Pending">Pending</option>
                    <option value = "Reserved">Reserved</option>
                    <option value = "Check In">Check In</option>
                    <option value = "Check Out">Check Out</option>
                    <option value = "Cancelled">Cancelled</option>
                    <option value = "No-show">No-show</option>
                    </select>
              </div>
              <div class = "forbilling" >
              Filter: <select name = "status" class = "status">
                    <option hidden selected><?php echo (!isset($_GET['status'])?'All':$_GET['status'])?></option>
                    <option value = "All">All</option>
                    <option value = "Reserved">Reserved</option>
                    <option value = "Check In">Check In</option>
                    <option value = "Check Out">Check Out</option>
                    <option value = "No-show">No-show</option>
                    </select>
              </div>
			<br><br>
			Start: <input type="date" class = "date1" name="startrange"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			End: <input type="date" class = "date2" name="endrange"/>
			
			<br><br>
			<a class="btn" href="">Proceed</a>
			 
        </div>
    </div> <!-- /container -->
  </center>
  </body>
</html>
        
<script>
var status = 'All';
$('.status').on('change',function(){
status = $(this).val();
});
$('.btn').on('click',function(e){
  e.preventDefault();

if($('.date1').val().trim() == '' || $('.date2').val().trim() == '' || (!$('.type').is(':checked')))
{
swal({   
title: 'Error!',   
text: 'All fields are required!',   
type: 'error',   
confirmButtonText: 'Ok' });
}
else
{
var link1 = $('.date1').val();
var link2 = $('.date2').val();
if($('.type:checked').val() == 'Reservation')
{
var link = "../report/reservation_report.php?d1=" + link1 + "&d2=" + link2 + "&status=" +status;
}
else
{
var link = "../report/billing-report.php?d1=" + link1 + "&d2=" + link2 + "&status=" +status;
}
window.open(link, '_blank');
}
});

$('.type').on('click',function(){
if($('.type:checked').val() == 'Reservation')
{
$('.forbilling').css('display','none');
$('.forreserve').css('display','block');
}
else
{
$('.forbilling').css('display','block');
$('.forreserve').css('display','none');
}
});
</script>