<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .reservation{
            font-family: calibri;
            font-size: 1.2em;
        }
.sweet-alert
{
  top:300px !important;
}
</style>
    </style>
    <meta charset="utf-8" content="http-equiv" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Altaroca Resort</title>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert2.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">    
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<?php 
include '../dbconnect.php';
$date1 = date("Y-m-d");
$date2 = date("Y-m-d",strtotime("+1 days",strtotime(date("Y-m-d"))));
if(isset($_GET['checkin']))
{
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];
    if(isset($_GET['process']))
    {
       $process = $_GET['process']; 
    }
    else
    {
        $process = 'Online Reservation';
    }
    $numberofperson = $_GET['numberofperson'];
if(strtotime($checkout) <= strtotime($checkin))
{  
    ?>
                <script>
                swal({   
                title: 'Error!',   
                text: 'Date invalid!',   
                type: 'error',   
                confirmButtonText: 'Ok'
                });
                </script>
    <?php
}
else
{

    echo'<script>location.href="reservation-2.php?d1='.$checkin.'&d2='.$checkout.'&process='.$process.'&numberofperson='.$numberofperson.'"</script>';
}
}
else if(isset($_GET['occupied']))
{
    ?>
                <script>
                window.parent.scrollTo(0, 0);
                swal({   
                title: 'Error!',   
                text: 'Rooms already occupied!',   
                type: 'error',   
                confirmButtonText: 'Ok'
                });
                </script>
    <?php
}
?>


<body>
    <br><br>
<center>
<div class="reservation">
		<img src="../website/images2/step1.jpg" width="700" height="140">
		<br><h2>Select Dates</h2>
		<br><br><br>
        <form action = "" method = "GET">
        <?php 
        session_start();
        if($_SESSION['usertype'] != 'guest')
        {
            ?>
            <input type="radio" <?php echo (!isset($_GET['process'])? '' : (($_GET['process'] == 'Walk-in')? 'checked' : ''));?> class = "radio1"  name = "process" value="Walk-in" required> Walk-in 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" <?php echo (!isset($_GET['process'])? '' : (($_GET['process'] == 'On Phone Call')? 'checked' : ''));?> name = "process" class = "radio2" value="On Phone Call" required> On Phone Call
            <br><br><br>
            <?php
        }
        ?>
		Check-in: &nbsp;&nbsp;
		  <input type="date" name="checkin" min = "<?php echo $date1;?>" value = "<?php echo (!isset($_GET['checkin'])? (!isset($_GET['d1'])? '' : $_GET['d1']) : $_GET['checkin'])?>"required>
		<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
		Check-out: &nbsp;&nbsp;
		  <input type="date" name="checkout" min = "<?php echo $date2;?>" value = "<?php echo (!isset($_GET['checkout'])? (!isset($_GET['d2'])? '' : $_GET['d2']) : $_GET['checkout'])?>" required>
          <br><br>
          Number of Person: &nbsp;&nbsp; <input type="text"  name = "numberofperson" value = "<?php echo (!isset($_GET['numberofperson'])? '' : $_GET['numberofperson'])?>" style = "width:30px" required>
		<br><br><br>
		    <a class="btn btn-primary" href="index-reservation.php">Back</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" class="btn btn-success" name="check" value="Proceed">
</div>  </form>
</center>
	<br><br><br><br>

    
</body>
</html>

