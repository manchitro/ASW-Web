<?php
session_start();
if (isset($_SESSION['userAcademicId']) && $_SESSION['userAcademicId']!== "" && isset($_SESSION['userFullName']) && $_SESSION['userFullName']!== "") {
	echo $_SESSION['userAcademicId']." ".$_SESSION['userFullName'];
}
else{
	header("Location: ../login.php?error=nosession");
	exit();
}
?>
