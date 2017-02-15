<?php
    include '../dbconnect.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index-amenities.php");
    } else {
        $qry = mysql_query("SELECT * FROM amenities where id = '$id'");
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
                        <h3>Amenity Details</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Amenity Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['amenityName'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Amenity Rate</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo '&#x20b1; ' .  number_format($row['amenityRate'],2);?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Quantity</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['quantity'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo 'per ' . $row['description'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="index-amenities-etc.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
