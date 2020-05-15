<?php
session_start();
if (isset($_SESSION['userEmail']) && $_SESSION['userEmail'] == "admin") {
	if (isset($_POST['submit'])) {
		$oldPassword = $_POST['oldPassword'];
		$newPassword = $_POST['password'];

		require '../../includes/dbh.inc.php';

		$sql ="SELECT * FROM users WHERE Email = ?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../profile.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $_SESSION['userEmail']);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$passwordCheck = password_verify($oldPassword, $row['Password']);
				if ($passwordCheck == false) {
					header("Location: ../profile.php?error=badpass");
					exit();
				}
				elseif ($passwordCheck == true) {
					$hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);

					$sql2 ="UPDATE users SET Password = ? where Email = ?;";
					$stmt2 = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt2, $sql2)) {
						header("Location: ../profile.php?error=sqlerror");
						exit();
					}	
					else{
						mysqli_stmt_bind_param($stmt2, "ss", $hashedPassword, $_SESSION['userEmail']);
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
	header("Location: ../login.php?error=nosession");
	exit();
}
?>