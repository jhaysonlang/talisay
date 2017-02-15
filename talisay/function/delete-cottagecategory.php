<?php
    include '../dbconnect.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $qry = mysql_query("SELECT * FROM cottagecategory WHERE id = '$id'");
        $row = mysql_fetch_array($qry);
        mysql_query("DELETE FROM cottagecategory  WHERE id = '$id'");
        $path = 'images2/'.strtolower(preg_replace('/ /', '', $row['cottageType'])).'.jpg';
        unlink($path);
        mysql_close();
        header("Location: index-cottagecategory.php");
         
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
                        <h3>Delete a Cottage Category</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete-cottagecategory.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="javascript:history.back(1)">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>