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
$msg = '';
if(isset($_POST['upload'])){
	
	$target = "img/receipt/" .basename($_FILES['image']['name']);
	$db = mysqli_connect('localhost','root','','talisay') or die('Unable To connect');
	
	$image = $_FILES['image']['name'];
	$transactionNo = $_POST['transactionNo'];
	$sql= "UPDATE reservation SET image = '$image' where transactionNo = '$transactionNo'";
    mysqli_query($db,$sql);
	
	if(move_uploaded_file($_FILES['image']['tmp_name'],$target)) {
		$msg = "Image Uploaded";
		
	}
	else {
		$msg = "Image is not good";
	}
	

}
?>
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
					  <form action="uploadreciept.php" method="post" enctype="multipart/form-data">
					    Enter your transaction number: <input type="text" name="transactionNo"> 
					    <br><br>
					   <input type="file" name="image"><b><br>
					  <input type="submit" name="upload" value="Upload Image">
					  <br>
					  <br>
					   <?php echo $msg?>
					  
					   </form>
					   

					   
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
