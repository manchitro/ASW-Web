<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['submit'])){
		$oldPassword = $_POST['oldPassword'];
		$newPassword = $_POST['password'];
		$conPassword = $_POST['confirm_password'];

		require '../../../includes/dbh.inc.php';

		$sql = "SELECT Password FROM users WHERE Id = ?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../profile.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt, $user_password);
			if(mysqli_stmt_fetch($stmt)){
				if(password_verify($oldPassword, $user_password) == true){
					$hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);

					$sql2 ="UPDATE users SET Password = ? where Id = ?;";
					$stmt2 = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt2, $sql2)) {
						header("Location: ../profile.php?error=sqlerror");
						exit();
					}	
					else{
						mysqli_stmt_bind_param($stmt2, "ss", $hashedPassword, $_SESSION['userId']);
						mysqli_stmt_execute($stmt2);

						header("Location: ../profile.php?success=passchanged");
						exit();
					}
				}
				else{
					header("Location: ../profile.php?error=badpass");
					exit();
				}
			}
			else{
				header("Location: ../profile.php?error=ukerror");
				exit();
			}
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

