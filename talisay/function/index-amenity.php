<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/sweetalert2.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
    <link   href="css/jquery.dataTables.min.css" rel="stylesheet">

 
  <br>
    <div class="container">
    
            <div class="row">
            </div>
            <div class="row">
          <p>
                   
                   
                </p>
              <div class="table-responsive">
                <table id = "myTable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Transaction #</th>
                          <th>Guest Name</th>
                          <th>Reservation Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      include '../dbconnect.php';
                      $qry = mysql_query("SELECT * FROM reservation WHERE status = 'Check In'");
                      while($row = mysql_fetch_array($qry))
                      {
                       ?>
                       <td><?php echo $row['transactionNo']?></td>
                       <td><?php echo $row['guestName']?></td>
                       <?php 
                       echo '<td>'. 
                       'Reservation Date: ' . date("M j Y | g:i A",strtotime($row['reservationDate'])) . '<br>' .
                      'Check In Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . date("M j Y",strtotime($row['checkin'])) . '<br>' .
                      'Check Out Date:&nbsp;&nbsp;&nbsp;' . date("M j Y",strtotime($row['checkout'])) . '<br>' .
                        '     </td>';
                      ?>
                      <td><a class = "btn btn-success" href ="../function/add-amenity.php?id=<?php echo $row['transactionNo']?>">Add Charges</a></td>
                    </tr>
                      <?php
                      }
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
    