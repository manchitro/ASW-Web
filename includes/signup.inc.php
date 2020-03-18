<?php
if (isset($_POST['signup-submit'])) 
{
	require 'dbh.inc.php';

	$academicid = $_POST['academicid'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$default_salt = "default_salt";

	$sql = "SELECT academicid FROM users where academicid = ?";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../signup.php?error=sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt, "s", $academicid);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$resultCheck = mysqli_stmt_num_rows($stmt);
		if($resultCheck > 0){
			header("Location: ../signup.php?error=academicidexists&email=".$email."&firstname=".$firstname."&lastname=".$lastname);
			exit();
		}
		else{
			$sql = "SELECT email FROM users where email = ?";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt, $sql)) {
				header("Location: ../signup.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $email);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if($resultCheck > 0){
					header("Location: ../signup.php?error=emailexists&academicid=".$academicid."&firstname=".$firstname."&lastname=".$lastname);
					exit();
				}
				else{
					$sql = "INSERT INTO users (AcademicId, FirstName, LastName, Email, Password, Salt, UserType, CreatedAt) VALUES (?, ?, ?, ?, ?, ?, '0', current_timestamp());";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location: ../signup.php?error=sqlerrorinsert");
						exit();
					}
					else{
						$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

						mysqli_stmt_bind_param($stmt, "ssssss", $academicid, $firstname, $lastname, $email, $hashedPassword, $default_salt);
						mysqli_stmt_execute($stmt);
						header("Location: ../login.php?signup=success");
						exit();	
					}
				}
			}
		}
		mysqli_stmt_close($stmt);
		mysql_close($conn);
	}
}
else{
	header("Location: ../signup.php?error=directaccess");
}