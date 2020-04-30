<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['submit-single']))
	{
		if(isset($_POST['sectionId'])){
			$sectionId = $_POST['sectionId'];
			$sectionName = $_POST['sectionName'];
			$academicId = $_POST['student-id'];
			$firstName = $_POST['student-first-name'];
			$lastName = $_POST['student-last-name'];

			require '../../../includes/dbh.inc.php';

			$sql = "SELECT * FROM users where academicid = ?";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt, $sql)) {
				$_SESSION['sectionId'] = $sectionId;
				$_SESSION['sectionName'] = $sectionName;
				header("Location: ../addstudent.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $academicId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt, $stu_id, $stu_academicId, $stu_firstname, $stu_lastname, $stu_pass, $stu_userType, $stu_createdAt);
				if(mysqli_stmt_num_rows($stmt) > 0){
					//if already exists
					$sql = 
				}else{
					//if not already exists
					$sql = "INSERT INTO users (AcademicId, FirstName, LastName, Email, Password, UserType, CreatedAt) VALUES (?, ?, ?, NULL, NULL, '1', current_timestamp());";
					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						$_SESSION['sectionId'] = $sectionId;
						$_SESSION['sectionName'] = $sectionName;
						header("Location: ../addstudent.php?error=sqlerror");
						exit();
					}
					else{
						$firstName = strtoupper($firstName);
						$lastName = strtoupper($lastName);
						mysqli_stmt_bind_param($stmt, "sss", $academicId, $firstName, $lastName);
						mysqli_stmt_execute($stmt);
						$lastInsertId = $stmt->insert_id;
						echo $academicId." inserted id: ".$lastInsertId;
					}
				}
			}
		}
		else{
			//send to sections if no section ID was found 
			header("Location: ../sections.php?error=addstunosec");
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
	else{
		//send to sections if no post
		header("Location: ../sections.php");
		exit();
	}
}
else{
	//send to login if no session
	header("Location: ../../../login.php?error=nosession");
	exit();
}