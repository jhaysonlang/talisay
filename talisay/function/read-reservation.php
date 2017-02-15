<?php
    include '../dbconnect.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index-function.php");
    } else {
        $qry = mysql_query("SELECT * FROM reservation where transactionNo = '$id'");
        $row = mysql_fetch_array($qry);
        $qry1 = mysql_query("SELECT * FROM billing where transactionNo = '$id'");
        mysql_close();
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
                        <h3>Reservation Details</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Transaction Number</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['transactionNo'];?>
                            </label>
                        </div>
                      </div>
					  
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Guest Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['guestName'];?>
                            </label>
                        </div>
                      </div>
                       <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">E Mail</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['email'];?>
                            </label>
                        </div>
                      </div>
                       <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Contact Number</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['mobileNumber'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Reservation Date</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo date("F j Y | g:i A",strtotime($row['reservationDate']));?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Check In</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo date("F j Y",strtotime($row['checkin']));?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Check Out</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo date("F j Y",strtotime($row['checkout']));?>
                            </label>
                        </div>
                      </div>
					  
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Rooms</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php 
                                $string = "";
                                $count = explode(',',$row['numberofRooms']);
                                $rooms = explode(',', $row['roomType']);
                                $ctr = 0;
                                foreach ($rooms as $rooms) {
                                  $string = $string . $rooms . '(' . $count[$ctr] . ' rooms) ,';
                                  $ctr++;
                                }
                                echo substr($string,0,strlen($string)-1);
                                ?>
                            </label>
                        </div>
                      </div>
					
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Payment Arrangement</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['paymentType'];?>
                            </label>
                        </div>
                      </div>
                      <?php 
                      if($row['modeofpayment'] == ' ')
                      {
                      ?>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Mode of Payment</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['modeofpayment'];?>
                            </label>
                        </div>
                      </div>
                      <?php 
                      }
                      ?>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Reservation Process</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['process'];?>
                            </label>
                        </div>
                      </div>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Total Amount</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo '&#x20b1; ' . number_format($row['rate'],2);?>
                            </label>
                        </div>
                      </div>
                      <?php 
                      if(mysql_num_rows($qry1) != 0)
                      {
                        $row1 = mysql_fetch_array($qry1);
                        ?>
                        <div class="form-horizontal" >
                        <div class="control-group">
                        <label class="control-label">Deposit</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo '&#x20b1; ' . number_format($row1['paid'],2);?>
                            </label>
                        </div>
                        </div>
                        <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Balance</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo '&#x20b1; ' . number_format($row1['balance'],2);?>
                            </label>
                        </div>
                      </div>
                      <?php
                      if($row['status'] == 'Cancelled')
                      {
                        ?>
                        <div class="control-group">
                        <label class="control-label">Return</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo '&#x20b1; ' . number_format($row1['paid']*.20,2);?>
                            </label>
                        </div>
                      </div>
                        <?php
                      } 
                      }
                      ?>
                      <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $row['status'];?>
                            </label>
                        </div>
                      </div>
					     <div class="control-group">
                        <label class="control-label">Reference Number</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php if(!empty($row['referenceno']))
								{
								echo '<b><p style="color:green";>'.$row['referenceno'].'</p></b>';								
								}
								else
								{
								echo '<b><p style="color:green";>None</b></p>';
								}?>
                            </label>
                        </div>
                      </div>
					
                        <div class="form-actions">
                          <a class="btn" href="index-reservation.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
