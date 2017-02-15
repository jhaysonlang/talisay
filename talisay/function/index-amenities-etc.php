<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

 
  <br>
    <div class="container">
    
            <div class="row">
            </div>
            <div class="row">
          <p>         
                    <?php 
                    session_start();
                    if($_SESSION['usertype'] == 'Admin')
                    {
                    ?>
                    <a href="create-amenities.php" class="btn btn-success">Create</a>
                    <?php
                    }
                    ?>
                </p>
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Amenities Name</th>
                          <th>Rate</th>
                          <th>Quantity</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include '../dbconnect.php';
                       $qry = mysql_query("SELECT * FROM amenities ORDER BY id ASC");
                       while($row = mysql_fetch_array($qry)) {
                                echo '<tr>';
                  echo '<td>'. '&nbsp;&nbsp;'. $row['amenityName'] . '</td>';
                  echo '<td>'. '&nbsp;&nbsp; &#x20b1; ' . number_format($row['amenityRate'],2) . '</td>';
                  echo '<td>'. '&nbsp;&nbsp;per ' . $row['quantity'] . ' ' . $row['description'].'</td>';
                  echo '<td>';
                  echo '<a class="btn" href="read-amenities.php?id='.$row['id'].'">Read</a>';
                  if($_SESSION['usertype'] == 'Admin')
                  {
                  echo '&nbsp;';
                  echo '<a class="btn btn-success" href="update-amenities.php?id='.$row['id'].'">Update</a>';
                  echo '&nbsp;';
                  echo '<a class="btn btn-danger" href="delete-amenities.php?id='.$row['id'].'">Delete</a>';
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
	<br>
  </body>
</html>
        
    