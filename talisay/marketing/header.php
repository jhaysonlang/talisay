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
					<hr>
                    <a href="index_marketing.php">
                        <img src="img/logo.png" />
                    </a>
					<hr>
                </li>
				<li>
                    <br>
                    <a href="#"><img width = "20px" height = "20px" src = "../function/glyph/user.png">   <?php 
                    echo ' '.$_SESSION['usertype']?></a>
                </li>
                <li>
                    <a href="#">Reservation</a>
					<ul>
						<li><a href="add_reservation.php">Reservation Module</a></li>
					</ul>
                </li>
                <li>
                    <a href="#">Accommodation</a>
					<ul>
						<li><a href="rooms.php">Rooms</a></li>
					</ul>
                </li>
                <li>
                    <a href="#">Facilities & Services</a>
					<ul>
						<li><a href="cottages.php">Cottages</a></li>
                        <li><a href="amenities.php">Amenities</a></li>
					</ul>
                </li>
                <li>
                    <a href="room_blocking.php">Room Blocking</a>
                </li>
                <li>
                    <a href="reports.php">Reports</a>
                </li>
				<li>
                    <a href="users.php">Users</a>
                </li>
				<li>
                    <a href="../logout.php">Log Out</a>
                </li>
            </ul>
        </div>