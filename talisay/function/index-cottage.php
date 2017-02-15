<?php 
include '../dbconnect.php';
$qry = mysql_query("SELECT * FROM cottages WHERE id = '".$_GET['id']."'");
$qry1 = mysql_query("SELECT * FROM cottagecategory WHERE id = '".$_GET['id']."'");
$row1 = mysql_fetch_array($qry1);
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

 
  <br>
    <div class="container">
    
            <div class="row">
            <h3>Category: <?php echo $row1['cottageType']?></h3>
            <h3>Cottage Rate: &#x20b1; <?php echo number_format($row1['cottageRate'],2)?></h3>
            <img src = "images2/<?php echo strtolower(preg_replace('/ /','', $row1['cottageType']))?>.jpg" style = "width:300px;height:250px;float:right; margin-top:-100px;">
            </div>
            <div class="row">
          <p>       
                    <a href="index-cottagecategory.php" class="btn">Back</a>
                    <?php 
                    session_start();
                    if($_SESSION['usertype'] == 'Admin')
                    {
                      ?>
                      <a href="create-cottage.php?id=<?php echo $_GET['id']?>" class="btn btn-success">Create</a>
                      <?php
                    }
                    ?>
                    
                </p>
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Cottage</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       while($row = mysql_fetch_array($qry)) {
                                echo '<tr>';
                  echo '<td>'. $row['cottageID'] . '</td>';
                  echo '<td>';
                  echo '<a class="btn" href="read-cottage.php?num='.$row['cottageID'].'&id='.$_GET['id'].'">Read</a>';
                  if($_SESSION['usertype'] == 'Admin')
                  {
                  echo '&nbsp;';
                  echo '<a class="btn btn-success" href="update-cottage.php?num='.$row['cottageID'].'&id='.$_GET['id'].'">Update</a>';
                  echo '&nbsp;';
                  echo '<a class="btn btn-danger" href="delete-cottage.php?num='.$row['cottageID'].'&id='.$_GET['id'].'">Delete</a>';
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
        
    