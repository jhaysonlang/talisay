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
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $viewError = null;
		$roomNumError = null;
        
         
        // keep track post values
        $roomNum = $_POST['roomNum'];
		$view = $_POST['view'];
        $id = $_GET['id'];
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
              
        // insert data
        if ($valid) {
            $roomNum = preg_replace('/ /', '', $roomNum);
            $qry = mysql_query("SELECT * FROM rooms WHERE roomNum = '$roomNum'");
            if(mysql_num_rows($qry) > 0)
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
                   location.href="create-room.php?id=<?php echo $_GET['id'];?>";
                });
                </script>
                <?php
            }
            else
            {
            mysql_query("INSERT INTO rooms(roomNum,id,view) values('$roomNum','$id','$view')");
            mysql_close();
            echo '<script>location.href="index-room.php?id='.$id.'";</script>';
            }
        }
    }
?>



 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Add Room</h3>
                    </div>
             
                    <form class="form-horizontal" action="" method="POST">
                      <div class="control-group <?php echo !empty($roomNumError)?'error':'';?>">
                        <label class="control-label">Room Number</label>
                        <div class="controls">
                            <input name="roomNum" type="text"  placeholder="Room Num" value="<?php echo !empty($roomNum)?$roomNum:'';?>">
                            <?php if (!empty($roomNumError)): ?>
                                <span class="help-inline"><?php echo $roomNumError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($viewError)?'error':'';?>">
                        <label class="control-label">View</label>
                        <div class="controls">
                            <input name="view" type="text"  placeholder="View" value="<?php echo !empty($bedConfiguration)?$bedConfiguration:'';?>">
                            <?php if (!empty($viewError)): ?>
                                <span class="help-inline"><?php echo $viewError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index-room.php?id=<?php echo $_GET['id']?>">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
  
  