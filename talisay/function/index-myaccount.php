<?php
    include '../dbconnect.php';
    session_start();
    
    $qry = mysql_query("SELECT * FROM customers WHERE email = '".$_SESSION['username']."'");
    $row = mysql_fetch_array($qry);
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
                        <h3>Guest Details</h3>
                    </div>
                     
					 <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['email'];?>
                            </label>
                        </div>
                      </div>
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['lname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Contact Number</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['mobile'];?>
                            </label>
                        </div>
                      </div>
                     
                  
                        <div class="form-actions">
                          <a class="btn btn-primary" href="../function/edit-myaccount.php?id=<?php echo $row['email'];?>">Edit</a>
						  &nbsp;
						  <a class="btn btn-primary" href="../function/change-password.php?id=<?php echo $row['email'];?>">Change Password</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
