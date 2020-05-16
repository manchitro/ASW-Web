<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['submit'])){
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];

		require '../../../includes/dbh.inc.php';

		$sql = "UPDATE users SET FirstName = ?, LastName = ?, Email = ? WHERE Id = ?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../profile.php?error=sqlerror");
			exit();
		}
		else{
			$firstName = trim($firstName);
			$lastName = trim($lastName);
			mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $_SESSION['userId']);
			mysqli_stmt_execute($stmt);

			$_SESSION['userFirstName'] = $firstName;
			$_SESSION['userLastName'] = $lastName;
			$_SESSION['userEmail'] = $email;

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

