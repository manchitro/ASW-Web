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

			$sql = "SELECT * FROM users where academicId = ?";
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
				mysqli_stmt_bind_result($stmt, $stu_id, $stu_academicId, $stu_firstname, $stu_lastname, $stu_email, $stu_pass, $stu_userType, $stu_createdAt);
				if(mysqli_stmt_num_rows($stmt) > 0){
					//if already exists
					if (mysqli_stmt_fetch($stmt)) {
						$foundId = $stu_id;

						$sql2 = "INSERT INTO sectionstudents (SectionId, StudentId) VALUES (?, ?);";
						$stmt2 = $stmt = mysqli_stmt_init($conn);

						if (!mysqli_stmt_prepare($stmt2, $sql2)) {
							$_SESSION['sectionId'] = $sectionId;
							$_SESSION['sectionName'] = $sectionName;
							header("Location: ../addstudent.php?error=sqlerror");
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt, "ss", $sectionId, $foundId);
							mysqli_stmt_execute($stmt);

							$sql3 = "SELECT * FROM classes where sectionId = ?;";
							$stmt3 = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt3, $sql3)) {
								echo '<p class="error-msg">Error retrieving data</p>';
							}
							else{
								mysqli_stmt_bind_param($stmt3, "s", $sectionId);
								mysqli_stmt_execute($stmt3);
								mysqli_stmt_store_result($stmt3);
								mysqli_stmt_bind_result($stmt3, $classId, $classSectionId, $classDate, $classType, $classStartTimeId, $classEndTimeId, $classRoomNo, $classQRCode, $classQRDisplayStartTime, $classQRDisplayEndTime, $classCreatedAt);
								while (mysqli_stmt_fetch($stmt3)){
									$sql4 = "INSERT INTO attendances (StudentId, ClassId, CreatedAt) VALUES (?, ?, current_timestamp());";
									$stmt4 = mysqli_stmt_init($conn);
									if (!mysqli_stmt_prepare($stmt4, $sql4)) {
										$_SESSION['sectionId'] = $sectionId;
										$_SESSION['sectionName'] = $sectionName;
										header("Location: ../createclass.php?error=sqlerror");
										exit();
									}
									else{
										//$entry = "0";
										mysqli_stmt_bind_param($stmt4, "ss", $foundId, $classId);
										mysqli_stmt_execute($stmt4);
									}
								}
								$_SESSION['sectionId'] = $sectionId;
								$_SESSION['sectionName'] = $sectionName;
								header("Location: ../addstudent.php?success=added&aid=".$academicId."&name=".$stu_firstname." ".$stu_lastname."&existing=Existing%20Student%20");
								exit();
							}	
						}
					}
					else{
						$_SESSION['sectionId'] = $sectionId;
						$_SESSION['sectionName'] = $sectionName;
						header("Location: ../addstudent.php?error=lostid");
						exit();
					}
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

						$sql2 = "INSERT INTO sectionstudents (SectionId, StudentId) VALUES (?, ?);";
						$stmt2 = $stmt = mysqli_stmt_init($conn);

						if (!mysqli_stmt_prepare($stmt2, $sql2)) {
							$_SESSION['sectionId'] = $sectionId;
							$_SESSION['sectionName'] = $sectionName;
							header("Location: ../addstudent.php?error=sqlerror");
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt2, "ss", $sectionId, $lastInsertId);
							mysqli_stmt_execute($stmt2);
							
							$sql3 = "SELECT * FROM classes where sectionId = ?;";
							$stmt3 = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt3, $sql3)) {
								echo '<p class="error-msg">Error retrieving data</p>';
							}
							else{
								mysqli_stmt_bind_param($stmt3, "s", $sectionId);
								mysqli_stmt_execute($stmt3);
								mysqli_stmt_store_result($stmt3);
								mysqli_stmt_bind_result($stmt3, $classId, $classSectionId, $classDate, $classType, $classStartTimeId, $classEndTimeId, $classRoomNo, $classQRCode, $classQRDisplayStartTime, $classQRDisplayEndTime, $classCreatedAt);
								while (mysqli_stmt_fetch($stmt3)){
									$sql4 = "INSERT INTO attendances (StudentId, ClassId, CreatedAt) VALUES (?, ?, current_timestamp());";
									$stmt4 = mysqli_stmt_init($conn);
									if (!mysqli_stmt_prepare($stmt4, $sql4)) {
										$_SESSION['sectionId'] = $sectionId;
										$_SESSION['sectionName'] = $sectionName;
										header("Location: ../addstudent.php?error=sqlerror");
										exit();
									}
									else{
										//$entry = "0";
										mysqli_stmt_bind_param($stmt4, "ss", $lastInsertId, $classId);
										mysqli_stmt_execute($stmt4);
									}
								}
								$_SESSION['sectionId'] = $sectionId;
								$_SESSION['sectionName'] = $sectionName;
								header("Location: ../addstudent.php?success=added&aid=".$academicId."&name=".$firstName." ".$lastName."&existing=New%20Student%20");
								exit();
							}
						}
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