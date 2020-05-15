<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['submit']) && isset($_POST['sectionId'])){
		
		$sectionId = $_POST['sectionId'];
		$sectionName = $_POST['sectionName'];
		$classDate = $_POST['class-date'];
		$st = $_POST['start-time'];
		$et = $_POST['end-time'];
		$ct = $_POST['class-type'];
		$room = $_POST['room'];

		if ($st < $et) {
			if($et >= $st + 2){
				if ($et <= $st + 6) {
					echo implode(",", $_POST).PHP_EOL;
					require '../../../includes/dbh.inc.php';

					$sql = "INSERT INTO classes (SectionId, ClassDate, ClassType, StartTimeId, EndTimeId, RoomNo, CreatedAt) VALUES (?, ?, ?, ?, ?, ?, current_timestamp());";
					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						$_SESSION['sectionId'] = $sectionId;
						$_SESSION['sectionName'] = $sectionName;
						header("Location: ../createclass.php?error=sqlerror");
						exit();
					}
					else{
						echo "prepared, inserting".PHP_EOL;
						mysqli_stmt_bind_param($stmt, "ssssss", $sectionId, $classDate, $ct, $st, $et, $room);
						mysqli_stmt_execute($stmt);
						echo mysqli_stmt_error($stmt).PHP_EOL;
						$lastInsertId = $stmt->insert_id;
						//echo $academicId." inserted id: ".$lastInsertId;

						$sql2 = "SELECT * FROM users where Id in (SELECT studentId from sectionstudents where sectionId = ?);";
						$stmt2 = mysqli_stmt_init($conn);
						if (!mysqli_stmt_prepare($stmt2, $sql2)) {
							$_SESSION['sectionId'] = $sectionId;
							$_SESSION['sectionName'] = $sectionName;
							header("Location: ../createclass.php?error=sqlerror");
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt2, "s", $sectionId);
							mysqli_stmt_execute($stmt2);
							mysqli_stmt_store_result($stmt2);
							mysqli_stmt_bind_result($stmt2, $stu_id, $stu_academicId, $stu_firstname, $stu_lastname, $stu_email, $stu_pass, $stu_userType, $stu_createdAt);

							while (mysqli_stmt_fetch($stmt2)){
								$sql3 = "INSERT INTO attendances (StudentId, ClassId, Entry, CreatedAt) VALUES (?, ?, ?, current_timestamp());";
								$stmt3 = mysqli_stmt_init($conn);
								if (!mysqli_stmt_prepare($stmt3, $sql3)) {
									$_SESSION['sectionId'] = $sectionId;
									$_SESSION['sectionName'] = $sectionName;
									header("Location: ../createclass.php?error=sqlerror");
									exit();
								}
								else{
									$entry = "0";
									mysqli_stmt_bind_param($stmt3, "sss", $stu_id, $lastInsertId, $entry);
									mysqli_stmt_execute($stmt3);
								}
								echo mysqli_stmt_error($stmt).mysqli_stmt_error($stmt2).mysqli_stmt_error($stmt3);
							}
							$_SESSION['sectionId'] = $sectionId;
							$_SESSION['sectionName'] = $sectionName;
							header("Location: ../students.php?success=classcreated&date=".$classDate);
							echo "done";
							exit();
						}
					}
				}
				else{
					$_SESSION['sectionId'] = $sectionId;
					$_SESSION['sectionName'] = $sectionName;
					header("Location: ../createclass.php?error=maxlen3h");
					exit();
				}
			}
			else{
				$_SESSION['sectionId'] = $sectionId;
				$_SESSION['sectionName'] = $sectionName;
				header("Location: ../createclass.php?error=minlen1h");
				exit();

			}
		}
		else{
			$_SESSION['sectionId'] = $sectionId;
			$_SESSION['sectionName'] = $sectionName;
			header("Location: ../createclass.php?error=neglen");
			exit();

		}
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