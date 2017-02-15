<?php 
include '../dbconnect.php';
mysql_query("UPDATE cottagecategory set cottageType = TRIM(cottageType) , dayRate = TRIM(dayRate) , nightRate = TRIM(nightRate)");
mysql_query("UPDATE functionroom set frname = TRIM(frname) , frRate = TRIM(frRate), perHour = TRIM(perHour)");
mysql_query("UPDATE customers set name = TRIM(name) , lname = TRIM(lname), email = TRIM(email) , mobile = TRIM(mobile) , password = TRIM(password)");
mysql_query("UPDATE cottages set cottageID = TRIM(cottageID)");
mysql_query("UPDATE grandballroom set gbrName = TRIM(gbrName) , gbrRate = TRIM(gbrRate), perHour = TRIM(perHour)");
mysql_query("UPDATE reservation set guestName = TRIM(guestName) , email = TRIM(email), mobileNumber = TRIM(mobileNumber)");
mysql_query("UPDATE roomcategory set roomType = TRIM(roomType) , bedConfiguration = TRIM(bedConfiguration), capacity = TRIM(capacity) , roomRate = TRIM(roomRate)");
mysql_query("UPDATE rooms set roomNum = TRIM(roomNum) , view = TRIM(view)");
mysql_query("UPDATE users set email = TRIM(email) , password = TRIM(password)");
?>
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
					
                     <h4><b><?php echo "Welcome" .' '.$_SESSION['usertype']?></b></h4>
                </li>
                <li>
                    <b>Reservation</b>
					
						<li><a href="add_reservation.php"><img src="img/reserved.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reservation Module</a></li>
                        <li><a href="add_amenity.php"><img src="img/add.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Additional Charges</a></li>
					
                </li>
                <li>
                    <b>Accommodation</b>
					
						<li><a href="rooms.php"><img src="img/rooms.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rooms</a></li>
				                <li><a href="room_blocking.php"><img src="img/calendar.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Room Blocking</a>
                </li>	
                </li>
                <li>
                     <b>Facilities & Services</b>
					
						<li><a href="cottages.php"><img src="img/cottage.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cottages</a></li>
                        <li><a href="amenities.php"><img src="img/amenities.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amenities</a></li>
					
                </li>

                <li>
                    <a href="reports.php"><img src="img/reports.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reports</a>
                </li>
				<li>
                    <a href="users.php"><img src="img/user.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users</a>
                </li>
				<li>
                    <a href="../logout.php"><img src="img/logout.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Log Out</a>
                </li>
            </ul>
        </div>