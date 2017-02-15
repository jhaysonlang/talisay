<?php
    include '../dbconnect.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index-function.php");
    }
     
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
        
        if ($valid) {
            $check = mysql_query("SELECT * FROM functionroom WHERE id != '$id'");
            while($checkrow = mysql_fetch_array($check))
            {
               if($checkrow['frname'] == $functionName)
               {
                   $error = true;
                   break;
               }
            }

            if($error == true)
            {
                echo '<script>alert("Room Already Exist!"); location.href="update-function.php?id='.$id.'";</script>';
            }
            else
            {
               mysql_query("UPDATE functionroom SET frname = '$functionName', frRate = '$functionRate' , perHour = '$functionPerHour' WHERE id = '$id'");
               mysql_close();
               header("Location: index-function.php"); 
            }
               
            
            
        }
    } else {
        $qry = mysql_query("SELECT * FROM functionroom where id = $id");
        $row = mysql_fetch_array($qry);
        $functionName = $row['frname'];
        $functionRate = $row['frRate'];
        $functionPerHour = $row['perHour'];
        mysql_close();
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
                        <h3>Update Room</h3>
                    </div>
             
                    <form class="form-horizontal" action="update-function.php?id=<?php echo $id?>" method="post">
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
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index-function.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
        
        