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
	<title>History</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/student-dashboard.css">
	<link rel="icon" href="../favicon.png">
</head>
<body>
	<header>
		<div class="back-button">
			<a href="dashboard.php"><img src="../images/back.png"></a>
		</div>
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
			<p>History</p>
		</div>
		<div class="history-div">
			<div class="historybox">
				<p class="sectionName">WEB TECH [A]</p>
				<p class="class-date">May 15</p>
				<p class="class-type">Theory</p>
				<p class="scanTime">Scan time: 2020-05-15 08:06:43</p>
			</div>
		</div>
	</div>
</body>
</html>
