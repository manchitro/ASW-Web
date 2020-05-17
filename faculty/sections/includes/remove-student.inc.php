<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if (isset($_POST['sectionId']) && $_POST['sectionId'] !== "") {
		if(isset($_POST['submit']))
		{
			if (isset($_POST["foo"])) 
			{
				$idList = $_POST['foo'];
				$sectionId = $_POST['sectionId'];
				
				require '../../../includes/dbh.inc.php';

				$sql0 = "SELECT * FROM classes where sectionId = ?";
				$stmt0 = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt0, $sql0)) {
					echo '<p class="error-msg">Error retrieving data</p>';
				}
				else{
					mysqli_stmt_bind_param($stmt0, "s", $sectionId);
					mysqli_stmt_execute($stmt0);
					mysqli_stmt_store_result($stmt0);
					mysqli_stmt_bind_result($stmt0, $classId, $classSectionId, $classDate, $classType, $classStartTimeId, $classEndTimeId, $classRoomNo, $classQRCode, $classQRDisplayStartTime, $classQRDisplayEndTime, $classCreatedAt);
					if(mysqli_stmt_num_rows($stmt0) == 0){
						echo "<p>No classes found. Add a class using the button above.</p>";
					}
					else{
						while (mysqli_stmt_fetch($stmt0)) {
							$sql1 ='DELETE FROM attendances WHERE classId = ? AND StudentId in ('.implode(",", $idList).');';
							$stmt1 = mysqli_stmt_init($conn);

							if (!mysqli_stmt_prepare($stmt1, $sql1)) {
								header("Location: ../removestudents.php?error=sqlerror");
								exit();
							}
							else{
								mysqli_stmt_bind_param($stmt1, "ss", $classId);
								mysqli_stmt_execute($stmt1);

								header("Location: ../removestudents.php?success=removedstudents");
							}
						}

					}
				}

				$sql ='DELETE FROM sectionstudents WHERE SectionId = ? AND StudentId in ('.implode(",", $idList).');';
				$stmt = mysqli_stmt_init($conn);

				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../removestudents.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt, "s", $sectionId);
					mysqli_stmt_execute($stmt);

					header("Location: ../removestudents.php?success=removedstudents");
				}
			}
			else
			{
				$_SESSION['sectionId'] = $_POST['sectionId'];
				$_SESSION['sectionName'] = $_POST['sectionName'];
				header("Location: ../removestudents.php?error=nosel");
			}
		}
		else{
		//send to sections if no post
			header("Location: ../sections.php");
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