<?php 
    include '../dbconnect.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $functionNameError = null;
		$functionRateError = null;
        $functionPerHourError = null;
         
        // keep track post values
        $functionName = $_POST['functionName'];
		$functionRate = $_POST['functionRate'];
        $functionPerHour = $_POST['functionPerHour'];
        // validate input
        $valid = true;
        if (empty($functionName)) {
            $functionNameError = 'Please enter Room Name';
            $valid = false;
        } 
		
		if (empty($functionRate)) {
            $functionRateError = 'Please enter Room Rate';
            $valid = false;
        } else if (!(ctype_digit($functionRate))){
            $functionRateError = 'Please enter valid Room Rate';
            $valid = false;
        }
         
        if (empty($functionPerHour)) {
            $functionPerHourError = 'Please enter Hours';
            $valid = false;
        } else if (!(ctype_digit($functionPerHour))){
			$functionPerHourError = 'Please enter valid Hours';
            $valid = false;
		}

         
        // insert data
        if ($valid) {
            $check = mysql_query("SELECT * FROM functionroom WHERE frname = '$functionName'");
            if(mysql_num_rows($check) > 0)
            {
                echo '<script>alert("Room Already Exist!"); location.href="create-function.php";</script>';
            }
            else
            {
            mysql_query("INSERT INTO functionroom (frname,frRate,perHour) values('$functionName', '$functionRate', '$functionPerHour')");
            mysql_close();
            header("Location: index-function.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Add Room</h3>
                    </div>
             
                    <form class="form-horizontal" action="" method="POST">
                      <div class="control-group <?php echo !empty($functionNameError)?'error':'';?>">
                        <label class="control-label">Room Name</label>
                        <div class="controls">
                            <input name="functionName" type="text"  placeholder="Room Name" value="<?php echo !empty($functionName)?$functionName:'';?>">
                            <?php if (!empty($functionNameError)): ?>
                                <span class="help-inline"><?php echo $functionNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($functionRateError)?'error':'';?>">
                        <label class="control-label">Room Rate</label>
                        <div class="controls">
                            <input name="functionRate" type="text"  placeholder="Room Rate" value="<?php echo !empty($functionRate)?$functionRate:'';?>">
                            <?php if (!empty($functionRateError)): ?>
                                <span class="help-inline"><?php echo $functionRateError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($functionPerHourError)?'error':'';?>">
                        <label class="control-label">Per Hour</label>
                        <div class="controls">
                            <input name="functionPerHour" type="text"  placeholder="Per Hour" value="<?php echo !empty($functionPerHour)?$functionPerHour:'';?>">
                            <?php if (!empty($functionPerHourError)): ?>
                                <span class="help-inline"><?php echo $functionPerHourError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index-function.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
  
  