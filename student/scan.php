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
	<title>Scan</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/student-dashboard.css">
	<link rel="icon" href="../favicon.png">
</head>
<body>
	<header>
		<div class="back-button">
			<a href="dashboard.php"><button name="back">Back</button></a>
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
			<p>Scan</p>
		</div>
	</div>
</body>
</html>
