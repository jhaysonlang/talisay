<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

 
  <br>
    <div class="container">
    
            <div class="row">
            </div>
            <div class="row">
              <form action = "additional-billing.php" method = "GET">
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <input type="hidden" name = "id" value = "<?php echo $_GET['id']?>">
                      <thead>
                        <tr>
                          <th>Amenities Name</th>
                          <th>Rate</th>
                          <th>Details</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include '../dbconnect.php';
                       $qry = mysql_query("SELECT * FROM amenities ORDER BY id ASC");
                       while($row = mysql_fetch_array($qry)) {
                       echo '<tr>';
                       echo '<td>'. $row['amenityName'] . '</td>';
                      echo '<td>'. $row['amenityRate'] . '</td>';
                       echo '<td> per '. $row['quantity'] . ' ' .$row['description'].'</td>';
                        echo '<td>';
                         echo 'Add:
                        <input type="hidden" name = "amenity[]" value = "'.$row['amenityName'].'">
                         <input type="number" name = "number[]" min="1" max="5">';
                        echo '</td>';
                        echo '</tr>';
                       }
                      mysql_close();
				              ?>
                      <tr>
                        <td>Food and Beverage</td>
                        <td colspan = "2"></td>
                        <td>Add: <input type="text" name = "food" ></td>
                      </tr>
                      </tbody>
                </table>
				<br>
				<center>
				<input type="submit" class="btn btn-success" value = "Proceed">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class = "btn btn-primary" href = "index-amenity.php">Back</a>
				</center>
      </form>
      </div>
        </div>
    </div> <!-- /container -->

  </body>
</html>
        
    