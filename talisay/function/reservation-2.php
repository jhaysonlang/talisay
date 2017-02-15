<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>AltaRoca Resort</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/sweetalert2.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">  
    <link href="../website/css/font-awesome.min.css" rel="stylesheet">
    <link href="../website/css/prettyPhoto.css" rel="stylesheet">
    <link href="../website/css/animate.css" rel="stylesheet">
    <link href="../website/css/main.css" rel="stylesheet">
    <script src="../website/js/jquery.prettyPhoto.js"></script>
    <script src="../website/js/jquery.isotope.min.js"></script>
    <script src="../website/js/main.js"></script>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
<style>
.free{
  color:red;
}
.bedconfig{
  font-style: italic;
}
select
{
  width: 50px;
}
img,.item-inner
{
  border-radius: 15px;
}
.sweet-alert
{
  top:300px !important;
}
</style>
</head><!--/head-->
<?php 
include '../dbconnect.php';
$qry = mysql_query("SELECT * FROM roomcategory");
$qryy = mysql_query("SELECT * FROM cottagecategory");
$checkin = $_GET['d1'];
$checkout = $_GET['d2'];
$numberofperson = $_GET['numberofperson'];
$recommendedqry = mysql_query("SELECT * FROM roomcategory ORDER BY capacity ASC");
while ($recommendedrow = mysql_fetch_array($recommendedqry)) {
if($numberofperson <= $recommendedrow['capacity'])
{
  $recommended = $recommendedrow['roomType'];
  break;
}
else
{
  $recommendedqry1 = mysql_query("SELECT * FROM roomcategory ORDER BY capacity DESC");
  $recommendedrow1 = mysql_fetch_array($recommendedqry1);
  $recommended = $recommendedrow1['roomType'];
}
}
?>
<body style = "background:white;">
<br><br>
<center>
  <div class = "holder"></div>
<div class="reservation">
		<img src="../website/images2/step2.jpg" width="700" height="140">
		<br><h2>Select Rooms</h2>
		<br>
    <h3>Recommended Room: <?php echo $recommended;?></h3>
    <h4><?php echo date("F j, Y",strtotime($checkin)) . ' - ' . date("F j, Y",strtotime($checkout));?></h4>
    <p>Rooms Inclusions: </p><p class="free">Free Entrance</p> <p class="free">Free use of swimming pool</p> <p class="free">Free use of private cabanas<br> </p>
