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
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index-myaccount.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $oldpasswordError = null;
        $newpasswordError = null;
        $newpassword1Error = null;
               
        // keep track post values
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $newpassword1 = $_POST['newpassword1'];

        // validate input
        $valid = true;
        if (empty($oldpassword)) {
            $oldpasswordError = 'Please enter Old Password';
            $valid = false;
        } 

        if (empty($newpassword)) {
            $newpasswordError = 'Please enter New Password';
            $valid = false;
        } 

        if (empty($newpassword1)) {
            $newpassword1Error = 'Please enter Confirm Password';
            $valid = false;
        } 
        
        if ($valid) {
            $qry = mysql_query("SELECT * FROM customers WHERE email = '$id'");
            $row = mysql_fetch_array($qry);
            if($row['password'] == $oldpassword)
            {
                if($newpassword == $newpassword1)
                {
                    mysql_query("UPDATE customers SET password = '$newpassword' WHERE email = '$id'");
                    mysql_close();
                    echo '<script>location.href="index-myaccount.php";</script>';
                }
                else
                {
                    ?>
                    <script>
                    swal({   
                    title: 'Error!',   
                    text: 'New password does not match!',   
                    type: 'error',   
                    confirmButtonText: 'Ok' });
                    </script>
                    <?php
                }
            }
            else
            {
                    ?>
                    <script>
                    swal({   
                    title: 'Error!',   
                    text: 'Old password does not match!',   
                    type: 'error',   
                    confirmButtonText: 'Ok' });
                    </script>
                    <?php
            }
        }
    } 
    
?>


 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Change Password</h3>
                    </div>
             
                    <form class="form-horizontal" action="change-password.php?id=<?php echo $id;?>" method="post">
                      <div class="control-group <?php echo !empty($oldpasswordError)?'error':'';?>">
                        <label class="control-label">Old Password</label>
                        <div class="controls">
                            <input name="oldpassword" type="password"  placeholder="Old Password" value="<?php echo !empty($oldpassword)?$oldpassword:'';?>">
                            <?php if (!empty($oldpasswordError)): ?>
                                <span class="help-inline"><?php echo $oldpasswordError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($newpasswordError)?'error':'';?>">
                        <label class="control-label">New Password</label>
                        <div class="controls">
                            <input name="newpassword" type="password"  placeholder="New Password" value="<?php echo !empty($newpassword)?$newpassword:'';?>">
                            <?php if (!empty($newpasswordError)): ?>
                                <span class="help-inline"><?php echo $newpasswordError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($newpassword1Error)?'error':'';?>">
                        <label class="control-label">Confirm Password</label>
                        <div class="controls">
                            <input name="newpassword1" type="password"  placeholder="Confirm Password" value="<?php echo !empty($newpassword1)?$newpassword1:'';?>">
                            <?php if (!empty($newpassword1Error)): ?>
                                <span class="help-inline"><?php echo $newpassword1Error;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index-myaccount.php?id=<?php echo $id?>">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
        
    