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
        $cottageIDError = null;
        
         
        // keep track post values
        $cottageID = $_POST['cottageID'];
        $id = $_GET['id'];
        // validate input
        $valid = true;
        if (empty($cottageID)) {
            $cottageIDError = 'Please enter Cottage Name';
            $valid = false;
        } 
        
        // insert data
        if ($valid) {
            $cottageID = preg_replace('/ /', '', $cottageID);
            $qry = mysql_query("SELECT * FROM cottages WHERE cottageID = '$cottageID'");
            if(mysql_num_rows($qry) > 0)
            {
                ?>
                <script>
                swal({   
                title: 'Error!',   
                text: 'Cottage already exist!',   
                type: 'error',   
                confirmButtonText: 'Ok' },
                function()
                {   
                   location.href="create-cottage.php?id=<?php echo $_GET['id']?>";
                });
                </script>
                <?php
            }
            else
            {
            mysql_query("INSERT INTO cottages(cottageID,id) values('$cottageID','$id')");
            mysql_close();
            echo '<script>location.href="index-cottage.php?id='.$id.'";</script>';
            }
        }
    }
?>


 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Add Cottage</h3>
                    </div>
             
                    <form class="form-horizontal" action="" method="POST">
                      <div class="control-group <?php echo !empty($cottageIDError)?'error':'';?>">
                        <label class="control-label">Cottage Name</label>
                        <div class="controls">
                            <input name="cottageID" type="text"  placeholder="Cottage Name" value="<?php echo !empty($cottageID)?$cottageID:'';?>">
                            <?php if (!empty($cottageIDError)): ?>
                                <span class="help-inline"><?php echo $cottageIDError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index-cottage.php?id=<?php echo $_GET['id']?>">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
  
  