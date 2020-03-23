<?php
session_start();
if (isset($_SESSION['userAcademicId']) && $_SESSION['userAcademicId']!== "") {
}
else{
	header("Location: ../login.php?error=nosession");
	exit();
}
?>