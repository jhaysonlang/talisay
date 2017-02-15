<?php
    include '../dbconnect.php';
    if ($_GET['id']) {
        // keep track post values
        $id = $_GET['id'];
        //delete data
        mysql_query("UPDATE reservation SET status = 'Cancelled' WHERE transactionNo = '$id'");
        mysql_close();
        header("Location: index-reservation.php");
    }
?>
 
