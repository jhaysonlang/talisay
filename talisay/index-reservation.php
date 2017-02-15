<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/sweetalert2.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.css">
    <link   href="css/jquery.dataTables.min.css" rel="stylesheet">
<style>
.sweet-alert
{
  top:300px !important;
}
</style>
 
  <br>
    <div class="container">
    
            <div class="row">
            </div>
            <div class="row">
          <p>
                    <a href="reservation-1.php" class="btn btn-success">Add Reservation</a>
                    <div style = "margin-top:-40px;float:right">
                    Filter: <select name = "status" class = "status">
                    <option hidden selected><?php echo (!isset($_GET['status'])?'All':$_GET['status'])?></option>
                    <option value = "All">All</option>
                    <option value = "Pending">Pending</option>
                    <option value = "Reserved">Reserved</option>
                    <option value = "Check In">Check In</option>
                    <option value = "Check Out">Check Out</option>
                    <option value = "Cancelled">Cancelled</option>
                    <option value = "No-show">No-show</option>
                    </select>
                    </div>
                </p>
              <div class="table-responsive">
                <table id = "myTable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Transaction No</th>
                          <th>Guest Name</th>
                          <th>Reservation Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include '../dbconnect.php';
                       session_start();
                       if(isset($_GET['status']))
                          {
                            $status = $_GET['status'];
                            if($status == 'All')
                            {
                              if($_SESSION['usertype'] == 'guest')
                               {
                                  $qry = mysql_query("SELECT * FROM reservation WHERE email = '".$_SESSION['username']."' ORDER BY reservationDate DESC");
                               }
                               else
                               {
                                $qry = mysql_query("SELECT * FROM reservation ORDER BY reservationDate DESC");
                               }
                            }
                            else
                            {
                              if($_SESSION['usertype'] == 'guest')
                               {
                                  $qry = mysql_query("SELECT * FROM reservation WHERE email = '".$_SESSION['username']."' AND status ='$status' ORDER BY reservationDate DESC");
                               }
                               else
                               {
                              $qry = mysql_query("SELECT * FROM reservation WHERE status = '$status' ORDER BY reservationDate DESC");
                              }
                            }
                            
                          }
                          else
                          {
                            if($_SESSION['usertype'] == 'guest')
                             {
                                $qry = mysql_query("SELECT * FROM reservation WHERE email = '".$_SESSION['username']."' ORDER BY reservationDate DESC");
                             }
                             else
                             {
                            $qry = mysql_query("SELECT * FROM reservation ORDER BY reservationDate DESC");
                            }
                          }
                       while($row = mysql_fetch_array($qry)) {
                                echo '<tr>';
                  echo '<td>'. $row['transactionNo'] . '</td>';
                  echo '<td>'. $row['guestName'] . '<br>' . $row['email'] . '</td>';
                  echo '<td>'. 
                  'Reservation Date: ' . date("F j Y | g:i A",strtotime($row['reservationDate'])) . '<br>' .
                  'Check In Date: ' . date("F j Y",strtotime($row['checkin'])) . '<br>' .
                  'Check Out Date: ' . date("F j Y",strtotime($row['checkout'])) . '<br>' .
                  '</td>';
                  echo '<td>'. $row['status'].'</td>';
                  echo '<td>';
                  echo '<a href="read-reservation.php?id='.$row['transactionNo'].'"><img src = "glyph/read.png" width = "20px" height = "20px"  title = "Read"></a>';
                  if($row['status'] == 'Pending')
                  {
                  echo '&nbsp;';
                  echo '<a href="modifyreservation1.php?id='.$row['transactionNo'].'"><img width = "20px" height = "20px" src = "glyph/modify.png"  title = "Modify"></a>';
                  }
                 
                  if($row['status'] == 'Pending' AND ($_SESSION['usertype'] == 'Admin' OR $_SESSION['usertype'] == 'Receptionist' OR $_SESSION['usertype'] == 'Marketing'))
                  {
                  echo '&nbsp;';
                  echo '<a href="verify.php?id='.$row['transactionNo'].'"><img src = "glyph/verify.png" width = "20px" height = "20px" title = "Verify"></a>';
                  }
                  if($row['status'] == 'Reserved' AND ($_SESSION['usertype'] == 'Admin' OR $_SESSION['usertype'] == 'Receptionist' OR $_SESSION['usertype'] == 'Marketing'))
                  {
                     echo '&nbsp;';
                      echo '<a href="checkin_module.php?id='.$row['transactionNo'].'"><img src = "glyph/checkin.png" width = "20px" height = "20px"  title = "Check In"></a>';
                  }
                  if($row['status'] == 'Check In' AND ($_SESSION['usertype'] == 'Admin' OR $_SESSION['usertype'] == 'Receptionist' OR $_SESSION['usertype'] == 'Marketing'))
                  {
                     echo '&nbsp;';
                      echo '<a href="check-out.php?id='.$row['transactionNo'].'"><img src = "glyph/checkout.png" width = "20px" height = "20px"  title = "Check Out"></a>';
                  }
                  if($row['status'] == 'Pending' OR $row['status'] == 'Reserved')
                  {
                  echo '&nbsp;';
                  echo '<a class="cancel" href="cancel-reservation.php?id='.$row['transactionNo'].'"><img src = "glyph/delete.png" width = "20px" height = "20px"  title = "Cancel"></a>';
                  }
				   if($row['status'] == 'Check Out' AND ($_SESSION['usertype'] == 'Admin' OR $_SESSION['usertype'] == 'Receptionist' OR $_SESSION['usertype'] == 'Marketing'))
                  {
                     echo '&nbsp;';
                      echo '<a href="../report/SOA.php?id='.$row['transactionNo'].'"><img src = "glyph/print.png" width = "35px" height = "20px"  title = "Print"></a>';
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

$('.status').on('change',function(){
location.href = "index-reservation.php?status=" + $('.status').val();
});


$('body').delegate('.cancel','click', function(e){
e.preventDefault();
    swal({   
        title: 'Are you sure?',   
        text: 'You want to cancel reservation?',   
        type: 'warning',   
        showCancelButton: true, 
        confirmButtonColor: '#3085d6',   
        cancelButtonColor: '#d33',   
        confirmButtonText: 'Yes',   
        closeOnConfirm: false }, function() {  
        swal({   
        title: 'Verified!',   
        text: '',   
        type: 'success',   
        confirmButtonText: 'Ok' },
        function()
        {   
        location.href = $('.cancel').attr('href');
        });        
    });
  });
});
</script>         
    