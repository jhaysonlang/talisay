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
        $functionNameError = null;
        $functionRateError = null;
        $functionPerHourError = null;
        $functionDescriptionError = null;
        // keep track post values
        $functionName = $_POST['functionName'];
        $functionRate = $_POST['functionRate'];
        $functionPerHour = $_POST['functionPerHour'];
        $functionDescription = $_POST['functionDescription'];
        // validate input
        $valid = true;
        if (empty($functionName)) {
            $functionNameError = 'Please enter Amenity Name';
            $valid = false;
        } 
        
        if (empty($functionDescription)) {
            $functionDescriptionError = 'Please enter Description';
            $valid = false;
        } 

        if (empty($functionRate)) {
            $functionRateError = 'Please enter Amenity Rate';
            $valid = false;
        } else if (!(ctype_digit($functionRate))){
            $functionRateError = 'Please enter valid Amenity Rate';
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
            $check = mysql_query("SELECT * FROM amenities WHERE amenityName = '$functionName'");
            if(mysql_num_rows($check) > 0)
            {
                ?>
                <script>
                swal({   
                title: 'Error!',   
                text: 'Amenity already exist!',   
                type: 'error',   
                confirmButtonText: 'Ok' },
                function()
                {   
                   location.href="create-amenities.php";
                });
                </script>
                <?php
            }
            else
            {
            mysql_query("INSERT INTO amenities (amenityName,amenityRate,quantity,description) values('$functionName', '$functionRate', '$functionPerHour','$functionDescription')");
            mysql_close();
            echo '<script>location.href="index-amenities-etc.php";</script>';
            }
        }
    }
?>


 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Add Amenity</h3>
                    </div>
             
                    <form class="form-horizontal" action="" method="POST">
                      <div class="control-group <?php echo !empty($functionNameError)?'error':'';?>">
                        <label class="control-label">Amenity Name</label>
                        <div class="controls">
                            <input name="functionName" type="text"  placeholder="Amenity Name" value="<?php echo !empty($functionName)?$functionName:'';?>">
                            <?php if (!empty($functionNameError)): ?>
                                <span class="help-inline"><?php echo $functionNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($functionRateError)?'error':'';?>">
                        <label class="control-label">Amenity Rate</label>
                        <div class="controls">
                            <input name="functionRate" type="text"  placeholder="Amenity Rate" value="<?php echo !empty($functionRate)?$functionRate:'';?>">
                            <?php if (!empty($functionRateError)): ?>
                                <span class="help-inline"><?php echo $functionRateError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($functionPerHourError)?'error':'';?>">
                        <label class="control-label">Quantity</label>
                        <div class="controls">
                            <input name="functionPerHour" type="text"  placeholder="Quantity" value="<?php echo !empty($functionPerHour)?$functionPerHour:'';?>">
                            <?php if (!empty($functionPerHourError)): ?>
                                <span class="help-inline"><?php echo $functionPerHourError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($functionDescriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="functionDescription" type="text"  placeholder="Description" value="<?php echo !empty($functionDescription)?$functionDescription:'';?>">
                            <?php if (!empty($functionDescriptionError)): ?>
                                <span class="help-inline"><?php echo $functionDescriptionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index-amenities-etc.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
  
  