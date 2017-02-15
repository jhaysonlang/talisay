<?php
    include '../dbconnect.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index-cottagecategory.php");
    } else {
        $qry = mysql_query("SELECT * FROM cottagecategory where id = $id");
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
                        <label class="control-label">Room Type</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['roomType'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Bed Configuration</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['bedConfiguration'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Room Rate</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['roomRate'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="javascript:history.back(1)">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
