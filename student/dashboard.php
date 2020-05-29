<?php
session_start();
if (isset($_SESSION['userAcademicId']) && $_SESSION['userAcademicId']!== "" && isset($_SESSION['userFullName']) && $_SESSION['userFullName']!== "") {
	//echo $_SESSION['userAcademicId']." ".$_SESSION['userFullName'];
}
else{
	header("Location: ../login.php?error=nosession");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/student-dashboard.css">
	<link rel="icon" href="../favicon.png">
</head>
<body>
	<header>
		<div id="message">
			<?php echo'<p id="name">Welcome '.$_SESSION['userFullName'].'</p>'?>
			<?php echo'<p id="aid">'.$_SESSION['userAcademicId'].'</p>'?>
		</div>
		<div id="logout">
			<a href="includes/logout.inc.php"><button name="logout">Logout</button></a>
		</div>
	</header>
	<div id="main">
		<div class="page-title">
			<p>Home</p>
		</div>
		<div id="scan-div">
			<a href="scan.php"><button name="scan">Scan</button></a>
		</div>
		<div id="history-div">
			<a href="history.php"><button name="history">History</button></a>
		</div>
		<div id="profile-div">
			<a href="profile.php"><button name="history">Profile</button></a>
		</div>
	</div>
</body>
</html>
