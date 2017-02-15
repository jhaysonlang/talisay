<?php
    include '../dbconnect.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index-grandball.php");
    } else {
        $qry = mysql_query("SELECT * FROM grandballroom where id = '$id'");
        $row = mysql_fetch_array($qry);
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
                        <h3>Room Details</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Room Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['gbrName'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Room Rate</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['gbrRate'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Per Hour</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['perHour'];?>
                            </label>
                        </div>
                      </div>
                  
                        <div class="form-actions">
                          <a class="btn" href="index-grandball.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
