<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<?php
    include '../dbconnect.php';
 
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
        $qry = mysql_query("SELECT * FROM customers WHERE email = '$id'");
        $row = mysql_fetch_array($qry);
    }
     
    if ( null==$id ) {
        header("Location: index-myaccount.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $firstnameError = null;
        $lastnameError = null;
        $mobileError = null;
               
        // keep track post values
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        // validate input
        $valid = true;
        if (empty($firstname)) {
            $firstnameError = 'Please enter First Name';
            $valid = false;
        } 

        if (empty($lastname)) {
            $lastnameError = 'Please enter Last Name';
            $valid = false;
        } 

        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        } else if (!(ctype_digit($mobile))){
            $mobileError = 'Please enter numbers';
            $valid = false;
        }
        
        if ($valid) {
            mysql_query("UPDATE customers SET name = '$firstname',lname='$lastname',mobile='$mobile' WHERE email = '$email'");
            mysql_close();
            echo '<script>location.href="index-myaccount.php"</script>';
        }
    } 
    else {
        $qry1 = mysql_query("SELECT * FROM customers where email = '$id'");
        $row1 = mysql_fetch_array($qry1);
        $email = $row['email'];
        $firstname = $row['name'];
        $lastname = $row['lname'];
        $mobile = $row['mobile'];
        mysql_close();
    }
?>


 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Edit Account</h3>
                    </div>
             
                    <form class="form-horizontal" action="edit-myaccount.php?id=<?php echo $id;?>" method="post">
                      <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="email" type="text"  value="<?php echo $email;?>" readonly>
                      </div>
                      </div>
                      <div class="control-group <?php echo !empty($firstnameError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input name="firstname" type="text"  placeholder="First Name" value="<?php echo !empty($firstname)?$firstname:'';?>">
                            <?php if (!empty($firstnameError)): ?>
                                <span class="help-inline"><?php echo $firstnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($lastnameError)?'error':'';?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input name="lastname" type="text"  placeholder="Last Name" value="<?php echo !empty($lastname)?$lastname:'';?>">
                            <?php if (!empty($lastnameError)): ?>
                                <span class="help-inline"><?php echo $lastnameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
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
        
    