<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
<?php
    include '../dbconnect.php';
    $id = $_GET['id'];
    $qry = mysql_query("SELECT * FROM users WHERE user_id = '$id'");
    $row = mysql_fetch_array($qry);  
?>
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>User Details</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['name'] . ' ' . $row['lname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Username</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['username'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">User Type</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['usertype'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="index.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
