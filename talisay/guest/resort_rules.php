<?php 
session_start();
if(!isset($_SESSION['usertype']) AND $_SESSION['usertype'] != 'guest')
{
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome!</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script language="javascript" type="text/javascript">
	function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>

</head>

<body>
    <div id="wrapper">
        <?php 
        include 'header.php';
        ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                       <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><img src="img/toggle.png" width="25" height="25"></a><h1>Upload Your Receipt Here</h1>
					   <form action ="resort_rules.php" method="post">
					   <input type="file" name="image"><b>
					   <input type="submit" name="submit" value="Upload">
					   </form>
					   
					   <?php
					   if (isset($_POST['submit'])) {
							mysql_connect("localhost","root","");
							mysql_select_db("database_altaroca");
							
							$imageName = mysql_real_escape_string($_FILES["image"]["image_name"]);
							$imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
							$imageType = mysql_real_escape_string($_FILES["image"]["type"]);
							
							if(substr($imageType,0,5) == "image")
							{
								mysql_query("INSERT INTO customers(image_name,image)VALUES ('".$imageName."','".$imageData."')");
							}
							else 
							{
								echo "ff";
							}
							
							echo $imageData;
					   }
					  
					  
					   ?>
					   
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
