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
        $firstNameError = null;
        $lastNameError = null;
        $usernameError = null;
        $passwordError = null;
        $usertypeError = null;
        // keep track post values
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usertype = $_POST['usertype'];
        // validate input
        $valid = true;
        if (empty($firstName)) {
            $firstNameError = 'Please enter First Name';
            $valid = false;
        } 
        
        if (empty($lastName)) {
            $lastNameError = 'Please enter Last Name';
            $valid = false;
        } 
         
        if (empty($username)) {
            $usernameError = 'Please enter Username';
            $valid = false;
        } 

        if (empty($password)) {
            $passwordError = 'Please enter Password';
            $valid = false;
        } 

        if (empty($usertype)) {
            $usertypeError = 'Please enter User Type';
            $valid = false;
        } 

         
        // insert data
        if ($valid) {
           $qry = mysql_query("SELECT * FROM users WHERE username = '$username'");
            if(mysql_num_rows($qry) == 0)
            {
                mysql_query("INSERT INTO users(name,lname,username,password,usertype) VALUES('$firstName','$lastName','$username','$password','$usertype')");
                echo '<script>location.href="index.php";</script>';
            }
            else
            {
                ?>
                <script>
                swal({   
                title: 'Error!',   
                text: 'Username already exist!',   
                type: 'error',   
                confirmButtonText: 'Ok' },
                function()
                {   
                   location.href="create.php";
                });
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
                        <h3>Add Administrative User</h3>
                    </div>
             
                    <form class="form-horizontal" action="" method="POST">
                      <div class="control-group <?php echo !empty($firstNameError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input name="firstName" type="text"  placeholder="First Name" value="<?php echo !empty($firstName)?$firstName:'';?>">
                            <?php if (!empty($firstNameError)): ?>
                                <span class="help-inline"><?php echo $firstNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($lastNameError)?'error':'';?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input name="lastName" type="text"  placeholder="Last Name" value="<?php echo !empty($lastName)?$lastName:'';?>">
                            <?php if (!empty($lastNameError)): ?>
                                <span class="help-inline"><?php echo $lastNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
                        <label class="control-label">Username</label>
                        <div class="controls">
                            <input name="username" type="text"  placeholder="Username" value="<?php echo !empty($username)?$username:'';?>">
                            <?php if (!empty($usernameError)): ?>
                                <span class="help-inline"><?php echo $usernameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input name="password" type="password"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($usertypeError)?'error':'';?>">
                        <label class="control-label">User Type</label>
                        <div class="controls">
                            <select name = "usertype">
                                <option hidden selected value = "<?php echo !empty($usertype)?$usertype:'';?>"><?php echo !empty($usertype)?$usertype:'';?></option>
                                <option value = "Admin">Admin</option>
                                <option value = "Receptionist">Receptionist</option>
                                <option value = "Marketing">Marketing</option>
                            </select>
                            <?php if (!empty($usertypeError)): ?>
                                <span class="help-inline"><?php echo $usertypeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
  
  