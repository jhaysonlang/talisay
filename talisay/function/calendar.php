<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link   href="css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<style>
th
{
	width: 70px;
	height: 70px;
}
td
{
	border: none;
}
table
{
	color: yellow;
	background: gray;
	border-color: white;
}

</style>
<?php
session_start();
include '../dbconnect.php';
$roomType = $_GET['type'];
$charot = mysql_query("SELECT * FROM roomcategory WHERE roomType = '$roomType'");
$charow = mysql_fetch_array($charot);
date_default_timezone_set('Etc/GMT-8');
$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
if(isset($_GET['prev']))
{
$year = $_GET['year'];
$month = $_GET['month'];
$startday = date('w',strtotime("-1 month",strtotime($year.'-'.$month.'-'.'1')));
$endday = date('t',strtotime("-1 month",strtotime($year.'-'.$month.'-'.'1')));
$date = date('Y-m-d',strtotime("-1 month",strtotime($year.'-'.$month.'-'.'1')));
$year = date("Y",strtotime($date));
$month = date("m",strtotime($date));
}
else if(isset($_GET['next']))
{
$year = $_GET['year'];
$month = $_GET['month'];
$startday = date('w',strtotime("+1 month",strtotime($year.'-'.$month.'-'.'1')));
$endday = date('t',strtotime("+1 month",strtotime($year.'-'.$month.'-'.'1')));
$date = date('Y-m-d',strtotime("+1 month",strtotime($year.'-'.$month.'-'.'1')));
$year = date("Y",strtotime($date));
$month = date("m",strtotime($date));
}
else
{
$date = date("Y-m-d");
$year = date("Y",strtotime($date));
$month = date("m",strtotime($date));
$startday = date('w',strtotime($year.'-'.$month.'-'.'1'));
$endday = date('t',strtotime($year.'-'.$month.'-'.'1'));
}
$ctr = 0;
$daysctr = 1;
?>
<input type ="hidden" class = "type" value = "<?php echo $roomType;?>">
<br><br><br>
<div align = "center">
<h2><?php echo $roomType;?></h2>
</div>
<div class = "calendar">
<table border = "2" width = "80%" align = "center">
<tr>
	<th><a href = "#" data-month="<?php echo $month;?>" data-year = "<?php echo $year;?>" class = "prev"><img src= "img/previous.png"></a></th>
	<th colspan = "5"><?php echo date('F',strtotime($date)) . ' ' . $year;?></th>
	<th><a href = "#" data-month="<?php echo $month;?>" data-year = "<?php echo $year;?>" class = "next"><img src= "img/next.png"></a></th>
</tr>	
<tr>
	<?php 
	foreach ($headings as $headings) {
		echo'<th>'.$headings.'</th>';
	}
	?>
</tr>
<tr>
<?php 
while($endday > $ctr)
{
	$ctr++;
	if($startday == $ctr)
	{
		echo '<th></th>';
	}
	else
	{
		break;
	}
}

while($endday >= $daysctr)
{
	if(strtotime($year.'-'.$month.'-'.$daysctr) < strtotime(date("Y-m-d")))
	{
		echo '<th style ="background:black;">'.$daysctr.'</th>';
	} 
	else{
	$qry = mysql_query("SELECT * FROM reservation WHERE (status = 'Pending' OR status = 'Reserved' OR status = 'Check In') AND roomType LIKE '%".$roomType."%'");
    $qrycat = mysql_query("SELECT * FROM rooms WHERE id = '".$charow['id']."'");
    $name = '';
    $count = '';
    $numcat = mysql_num_rows($qrycat);
    while($row = mysql_fetch_array($qry)) 
    {
      if((strtotime($row['checkin']) <= strtotime($year.'-'.$month.'-'.$daysctr) && strtotime($row['checkout']) >= strtotime($year.'-'.$month.'-'.$daysctr)))
      {
        $explode = explode(',',trim($row['roomType']));
        if(count($explode) > 0)
        {
      	  $name = $name . ' ' . $row['guestName'];
          $key = 0;
          foreach ($explode as $explode) {
            if($explode == $roomType)
            {
              break;
            }
            $key++;
          }
         $explode1 = explode(',',trim($row['numberofRooms']));
         $numcat = $numcat - $explode1[$key];
        }
        else
        {
          $numcat = $numcat - $row['numberofRooms'];
          $name = $name . ' ' . $row['guestName'];
        }
      }
    }
	if($numcat <= 0)
    {
      $names = explode(' ', $name);
      echo '<th style ="background:red;">'.$daysctr.'<br>'; 
      if($_SESSION['usertype'] != 'guest')
      {
      foreach ($names as $names) {
      	echo $names . '<br>';
      }
  	  }'</th>';
    }
    else
    {
      $names = explode(' ', $name);
      $count = explode(' ', $name);
      echo '<th style ="background:green;">'.$daysctr.'<br> Available Rooms:' . $numcat.'</th>';
    }
    }
	if($ctr % 7 == 0)
	{
		echo '</tr>';
	}
	else
	{
		if($endday == $daysctr)
		{
			$loop = 7-($ctr % 7);
			for ($x = 0; $x < $loop; $x++) {
    		echo '<td></td>';
			} 
		}
	}
	$ctr++;
	$daysctr++;
}
?>
</tr>
</table>
<br><br>
<div align = "center">
<img src = "../function/glyph/legend.png">
<br><br>
</div>


</div>
<script>
$(document).ready(function(){
	$('.prev').on('click',function(e){
		var month = $('.prev').data('month');
		var year = $('.prev').data('year');
		var type = $('.type').val();
      	location.href="calendar.php?prev&month="+month+"&year="+year+"&type="+type;
	});

	$('.next').on('click',function(e){
		var month = $('.prev').data('month');
		var year = $('.prev').data('year');
		var type = $('.type').val();
		location.href="calendar.php?next&month="+month+"&year="+year+"&type="+type;
        $.ajax({
          type: 'POST',
          url: "next.php",
          data: {month:month,year:year},
          success: function(data)
          {
            $('.calendar').html(data);
          }
        })
	});
});
</script>

