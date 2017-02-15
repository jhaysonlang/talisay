<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
<?php 
include '../dbconnect.php';
$qry = mysql_query("SELECT * FROM users");
?>
	<br>
    <div class="container">
		
            <div class="row">
			
                <h3>User Information</h3>
            </div>
            <div class="row">
			    <p>
                    <?php 
                    session_start();
                    if($_SESSION['usertype'] == 'Admin')
                    {
                    ?>
                    <a href="create.php" class="btn btn-success">Create</a>
                    <?php 
                    }
                    ?>
                </p>
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>First Name</th>
						  <th>Last Name</th>
                          <th>Username</th>
                          <th>Usertype</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                  <?php 
                        while($row = mysql_fetch_array($qry))
                        {
                          ?>
                          <tr>
                          <td><?php echo $row['name']?></td>
                          <td><?php echo $row['lname']?></td>
                          <td><?php echo $row['username']?></td>
                          <td><?php echo $row['usertype']?></td>
                          <td width=250>
                          <a class="btn" href="read.php?id=<?php echo $row['user_id']?>">Read</a>
                          <?php 
                          if($_SESSION['usertype'] == 'Admin')
                          {
                          ?>
                          &nbsp;
                          <a class="btn btn-success" href="update.php?id=<?php echo $row['user_id']?>">Update</a>
                          &nbsp;
                          <a class="btn btn-danger" href="delete.php?id=<?php echo $row['user_id']?>">Delete</a>
                          <?php 
                          }
                          ?>
                          </td>
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
        
		