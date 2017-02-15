<?php 
include '../dbconnect.php';
$qry = mysql_query("SELECT * FROM rooms WHERE id = '".$_GET['id']."'");
$qry1 = mysql_query("SELECT * FROM roomcategory WHERE id = '".$_GET['id']."'");
$row1 = mysql_fetch_array($qry1);
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <link   href="css/jquery.dataTables.min.css" rel="stylesheet">

 
  <br>
    <div class="container">
    
            <div class="row">
            <h3>Category: <?php echo $row1['roomType']?></h3>
            <h3>Bed Configuration: <?php echo $row1['bedConfiguration']?></h3>
            <h3>Capacity: <?php echo $row1['capacity']?></h3>
            <h3>Room Rate: &#x20b1; <?php echo number_format($row1['roomRate'],2);?></h3>
            <img src = "../talisay/images/rooms/<?php echo strtolower(preg_replace('/ /','', $row1['roomType']))?>.jpg" style = "width:300px;height:250px;float:right; margin-top:-200px;">
            </div>
            <div class="row">
          <p>       
                    <a href="index-roomcategory.php" class="btn">Back</a>
                    <?php 
                    session_start();
                    if($_SESSION['usertype'] == 'Admin')
                    {
                      ?>
                      <a href="create-room.php?id=<?php echo $_GET['id']?>" class="btn btn-success">Create</a>
                      <?php
                    }
                    ?>
                    
                </p>
              <div class="table-responsive">
                <table id = "myTable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Room</th>
                          <th>View</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       while($row = mysql_fetch_array($qry)) {
                                echo '<tr>';
                  echo '<td>'. $row['roomNum'] . '</td>';
                  echo '<td>'. $row['view'] . '</td>';
                  echo '<td>';
                  echo '<a class="btn" href="read-room.php?num='.$row['roomNum'].'&id='.$_GET['id'].'">Read</a>';
                  if($_SESSION['usertype'] == 'Admin')
                  {
                  echo '&nbsp;';
                  echo '<a class="btn btn-success" href="update-room.php?num='.$row['roomNum'].'&id='.$_GET['id'].'">Update</a>';
                  echo '&nbsp;';
                  echo '<a class="btn btn-danger" href="delete-room.php?num='.$row['roomNum'].'&id='.$_GET['id'].'">Delete</a>';
                  }
                  echo '</td>';
                  echo '</tr>';
                       }
                       mysql_close();
                      ?>
                      </tbody>
                </table>
      </div>
        </div>
    </div> <!-- /container -->
  </body>
</html>
   <script>  
    $(document).ready(function(){
    $('#myTable').DataTable();
});
</script>     
    