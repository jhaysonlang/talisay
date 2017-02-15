<?php
    include '../dbconnect.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
        $num = $_REQUEST['num'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
        $num = $_POST['num'];
        //delete data
        mysql_query("DELETE FROM rooms WHERE id = '$id' AND roomNum = '$num'");
        mysql_close();
        header("Location: index-room.php?id=".$id);
         
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
                        <h3>Delete a Room</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete-room.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <input type="hidden" name="num" value="<?php echo $num;?>"/>
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