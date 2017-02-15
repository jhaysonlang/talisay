<?php
    include '../dbconnect.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
        $num = $_REQUEST['num'];
    }
     
    if ( null==$id ) {
        header("Location: index-cottage.php");
    } else {
        $qry = mysql_query("SELECT * FROM cottagecategory where id = '$id'");
        $row = mysql_fetch_array($qry);
        $qry1 = mysql_query("SELECT * FROM cottages where cottageID = '$num'");
        $row1 = mysql_fetch_array($qry1);
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
                        <h3>Cottage Details</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Cottage Type</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['cottageType'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Cottage Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row1['cottageID'];?>
                            </label>
                        </div>
                      </div>
                     
                  
                        <div class="form-actions">
                          <a class="btn" href="index-cottage.php?id=<?php echo $id;?>">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
