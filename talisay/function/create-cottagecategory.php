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
        $cottageTypeError = null;
		$RateError = null;
        $uploadError = null;
        // keep track post values
        $cottageType = $_POST['cottageType'];
		$Rate = $_POST['Rate'];
        $uploadimg = $_FILES['uploadimg'];
        $oldName = $_FILES['uploadimg']['name'];
        // validate input
        $valid = true;
        if (empty($cottageType)) {
            $cottageTypeError = 'Please enter Cottage Type';
            $valid = false;
        } 
		
		if (empty($Rate)) {
            $RateError = 'Please enter Rate';
            $valid = false;
        } else if (!(ctype_digit($Rate))){
            $RateError = 'Please enter valid Rate';
            $valid = false;
        }

        if(empty($_FILES["uploadimg"]["name"])) 
        {
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
            $check = mysql_query("SELECT * FROM cottagecategory WHERE cottageType = '$cottageType'");
            if(mysql_num_rows($check) > 0)
            {
                ?>
                <script>
                swal({   
                title: 'Error!',   
                text: 'Cottage category already exist!',   
                type: 'error',   
                confirmButtonText: 'Ok' },
                function()
                {   
                   location.href="create-cottagecategory.php";
                });
                </script>
                <?php
            }
            else
            {
            mysql_query("INSERT INTO cottagecategory (cottageType,cottageRate) values('$cottageType', '$Rate')");
            mysql_close();
            $imgName = strtolower(preg_replace('/ /', '', $cottageType)).'.jpg'; 
            $target = 'images2/'.$imgName;
            move_uploaded_file($_FILES['uploadimg']['tmp_name'], $target);
            echo '<script>location.href="index-cottagecategory.php";</script>';
            }
        }
    }
?>


 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Add Cottage Category</h3>
                    </div>
             
                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                      <div class="control-group <?php echo !empty($cottageTypeError)?'error':'';?>">
                        <label class="control-label">Cottage Type</label>
                        <div class="controls">
                            <input name="cottageType" type="text"  placeholder="Cottage Type" value="<?php echo !empty($cottageType)?$cottageType:'';?>">
                            <?php if (!empty($cottageTypeError)): ?>
                                <span class="help-inline"><?php echo $cottageTypeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($RateError)?'error':'';?>">
                        <label class="control-label">Cottage Rate</label>
                        <div class="controls">
                            <input name="Rate" type="text"  placeholder="Cottage Rate" value="<?php echo !empty($Rate)?$Rate:'';?>">
                            <?php if (!empty($RateError)): ?>
                                <span class="help-inline"><?php echo $RateError;?></span>
                            <?php endif; ?>
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
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index-cottagecategory.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
  
  