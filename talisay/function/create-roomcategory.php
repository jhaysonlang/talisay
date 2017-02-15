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
        $roomTypeError = null;
		$bedConfigurationError = null;
        $roomRateError = null;
        $roomCapacityError = null;
        $uploadError = null;
		
		
        // keep track post values
        $roomType = $_POST['roomType'];
		$upload = strtolower(preg_replace('/ /','', ($roomType)));
		$bedConfiguration = $_POST['bedConfiguration'];
        $roomRate = $_POST['roomRate'];
        $roomCapacity = $_POST['roomCapacity'];
        $uploadimg = $_FILES['uploadimg'];
        $oldName = $_FILES['uploadimg']['name'];
	
	
		
        // validate input
        $valid = true;
        if (empty($roomType)) {
            $roomTypeError = 'Please enter Room Type';
            $valid = false;
        } 
		
		if (empty($bedConfiguration)) {
            $bedConfigurationError = 'Please enter Bed Configuration';
            $valid = false;
        } 
         
        if (empty($roomRate)) {
            $roomRateError = 'Please enter Room Rate';
            $valid = false;
        } else if (!(ctype_digit($roomRate))){
			$roomRateError = 'Please enter valid Room Rate';
            $valid = false;
		}

        if (empty($roomCapacity)) {
            $roomCapacityError = 'Please enter Room Capacity';
            $valid = false;
        } else if (!(ctype_digit($roomCapacity))){
            $roomCapacityError = 'Please enter valid Room Capacity';
            $valid = false;
        }
        if (empty($_FILES["uploadimg"]["name"])) {
            $uploadError = 'Please upload image';
            $valid = false;
        } 
        else if(pathinfo($oldName, PATHINFO_EXTENSION) != 'jpg' AND pathinfo($oldName, PATHINFO_EXTENSION) != 'jpeg' AND pathinfo($oldName, PATHINFO_EXTENSION) != 'JPG' AND pathinfo($oldName, PATHINFO_EXTENSION) != 'JPEG')
        {
            $uploadError = 'Only jpg/jpeg image is supported';
            $valid = false;
        }  

        
        // insert data
        if ($valid) {
            $check = mysql_query("SELECT * FROM roomcategory WHERE roomType = '$roomType'");
            if(mysql_num_rows($check) > 0)
            {
                ?>
                <script>
                swal({   
                title: 'Error!',   
                text: 'Room category already exist!',   
                type: 'error',   
                confirmButtonText: 'Ok' },
                function()
                {   
                   location.href = "create-roomcategory.php";
                });
                </script>
                <?php
            }
            else
            {
            mysql_query("INSERT INTO roomcategory (roomType,bedConfiguration,capacity,roomRate,upload) values('$roomType', '$bedConfiguration', '$roomCapacity', '$roomRate', '$upload')");
            mysql_close();   
            $imgName = strtolower(preg_replace('/ /', '', $roomType)).'.jpg'; 
            $target = '../talisay/images/rooms/'.$imgName;
            move_uploaded_file($_FILES['uploadimg']['tmp_name'], $target);
            echo '<script>location.href="index-roomcategory.php"</script>';
            }
        }
    }
?>


 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Add Room Category</h3>
                    </div>
             
                    <form class="form-horizontal" action="create-roomcategory.php" method="POST" enctype="multipart/form-data">
                      <div class="control-group <?php echo !empty($roomTypeError)?'error':'';?>">
                        <label class="control-label">Room Type</label>
                        <div class="controls">
                            <input name="roomType" type="text"  placeholder="Room Type" value="<?php echo !empty($roomType)?$roomType:'';?>">
                            <?php if (!empty($roomTypeError)): ?>
                                <span class="help-inline"><?php echo $roomTypeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($bedConfigurationError)?'error':'';?>">
                        <label class="control-label">Bed Configuration</label>
                        <div class="controls">
                            <input name="bedConfiguration" type="text"  placeholder="Bed Configuration" value="<?php echo !empty($bedConfiguration)?$bedConfiguration:'';?>">
                            <?php if (!empty($bedConfigurationError)): ?>
                                <span class="help-inline"><?php echo $bedConfigurationError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($roomCapacityError)?'error':'';?>">
                        <label class="control-label">Room Capacity</label>
                        <div class="controls">
                            <input name="roomCapacity" type="text" placeholder="Room Capacity" maxlength="6" value="<?php echo !empty($roomCapacity)?$roomCapacity:'';?>">
                            <?php if (!empty($roomCapacityError)): ?>
                                <span class="help-inline"><?php echo $roomCapacityError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($roomRateError)?'error':'';?>">
                        <label class="control-label">Room Rate</label>
                        <div class="controls">
                            <input name="roomRate" type="text" placeholder="Room Rate" maxlength="6" value="<?php echo !empty($roomRate)?$roomRate:'';?>">
                            <?php if (!empty($roomRateError)): ?>
                                <span class="help-inline"><?php echo $roomRateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($uploadError)?'error':'';?>">
                        <label class="control-label">Upload Image</label>
                        <div class="controls">
                            <input  type="file" class ="upload" name="uploadimg"/>
                            <?php if (!empty($uploadError)): ?>
                                <span class="help-inline"><?php echo $uploadError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index-roomcategory.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>

