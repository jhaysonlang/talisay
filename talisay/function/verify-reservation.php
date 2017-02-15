<?php
    include '../dbconnect.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $qry = mysql_query("SELECT * FROM reservation WHERE transactionNo = '$id'");
        $row = mysql_fetch_array($qry);
        $totalAmount = $row['rate'];
        if($row['paymentType'] == 'Full Payment')
        {
            $paid = $totalAmount;
        }
        else
        {
            $paid = $totalAmount/2;
        }
        mysql_query("INSERT INTO billing(transactionNo,modeofPayment,paid,totalAmount) VALUES('$id','Online','$paid','$totalAmount')");
        mysql_query("UPDATE reservation SET status = 'Reserved' WHERE transactionNo = '$id'");
        mysql_close();
        header("Location: index-reservation.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
<style>
.sweet-alert
{
  top:300px !important;
}
</style>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Verify reservation</h3>
                    </div>
                     
                    <form class="form-horizontal" action="verify-reservation.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure you want to verify this transaction?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="javascript:history.back(1)">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>