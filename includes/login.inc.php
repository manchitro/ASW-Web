<?php
if(isset($_POST['login-submit']))
{
	require 'dbh.inc.php';

	$uid = $_POST['email'];
	$password = $_POST['password'];

	if (preg_match("/^\d{4}-\d{4}-[1-3]$/", $uid) || preg_match("/^[a-zA-Z0-9]+@aiub\.edu$/", $uid)) {
		$sql ="SELECT * FROM users WHERE Email=? OR AcademicId=?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../login.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$passwordCheck = password_verify($password, $row['Password']);
				if ($passwordCheck == false) {
					header("Location: ../login.php?error=badcred");
					exit();
				}
				elseif ($passwordCheck == true) {
					session_start();
					$_SESSION['userId'] = $row['Id'];
					$_SESSION['userAcademicId'] = $row['AcademicId'];
					$_SESSION['userFirstName'] = $row['FirstName'];
					$_SESSION['userLastName'] = $row['LastName'];
					$_SESSION['userEmail'] = $row['Email'];
					$_SESSION['userType'] = $row['UserType'];
					$_SESSION['userCreatedAt'] = $row['CreatedAt'];

					header("Location: ../faculty/sections.php");
				}
				else{
					header("Location: ../login.php?error=badcred");
					exit();
				}
			}
			else{
				header("Location: ../login.php?error=badcred");
				exit();
			}
		}
	}
	elseif (preg_match("/^\d{2}-\d{5}-[1-3]$/", $uid)) {
		echo "student";	
	}
	else{
		header("Location: ../login.php?error=invalidlogin");
	}
}
else{
	header("Location: ../login.php?error=directaccess");
	exit();
}