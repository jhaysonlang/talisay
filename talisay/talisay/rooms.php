<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Room & Rates</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Go Travel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200,300,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300' rel='stylesheet' type='text/css'>
<script src="js/bootstrap.js"></script>
</head>
<style>
	.img-responsive {
		height:200px;
		width:400px;
	}
</style>

<body>
		<!--header-->
			<div class="header banr">
				<div class="container">
					<div class="header-top">
						<nav class="navbar navbar-default">
							<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
								<div class="navbar-header">
									  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
									  </button>
									<div class="navbar-brand">
											<img src="images/logos.png" class="logo">
									</div>
								</div>

    <!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							  <ul class="nav navbar-nav">
									<li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
									<li><a href="about.php">About</a></li>
									<li class="active"><a href="rooms.php">Rooms</a></li>
									<li><a href="booking.php">Booking</a></li>
									<li><a href="contact.php">Contact</a></li>
									<li><a href="offers.php">Offers</a></li>
									<li><a href="../index_login.php">Login</a></li>				
								</ul>
							  
							</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
						</nav>

					</div>
			</div>
	</div>

	
<!--header-->
		<div class="content w3layouts-agileits">
			<!--services-->
			<div class="services">
				<div class="container">
					<h2>Rooms & Rates</h2>
					
						<?php include('../dbconnect.php'); 
		
				$getLinks = "SELECT * FROM roomcategory";
				$result = mysql_query($getLinks);
				while($rs=mysql_fetch_array($result)) {
				
				
				$rooms = $rs['roomType'];
				$capacity = $rs['capacity'];
				$bedConfiguration = $rs['bedConfiguration'];
				$description = $rs['description'];
				$roomRate = $rs['roomRate'];
				$roomimage = $rs['upload'];
				$rates = number_format($roomRate,0);
				
				
					echo '<div class="services-grids w3ls-agileits">';
					echo '	<div class="col-md-3 services-grid">';
					echo '		<div class="ser1">';
					echo '		<img src="images/rooms/'.$roomimage. '.jpg" class="img-responsive" >' ;
					echo '			 <h4>'.$rooms.'</h4>';
					echo '			 <p>'.$description.'<br>----------------------------<br>'.$bedConfiguration.'<br>----------------------------<br></p>';
					echo '			 <p>Capacity: '.$capacity.'<br> Rate: Php '.$rates.'</p>';
					echo '			 <br><br><br>';
					echo '		</div>';
					echo '	</div>';
					echo '</div>';	
								
				}
	?>
			
				</div>	
			</div>	
		</div>
	<!--footer-->
				<div class="footer-section-wthree-agile">
					<div class="container">
						
						<div class="footer-top-w3ls-agileits">
							<p>&copy; 2017 Talisay Green Lake Resort</p>
						</div>						
					</div>
				</div>
			<!--footer-->
</body>
</html>