<form action = "reservation-3.php" method = "GET">
	<h4>Rooms</h4>
	<!--roomcategory-->
	<table class="table-hover" width="90%" border="1" cellpadding = "10px" style = "text-align:center;font-weight:bold;">
		<tr>
			<th colspan = "2">Room Type</th>
			<th>Room Description</th>
      <th>Capacity</th>
			<th>Room Rate</th>
			<th>Select Number of Rooms:</th>
		</tr>
		<?php 
		while($row = mysql_fetch_array($qry))
		{
		?>
		<tr>
      <td style = "width:200px;height:150px"><!--insert image-->
      <li class="portfolio-item accomodation apps" style = "list-style-type: none;width:100%;height:100%;">
                <div class="item-inner" style = "width:100%;height:100%;padding:0;margin:0;border:none;">
                    <img src="images1/<?php echo strtolower(preg_replace('/ /', '', $row['roomType']))?>.jpg" style = "width:100%;height:100%" alt="">
                    <div class="overlay" style = "width:100%;height:100%">
                        <a class="preview btn btn-danger" href="images1/<?php echo strtolower(preg_replace('/ /', '', $row['roomType']))?>.jpg" rel="prettyPhoto"></a>              
                    </div>           
                </div>           
            </li>    
      </td>
			<td><a style ="color:red;" class = "link type-room" href = "calendar.php?type=<?php echo $row['roomType'];?>"><?php echo $row['roomType'];?></a></td>
			<td><p class="bedconfig"><?php echo $row['bedConfiguration'];?></p></td>
      <td><?php echo $row['capacity'];?></td>
			<td><?php echo '&#x20b1; ' . number_format($row['roomRate'],2);?></td>
			<td>
			<?php
			$qry1 = mysql_query("SELECT * FROM reservation WHERE (status = 'Pending' OR status = 'Reserved' OR status = 'Check In') AND roomType LIKE '%".$row['roomType']."%'");
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
    		if($numcat1 <= 0)
   		 	{
          echo '<input type = "hidden" name = "rooms[]" value = "">';
      		echo 'No available rooms!';
    		}
    		else
    		{
    		?>
			<select name = "rooms[]">
			<option selected value =""></option>
			<?php 
			$ctr1 = 1;
     		while($numcat1 >= $ctr1)
      		{
			?>
			<option value ="<?php echo $ctr1;?>"><?php echo $ctr1;?></option>
			<?php
			$ctr1++;
			}
			}
			?>
			</select>
			</td>
		</tr>
		<?php 
		}
		?>
	</table>
	<br>
	<br><br>
  <h4>Cottages</h4>
  <!--roomcategory-->
  <table width="90%" border="1" cellpadding = "10px" style = "text-align:center;font-weight:bold;">
    <tr>
      <th colspan = "2">Cottage Type</th>
      <th>Cottage Rate</th>
      <th>Select Number of Cottage:</th>
    </tr>
    <?php 
    while($roww = mysql_fetch_array($qryy))
    {
    ?>
    <tr>
      <td style = "width:200px;height:150px"><!--insert image-->
      <li class="portfolio-item accomodation apps" style = "list-style-type: none;width:100%;height:100%;">
                <div class="item-inner" style = "width:100%;height:100%;padding:0;margin:0;border:none;">
                    <img src="images2/<?php echo strtolower(preg_replace('/ /', '', $roww['cottageType']))?>.jpg" style = "width:100%;height:100%" alt="">
                    <div class="overlay" style = "width:100%;height:100%">
                        <a class="preview btn btn-danger" href="images2/<?php echo strtolower(preg_replace('/ /', '', $roww['cottageType']))?>.jpg" rel="prettyPhoto"></a>              
                    </div>           
                </div>           
            </li>    
      </td>
      <td><a style = "color:red;" class = "link" href = "calendar1.php?type=<?php echo $roww['cottageType'];?>"><?php echo $roww['cottageType'];?></a></td>
      <td><?php echo '&#x20b1; ' . number_format($roww['cottageRate'],2);?></td>
      <td>
      <?php
      $qryy1 = mysql_query("SELECT * FROM reservation WHERE (status = 'Pending' OR status = 'Reserved' OR status = 'Check In') AND roomType LIKE '%".$roww['cottageType']."%'");
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
        if($nummcat1 <= 0)
        {
          echo '<input type = "hidden" name = "cottages[]" value = "">';
          echo 'No available rooms!';
        }
        else
        {
        ?>
      <select name = "cottages[]">
      <option selected value =""></option>
      <?php 
      $ctrr1 = 1;
        while($nummcat1 >= $ctrr1)
          {
      ?>
      <option value ="<?php echo $ctrr1;?>"><?php echo $ctrr1;?></option>
      <?php
      $ctrr1++;
      }
      }
      ?>
      </select>
      </td>
    </tr>
    <?php 
    }
    ?>
  </table>
  <br><br>
	<input type = "hidden" name = "checkin" value = "<?php echo $_GET['d1'];?>">
	<input type = "hidden" name = "checkout" value = "<?php echo $_GET['d2'];?>">
  <input type = "hidden" name = "process" value = "<?php echo $_GET['process'];?>">
  <input type = "hidden" name = "numberofperson" value = "<?php echo $_GET['numberofperson'];?>">
	<input type="button" name="check" class="btn btn-primary back" value="Back" >
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="check" class = "btn btn-success submit" value="Proceed">
</form>
<br><br><br>

    

    
</body>
</html>
<script>
$(document).ready(function() {
$('.link').on('click', function(e){
e.preventDefault();
window.open($(this).attr('href'), '_blank');
});

$('.back').on('click',function(){
location.href = "reservation-1.php?d1=<?php echo $_GET['d1'];?>&d2=<?php echo $_GET['d2'];?>&process=<?php echo $_GET['process'];?>&numberofperson=<?php echo $_GET['numberofperson'];?>";
})

$('.submit').on('click',function(e){
    if($('select').length > 0)
    {
      $('select').each(function(){
        if($(this).val() == '')
        {
          checker = false;
          e.preventDefault();
        }
        else
        {
          checker = true;
          return false;
        }
      });
    }
    
    if(checker == false)
    {
    window.parent.scrollTo(0, 0);
                swal({   
                title: 'Error!',   
                text: 'Select an option!',   
                type: 'error',   
                confirmButtonText: 'Ok'
                });
    }
    else
    {
    $('form').submit();
    }

});
});
</script>