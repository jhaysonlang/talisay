<?php
include 'dbconnect.php';
session_start();	
if(isset($_SESSION['usertype']) AND $_SESSION['usertype'] == 'admin')
	{
		header('location: admin/index_admin.php');
	}
else if(isset($_SESSION['usertype']) AND $_SESSION['usertype'] == 'guest')
	{
		header("location: ../guest/index_guest.php");

	}

if(isset($_POST['email']))
{
$email = $_POST['email'];
$password = $_POST['password'];
$qry = mysql_query("SELECT * FROM users WHERE username = '$email' AND password = '$password'");
$qry1 = mysql_query("SELECT * FROM customers WHERE email = '$email' AND password = '$password'");
if(mysql_num_rows($qry) == 1)
{
$row = mysql_fetch_array($qry);
$_SESSION['username'] = $row['username'];
$_SESSION['usertype'] = $row['usertype'];
if($row['usertype'] == 'Admin')
{
	header('location: admin/add_reservation.php');
}
else if($row['usertype'] == 'Receptionist')
{
	header('location: receptionist/index_receptionist.php');
}
else if($row['usertype'] == 'Marketing')
{
	header('location: marketing/index_marketing.php');
}
}
else if(mysql_num_rows($qry1) == 1)
{
$row1 = mysql_fetch_array($qry1);
$_SESSION['username'] = $row1['email'];

$_SESSION['usertype'] = 'guest';
header("location: guest/my_reservation.php");
}
else
{
	echo '<script>alert("Invalid username and password!");</script>';
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Talisay Green Lake Resort</title>
<link rel="stylesheet" href="login-style.css" type="text/css" />
</head>
<body>
<center>

<div id="login-form">
<form method="POST" action = "">
<table align="center" width="30%" border="0">
<tr align="center">
<td><a href="website/index.php"><img src="logo_web.png" /></a></td>
</tr>
<tr>
<td><input type="text" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><input type="password" name="password" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-login">Sign In</td>
</tr>
<tr>
<td align="center"><a href="register.php" class="create">Create an account</a></td>
</tr>


</form>
</div>
<tr>
<td align="center"><a href="talisay/index.php" class="create">Go back to website</a></td>
</tr>
</table>
</center>
</body>
</html>