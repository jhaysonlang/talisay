<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
</head>
<?php
    include '../dbconnect.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
        $num = $_REQUEST['num'];
        $qry = mysql_query("SELECT * FROM rooms WHERE roomNum = '$num'");
        $row = mysql_fetch_array($qry);
        $roomNum = $num;
        $view = $row['view'];
    }
     
    if ( null==$id ) {
        header("Location: index-room.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $roomNumError = null;
		$viewError = null;

               
        // keep track post values
        $roomNum = $_POST['roomNum'];
		$view = $_POST['view'];
         
        // validate input
        $valid = true;
        if (empty($roomNum)) {
            $roomNumError = 'Please enter Room Number';
            $valid = false;
        }
		
		if (empty($view)) {
            $viewError = 'Please enter view';
            $valid = false;
        }
        $error = false;
        if ($valid) {
            $error = false;
            $check = mysql_query("SELECT * FROM rooms WHERE roomNum != '$num'");
            while($checkrow = mysql_fetch_array($check))
            {
               if($checkrow['roomNum'] == $roomNum)
               {
                   $error = true;
                   break;
               }
            }

            if($error == true)
            {
                ?>
                <script>
                swal({   
                title: 'Error!',   
                text: 'Room already exist!',   
                type: 'error',   
                confirmButtonText: 'Ok' },
                function()
                {   
                   location.href="update-room.php?num=<?php echo $num;?>&id=<?php echo $id;?>";
                });
                </script>
                <?php
            }
            else
            {
                $roomNum = preg_replace('/ /', '', $roomNum);
                mysql_query("UPDATE rooms SET roomNum = '$roomNum' , view = '$view' WHERE id = '$id' AND roomNum = '$num'");
                mysql_close();
                echo '<script>location.href="index-room.php?id='.$id.'";</script>'; 
            }
        }
    } else {
        $qry = mysql_query("SELECT * FROM roomCategory where id = $id");
        $row = mysql_fetch_array($qry);
        $roomType = $row['roomType'];
		$bedConfiguration = $row['bedConfiguration'];
        $roomRate = $row['roomRate'];
        mysql_close();
    }
?>


 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update Room</h3>
                    </div>
             
                    <form class="form-horizontal" action="update-room.php?num=<?php echo $num;?>&id=<?php echo $id;?>" method="post">
                      <div class="control-group <?php echo !empty($roomNumError)?'error':'';?>">
                        <label class="control-label">Room Number</label>
                        <div class="controls">
                            <input name="roomNum" type="text"  placeholder="Room Number" value="<?php echo !empty($roomNum)?$roomNum:'';?>">
                            <?php if (!empty($roomNumError)): ?>
                                <span class="help-inline"><?php echo $roomNumError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($viewError)?'error':'';?>">
                        <label class="control-label">View</label>
                        <div class="controls">
                            <input name="view" type="text"  placeholder="View" value="<?php echo !empty($view)?$view:'';?>">
                            <?php if (!empty($viewError)): ?>
                                <span class="help-inline"><?php echo $viewError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
        
		