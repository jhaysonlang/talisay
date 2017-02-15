<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .reservation{
            font-family: calibri;
            font-size: 1.2em;
        }
    
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
$transactionNo = $_GET['id'];
$qry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '$transactionNo'");
$row = mysql_fetch_array($qry);
$date1 = date("Y-m-d");
$date2 = date("Y-m-d",strtotime("+1 days",strtotime(date("Y-m-d"))));
$checkin1 = $row['checkin'];
$checkout1 = $row['checkout'];
$numberofperson = $row['numberofperson'];
if(isset($_GET['checkin']))
{
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];
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
    echo'<script>location.href="modifyreservation2.php?id='.$transactionNo.'&d1='.$checkin.'&d2='.$checkout.'&numberofperson='.$numberofperson.'"</script>';
}
}
else if(isset($_GET['occupied']))
{
    ?>
                <script>
                swal({   
                title: 'Error!',   
                text: 'Rooms already occupied!',   
                type: 'error',   
                confirmButtonText: 'Ok'
                });
                </script>
    <?php
}

if(isset($_GET['d1']))
{
$_GET['checkin'] = $_GET['d1'];
$_GET['checkout'] = $_GET['d2'];
}
?>


<body>
    <br><br>
<center>
<div class="reservation">
		<img src="../website/images2/step1.png" width="450" height="60">
		<br><h2>Select Reservation Dates</h2>
		<br><br><br>
        <form action = "modifyreservation1.php" method = "GET">
		Check-in: &nbsp;&nbsp;
          <input type = "hidden" name = "id" value = "<?php echo $transactionNo;?>">
		  <input type="date" name="checkin" min = "<?php echo $date1;?>" value = "<?php echo (!isset($_GET['checkin'])? $checkin1 : $_GET['checkin'])?>"required>
		<?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?>
		Check-out: &nbsp;&nbsp;
		  <input type="date" name="checkout" min = "<?php echo $date2;?>" value = "<?php echo (!isset($_GET['checkout'])? $checkout1 : $_GET['checkout'])?>" required>
          <br><br>
          Number of Person: &nbsp;&nbsp; <input type="text"  name = "numberofperson" value = "<?php echo (!isset($_GET['numberofperson'])? $numberofperson : $_GET['numberofperson'])?>" style = "width:30px" required>
		<br><br><br>
		    <a class="btn" href="index-reservation.php">Back</a>
			<input type="submit" class="btn" name="check" value="Proceed">
</div>  </form>
</center>
	<br><br><br><br>

    
</body>
</html>