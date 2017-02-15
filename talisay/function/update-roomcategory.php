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
    }
     
    if ( null==$id ) {
        header("Location: index-roomcategory.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $roomTypeError = null;
		$bedConfigurationError = null;
        $roomRateError = null;
        $roomCapacityError = null;
        $uploadError = null;
        // keep track post values
        $roomType = $_POST['roomType'];
		$image = $_FILES['uploadimg']['name'];
		$upload = strtolower(preg_replace('/ /','', ($roomType)));
		$bedConfiguration = $_POST['bedConfiguration'];
        $roomRate = $_POST['roomRate'];
        $roomCapacity = $_POST['roomCapacity'];
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
            $roomCapacityError = 'Please enter valid Room Rate';
            $valid = false;
        }

        if (empty($roomCapacity)) {
            $roomCapacityError = 'Please enter Room Capacity';
            $valid = false;
        } else if (!(ctype_digit($roomCapacity))){
            $roomCapacityError = 'Please enter valid Room Capacity';
            $valid = false;
        }
        if(!empty($_FILES["uploadimg"]["name"]))
        {
        if(pathinfo($oldName, PATHINFO_EXTENSION) != 'jpg' AND pathinfo($oldName, PATHINFO_EXTENSION) != 'jpeg' AND pathinfo($oldName, PATHINFO_EXTENSION) != 'JPG' AND pathinfo($oldName, PATHINFO_EXTENSION) != 'JPEG')
        {
            $uploadError = 'Only jpg/jpeg image is supported';
            $valid = false;
        }
        }  

        $error = false;
        if ($valid) {
            $check = mysql_query("SELECT * FROM roomcategory WHERE id != '$id'");
            while($checkrow = mysql_fetch_array($check))
            {
               if($checkrow['roomType'] == $roomType)
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
                text: 'Room category already exist!',   
                type: 'error',   
                confirmButtonText: 'Ok' },
                function()
                {   
                   location.href="update-roomcategory.php?id=<?php echo $id;?>";
                });
                </script>
                <?php
            }
            else
            {
              $qry = mysql_query("SELECT * FROM roomcategory WHERE id = '$id'");
              $row = mysql_fetch_array($qry);
              if($row['roomType'] == $roomType)
              {
                if(!empty($_FILES["uploadimg"]["name"]))
                {
                $path = '../talisay/images/rooms/'.strtolower(preg_replace('/ /', '', $row['roomType'])).'.jpg';
                unlink($path);
                $imgName = strtolower(preg_replace('/ /', '', $roomType)).'.jpg'; 
                $target = '../talisay/images/rooms/'.$imgName;
                move_uploaded_file($_FILES['uploadimg']['tmp_name'], $target); 
                }
                mysql_query("UPDATE roomcategory SET roomType = '$roomType', bedConfiguration = '$bedConfiguration', capacity = '$roomCapacity' , roomRate = '$roomRate' WHERE id = '$id'");
                mysql_close();
                echo '<script>location.href="index-roomcategory.php"</script>'; 
                }
                else
                {
                if(!empty($_FILES["uploadimg"]["name"]))
                {
                $path = '../talisay/images/rooms/'.strtolower(preg_replace('/ /', '', $row['roomType'])).'.jpg';
                unlink($path);
                $imgName = strtolower(preg_replace('/ /', '', $roomType)).'.jpg'; 
                $target = '../talisay/images/rooms/'.$imgName;
                move_uploaded_file($_FILES['uploadimg']['tmp_name'], $target); 
                mysql_query("UPDATE roomcategory SET upload = '$upload', roomType = '$roomType', bedConfiguration = '$bedConfiguration', capacity = '$roomCapacity' , roomRate = '$roomRate' WHERE id = '$id'");
                mysql_close();
                echo '<script>location.href="index-roomcategory.php"</script>'; 
                }
                else
                {
                rename('../talisay/images/rooms/'.strtolower(preg_replace('/ /', '', $row['roomType'])).'.jpg', '../talisay/images/rooms/'.strtolower(preg_replace('/ /', '', $roomType)).'.jpg');
                mysql_query("UPDATE roomcategory SET upload = '$upload', roomType = '$roomType', bedConfiguration = '$bedConfiguration', capacity = '$roomCapacity' , roomRate = '$roomRate' WHERE id = '$id'");
                mysql_close();
                echo '<script>location.href="index-roomcategory.php"</script>'; 
                }
                }
            }        
        }
    } else {
        $qry = mysql_query("SELECT * FROM roomcategory where id = $id");
        $row = mysql_fetch_array($qry);
        $roomType = $row['roomType'];
		$bedConfiguration = $row['bedConfiguration'];
        $roomRate = $row['roomRate'];
        $roomCapacity = $row['capacity'];
        mysql_close();
    }
?>


 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update Room Category</h3>
                    </div>
             
                    <form class="form-horizontal" action="update-roomcategory.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
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
                            <input name="roomCapacity" type="text"  placeholder="Room Capacity" maxlength="6" value="<?php echo !empty($roomCapacity)?$roomCapacity:'';?>">
                            <?php if (!empty($roomCapacityError)): ?>
                                <span class="help-inline"><?php echo $roomCapacityError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($roomRateError)?'error':'';?>">
                        <label class="control-label">Room Rate</label>
                        <div class="controls">
                            <input name="roomRate" type="text"  placeholder="Room Rate" maxlength="6" value="<?php echo !empty($roomRate)?$roomRate:'';?>">
                            <?php if (!empty($roomRateError)): ?>
                                <span class="help-inline"><?php echo $roomRateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($uploadError)?'error':'';?>">
                        <label class="control-label">Upload Image</label>
                        <div class="controls">
                            <input  type="file" name="uploadimg" placeholder="Upload Image" maxlength="6" value="<?php echo !empty($uploadimg)?$uploadimg:'';?>"/>
                            <?php if (!empty($uploadError)): ?>
                                <span class="help-inline"><?php echo $uploadError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index-roomcategory.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
        
		