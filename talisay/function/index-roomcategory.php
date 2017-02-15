<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
  <script src="js/jquery.min.js"></script>
  <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <link   href="css/jquery.dataTables.min.css" rel="stylesheet">
 
  <br>
    <div class="container">
    
            <div class="row">
            <h3>Room Category</h3>
            </div>
            <div class="row">
          <p>
            <?php 
            session_start();
            if($_SESSION['usertype'] == 'Admin')
            {
              echo '<a href="create-roomcategory.php" class="btn btn-success">Create</a>';
            }
            ?>
                    
                </p>
              <div class="table-responsive">
                <table id = "myTable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Room Type</th>
              <th>Room Description</th>
                          <th>Room Rate</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include '../dbconnect.php';
                       $qry = mysql_query("SELECT * FROM roomcategory ORDER BY id ASC");
                       while($row = mysql_fetch_array($qry)) {
                                echo '<tr>';
                  echo '<td>'. $row['roomType'] . '</td>';
                  echo '<td>'. $row['bedConfiguration'] . '</td>';
                  echo '<td>'. '&#x20b1; ' . number_format($row['roomRate'],2) . '</td>';
                  echo '<td>';
                  echo '<a class="btn" href="index-room.php?id='.$row['id'].'">Read</a>';
                  if($_SESSION['usertype'] == 'Admin')
                  {
                  echo '&nbsp;';
                  echo '<a class="btn btn-success" href="update-roomcategory.php?id='.$row['id'].'">Update</a>';
                  echo '&nbsp;';
                  echo '<a class="btn btn-danger" href="delete-roomcategory.php?id='.$row['id'].'">Delete</a>';
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