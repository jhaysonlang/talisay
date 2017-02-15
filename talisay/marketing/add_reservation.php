<?php 
session_start();
if($_SESSION['usertype'] != 'Marketing')
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

    <title>Admin - Create Reservation</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script language="javascript" type="text/javascript">
	function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <?php 
        include 'header.php';
        ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                       <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><img src="img/toggle.png" width="25" height="25"></a><h1>Reservation Module</h1>
					   
					   <iframe src="../function/index-reservation.php" width="100%" onload="resizeIframe(this)" frameborder="0" id="iframe" scrolling="no"></iframe>
					   
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $('#iframe').load(function(){
        $(window).scrollTop(150);
        var iframe = $('#iframe').contents();

        iframe.find('.preview').click(function(){
               if($(document).scrollTop() <= 199)
                {
                    $(window).scrollTop(200);
                }
               iframe.find('style').append('.pp_pic_holder.pp_default{top:'+($(document).scrollTop()-130)+'px !important;width: 879px !important;left:75px !important}');   
               iframe.find('style').append('#fullResImage{height: 567px !important;width: 847px !important;}');  
               iframe.find('style').append('.pp_content{height: 603px !important;width: 847px !important;}');  
               iframe.find('style').append('.pp_details{width: 847px !important;}');  
        });
        iframe.find('.verify').click(function(){
               $('#iframe').css("height","600px");
        });
    });
    </script>

</body>

</html>
