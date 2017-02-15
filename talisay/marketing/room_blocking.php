<?php 
session_start();
if($_SESSION['usertype'] != 'Marketing')
{
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include '../dbconnect.php';
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Marketing</title>

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
        $qry = mysql_query("SELECT * FROM roomcategory");
$qry1 = mysql_query("SELECT * FROM cottagecategory");
        ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                       <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><img src="img/toggle.png" width="25" height="25"></a><h1>Room Blocking</h1>
                       
                       Select Room/Cottage Category
                       <select class = "link">
                        <option selected hidden value = ""><option>
                        <?php
                        while($row = mysql_fetch_array($qry))
                        {
                            ?>
                            <option value = "../function/calendar.php?type=<?php echo $row['roomType']?>"> <?php echo $row['roomType']?></option>
                            <?php
                        }
                        while($row1 = mysql_fetch_array($qry1))
                        {
                            ?>
                            <option value = "../function/calendar1.php?type=<?php echo $row1['cottageType']?>"> <?php echo $row1['cottageType']?></option>
                            <?php
                        }
                        ?>
                            
                       
                       </select>
                       
                       
                       <iframe src="" width="100%" onload="resizeIframe(this)" frameborder="0" id="iframe" scrolling="no"></iframe>
                       
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
    </script>

</body>

</html>

<script>
$('.link').on('change',function(){
window.open($('.link').val(), '_blank');
})
</script>