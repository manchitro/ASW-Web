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
				$sql ='DELETE FROM sectionstudents WHERE SectionId = ? AND StudentId in ('.implode(",", $idList).');';
				$stmt = mysqli_stmt_init($conn);

				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../login.php?error=sqlerror");
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