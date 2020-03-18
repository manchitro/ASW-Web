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
	<link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
	<link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
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
			<img src="../images/login.png">
		</div>
	</header>
	<div class="today-title">
		<p class="todays-label">Today's classes</p>
	</div>
	<div class="todays-classes">

	</div>
	<nav>
		<div class="nav-bars">
			<img src="../images/sections.png">
			<a href="#">Sections</a>
		</div>
		<div class="nav-bars">
			<img src="../images/classes.png">
			<a href="classes.php">Classes</a>
		</div>
		<div class="nav-bars" id="active">
			<img src="../images/search.png">
			<a href="search.php">Search</a>
		</div>
		<div class="nav-bars">
			<img src="../images/login.png">
			<a href="profile.php">Profile</a>
		</div>
		<div class="nav-bars">
			<img src="../images/logout.png">
			<a href="includes/logout.inc.php">Logout</a>
		</div>
	</nav>
</body>
</html>