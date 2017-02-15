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
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
        $num = $_REQUEST['num'];
        $qry = mysql_query("SELECT * FROM cottages WHERE cottageID = '$num'");
        $row = mysql_fetch_array($qry);
        $cottageID = $num;
    }
     
    if ( null==$id ) {
        header("Location: index-cottage.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $cottageIDError = null;

               
        // keep track post values
        $cottageID = $_POST['cottageID'];
        $id = $_GET['id'];
         
        // validate input
        $valid = true;
        $valid = true;
        if (empty($cottageID)) {
            $cottageIDError = 'Please enter Cottage Name';
            $valid = false;
        } 
        
        if ($valid) {
            $error = false;
            $check = mysql_query("SELECT * FROM cottages WHERE cottageID != '$num'");
            while($checkrow = mysql_fetch_array($check))
            {
               if($checkrow['cottageID'] == $cottageID)
               {
                   $error = true;
                   break;
               }
            }

            if($error == true)
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
                   location.href="update-cottage.php?num=<?php echo $num;?>&id=<?php echo $id;?>";
                });
                </script>
                <?php
            }
            else
            {
                $cottageID = preg_replace('/ /', '', $cottageID);
                mysql_query("UPDATE cottages SET cottageID = '$cottageID' WHERE id = '$id' AND cottageID = '$num'");
                mysql_close();
                echo '<script>location.href="index-cottage.php?id='.$id.'";</script>'; 
            }
        }
    } else {
        $qry = mysql_query("SELECT * FROM cottagecategory where id = $id");
        $row = mysql_fetch_array($qry);
        $cottageTye = $row['cottageType'];
        mysql_close();
    }
?>


 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update Cottage</h3>
                    </div>
             
                    <form class="form-horizontal" action="update-cottage.php?num=<?php echo $num;?>&id=<?php echo $id;?>" method="post">
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
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index-cottage.php?id=<?php echo $id?>">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
        
		