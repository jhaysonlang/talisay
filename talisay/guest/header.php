  <link href="../admin/css/simple-sidebar.css" rel="stylesheet">
<div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
					<p></p>
						<p></p>
							<p></p>
					<img src="img/logos.png" class="logo">
                    <a href="index_admin.php">
                    </a>
				
				
                </li>
				<li align="center">
						<p></p>
						<p></p>						
                    <br>
			<br>		
                     <h4><b><?php echo "Welcome" .' '.$_SESSION['usertype']?></b></h4>
                </li>
                
                <li>
                    <a href="my_account.php"><img src="../admin/img/user.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Account</a>					
                </li>
                <li>
                    <a href="my_reservation.php"><img src="../admin/img/reserved.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Reservation</a>
                </li>
                <li>
                    <a href="uploadreciept.php"><img src="../function/glyph/upload.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Upload Receipt</a>
                </li>                
				<li>
                    <a href="../logout.php"><img src="../admin/img/logout.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log Out</a>
                </li>
            </ul>
        </div>