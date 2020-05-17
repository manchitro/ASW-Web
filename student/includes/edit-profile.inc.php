<?php
session_start();
if (isset($_SESSION['userAcademicId']) && $_SESSION['userAcademicId']!== "") {
	if(isset($_POST['submit'])){
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];

		require '../../includes/dbh.inc.php';

		$sql = "UPDATE users SET FirstName = ?, LastName = ? WHERE AcademicId = ?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../profile.php?error=sqlerror");
			exit();
		}
		else{
			$firstName = trim($firstName);
			$lastName = trim($lastName);
			mysqli_stmt_bind_param($stmt, "sss", $firstName, $lastName, $_SESSION['userAcademicId']);
			mysqli_stmt_execute($stmt);

			$_SESSION['userFullName'] = $lastName.', '.$firstName;

			header("Location: ../profile.php?success=profupdated".mysqli_error($conn));
			exit();
		}
	}
	else{
		header("Location: ../profile.php");
		exit();
	}
}
else{
	header("Location: ../../login.php?error=nosession");
	exit();
}
?>

