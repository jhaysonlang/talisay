<?php
include 'dbconnect.php';
if(isset($_POST['email']))
{
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$pass = $_POST['pass'];
$pass1 = $_POST['pass1'];
$code = strtoupper(substr(uniqid(),6,7));
$rcode = $code;
$qry = mysql_query("SELECT * FROM customers WHERE email = '$email'");
if(mysql_num_rows($qry) > 0)
{
	echo '<script>alert("Email already taken!");</script>';
}
else
{
	if($pass1 != $pass)
	{
		echo '<script>alert("Password does not match!");</script>';
	}
	else
	{
		mysql_query("INSERT INTO customers(rcode,name,lname,email,mobile,password) VALUES('$rcode','$fname','$lname','$email','$mobile','$pass')");
		echo '<script>alert("Successfuly Created Account!"); location.href="index_login.php";</script>';
	}
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
	@charset "utf-8";
/* CSS Document */

*
{
 margin:0;
 padding:0;
}
body{
	background-image:url('bg.jpg');
}
#login-form
{
 margin-top:70px;

}

table
{

 padding:25px;
box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);



}
table tr,td
{
 padding:15px;
 //border:solid #0099FF 1px;
}
table tr td input
{
 width:97%;
 height:45px;
 border:solid rgba(61, 140, 35, 0.87) 1px;
 border-radius:3px;
 padding-left:10px;
 font-family:Calibri;
 font-size:16px;
 background:#f9f9f9;
 transition-duration:0.5s;
 box-shadow: inset 0px 0px 1px rgba(0,0,0,0.4);
}

table tr td button
{
 width:100%;
 height:45px;
 border:0px;
 background:rgba(247, 195, 131, 0.82);
  color:black;
 background:-moz-linear-gradient(top, #56AC56 , #56AC56);
 border-radius:3px;
 box-shadow: 1px 1px 1px rgba(1,0,0,0.2);
 font-family:Calibri;
 font-size:18px;
 font-weight:bolder;
 text-transform:uppercase;
}
table tr td button:hover{
	background:rgba(255, 141, 0, 0.82);
	color:white;
}
table tr td button:active
{
 position:relative;
 top:1px;
}
table tr td a
{
 text-decoration:none;
 color:white;
 font-family:Calibri;
 font-size:18px;
}
table tr td a:hover{
	color:rgba(255, 141, 0, 0.82);
}
/* css for home page  */

*
{
 margin:0;
 padding:0;
}
#header
{
 width:100%;
 height:60px;
 background:rgba(00,11,22,33);
 color:#9fa8b0;
 font-family:Calibri;
}
#header #left
{
 float:left;
 position:relative;
}
#header #left label
{
 position:relative;
 top:5px;
 left:100px;
 font-size:35px;
}
#header #right
{
 float:right;
 position:relative;
}
#header #right #content
{
 position:relative;
 top:20px;
 right:100px;
 color:#fff;
}
#header #right #content a
{
 color:#00a2d1;
}

/* css for home page */
</style>
</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="email" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><input type="text" name="fname" placeholder="Your First Name" required /></td>
</tr>
<tr>
<td><input type="text" name="lname" placeholder="Your Last Name" required /></td>
</tr>
<tr>
<td><input type="text" name="mobile" placeholder="Mobile Number" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><input type="password" name="pass1" placeholder="Confirm Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Create account.</button></td>
</tr>
<tr>
<td align="center"><a href="index_login.php">I already have an account. Sign in.</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>