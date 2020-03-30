<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
}
else{
	header("Location: ../login.php?error=nosession");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Faculty - Sections</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/css/faculty-dashboard.css">
</head>
<body>
	<header>
		<div class="title">
			<h4>ASW Faculty Portal</h4>
		</div>
		<div class="welcome">
			<?php
			echo "<p>Welcome, ".$_SESSION['userFirstName']." ".$_SESSION['userLastName']."</p>"; 
			?>
			<img src="../../images/login.png">
		</div>
	</header>
	<div class="main">
		<div class="left-panel">
			<div class="today-title">
				<p class="todays-label">Today's classes</p>
			</div>
			<div class="todays-classes">

			</div>
			<nav>
				<div class="nav-bars" id="active">
					<img src="../../images/sections.png">
					<a href="#">Sections</a>
				</div>
				<div class="nav-bars">
					<img src="../../images/classes.png">
					<a href="classes.php">Classes</a>
				</div>
				<div class="nav-bars">
					<img src="../../images/search.png">
					<a href="search.php">Search</a>
				</div>
				<div class="nav-bars">
					<img src="../../images/login.png">
					<a href="profile.php">Profile</a>
				</div>
				<div class="nav-bars">
					<img src="../../images/logout.png">
					<a href="includes/logout.inc.php">Logout</a>
				</div>
			</nav>
		</div>
		<div class="right-panel">
			<div class="page-title">
				<a href="sections.php"><button class="back-button"><img src="../../images/back.png"></button></a>
				<p>Add Section</p>
			</div>
			<div class="main-container">
				<form method="post" action="includes/create-section.inc.php">
					<div class="section-name-div">
						Section Name: <input type="text" name="section-name" placeholder="i.e.: WEB TECHNOLOGIES [A]">
					</div>
					<div class="section-time">
						<p>Section Time 1 (first class of the week)</p>
						Weekday: <select name="weekday-1">
							<option value="0">Sunday</option>
							<option value="1">Monday</option>
							<option value="2">Tuesday</option>
							<option value="3">Wednesday</option>
							<option value="4">Thursday</option>
						</select>
						from <select name="start-time-1">
							<option value="0">8:00</option>
							<option value="1">8:30</option>
							<option value="2">9:00</option>
							<option value="3">9:30</option>
							<option value="4">10:00</option>
							<option value="5">10:30</option>
							<option value="6">11:00</option>
							<option value="7">11:30</option>
							<option value="8">12:00</option>
							<option value="9">12:30</option>
							<option value="10">1:00</option>
							<option value="11">1:30</option>
							<option value="12">2:00</option>
							<option value="13">2:30</option>
							<option value="14">3:00</option>
							<option value="15">3:30</option>
							<option value="16">4:00</option>
							<option value="17">4:30</option>
							<option value="18">5:00</option>
							<option value="19">5:30</option>
							<option value="20">6:00</option>
							<option value="21">6:30</option>
							<option value="22">7:00</option>
							<option value="23">7:30</option>
							<option value="24">8:00</option>
						</select>
						to <select name="end-time-1">
							<option value="0">8:00</option>
							<option value="1">8:30</option>
							<option value="2">9:00</option>
							<option value="3">9:30</option>
							<option value="4">10:00</option>
							<option value="5">10:30</option>
							<option value="6">11:00</option>
							<option value="7">11:30</option>
							<option value="8">12:00</option>
							<option value="9">12:30</option>
							<option value="10">1:00</option>
							<option value="11">1:30</option>
							<option value="12">2:00</option>
							<option value="13">2:30</option>
							<option value="14">3:00</option>
							<option value="15">3:30</option>
							<option value="16">4:00</option>
							<option value="17">4:30</option>
							<option value="18">5:00</option>
							<option value="19">5:30</option>
							<option value="20">6:00</option>
							<option value="21">6:30</option>
							<option value="22">7:00</option>
							<option value="23">7:30</option>
							<option value="24">8:00</option>
						</select>
						<br>
						Class Type: <input type="radio" id="lab" name="class-type-1" value="0" checked="true">
						<label for="lab">Lab</label>
						<input type="radio" id="theory" name="class-type-1" value="1">
						<label for="theory">Theory</label>
						<br>
						Room: <input type="text" name="room-1" placeholder="i.e. 1115/D0203">
					</div>
					<div class="section-time">
						<p>Section Time 2 (second class of the week)</p>
						Weekday: <select>
							<option value="0">Sunday</option>
							<option value="1">Monday</option>
							<option value="2">Tuesday</option>
							<option value="3">Wednesday</option>
							<option value="4">Thursday</option>
						</select>
						from <select>
							<option value="0">8:00</option>
							<option value="1">8:30</option>
							<option value="2">9:00</option>
							<option value="3">9:30</option>
							<option value="4">10:00</option>
							<option value="5">10:30</option>
							<option value="6">11:00</option>
							<option value="7">11:30</option>
							<option value="8">12:00</option>
							<option value="9">12:30</option>
							<option value="10">1:00</option>
							<option value="11">1:30</option>
							<option value="12">2:00</option>
							<option value="13">2:30</option>
							<option value="14">3:00</option>
							<option value="15">3:30</option>
							<option value="16">4:00</option>
							<option value="17">4:30</option>
							<option value="18">5:00</option>
							<option value="19">5:30</option>
							<option value="20">6:00</option>
							<option value="21">6:30</option>
							<option value="22">7:00</option>
							<option value="23">7:30</option>
							<option value="24">8:00</option>
						</select>
						to <select>
							<option value="0">8:00</option>
							<option value="1">8:30</option>
							<option value="2">9:00</option>
							<option value="3">9:30</option>
							<option value="4">10:00</option>
							<option value="5">10:30</option>
							<option value="6">11:00</option>
							<option value="7">11:30</option>
							<option value="8">12:00</option>
							<option value="9">12:30</option>
							<option value="10">1:00</option>
							<option value="11">1:30</option>
							<option value="12">2:00</option>
							<option value="13">2:30</option>
							<option value="14">3:00</option>
							<option value="15">3:30</option>
							<option value="16">4:00</option>
							<option value="17">4:30</option>
							<option value="18">5:00</option>
							<option value="19">5:30</option>
							<option value="20">6:00</option>
							<option value="21">6:30</option>
							<option value="22">7:00</option>
							<option value="23">7:30</option>
							<option value="24">8:00</option>
						</select>
						<br>
						Class Type: <input type="radio" id="lab" name="class-type-2" value="0" checked="true">
						<label for="lab">Lab</label>
						<input type="radio" id="theory" name="class-type-2" value="1">
						<label for="theory">Theory</label><br>
						Room: <input type="text" name="room-2" placeholder="i.e. 1115/D0203">
					</div>
					<div class="one-class">
						Select if this section has only one class per week (Section time 2 will be ignored) <input type="checkbox" name="one-class">
					</div>
					<div class="buttons">
						<input type="submit"> <input type="reset">
					</div>
				</form>
			</div>
		</div>
	</body>
</html>