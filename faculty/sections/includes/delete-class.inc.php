<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['submit']) && isset($_POST['sectionId']) && isset($_POST['classId'])){
		$sectionId = $_POST['sectionId'];
		$sectionName = $_POST['sectionName'];
		$classId = $_POST['classId'];

		require '../../../includes/dbh.inc.php';

		$sql = "DELETE FROM attendances WHERE ClassId = ?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			$_SESSION['sectionId'] = $sectionId;
			$_SESSION['sectionName'] = $sectionName;
			$_SESSION['classId'] = $classId;
			header("Location: ../editclass.php?error=sqlerror");
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $classId);
			mysqli_stmt_execute($stmt);

			$sql2 = "DELETE FROM classes WHERE Id = ?";
			$stmt2 = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt2, $sql2)){
				$_SESSION['sectionId'] = $sectionId;
				$_SESSION['sectionName'] = $sectionName;
				$_SESSION['classId'] = $classId;
				header("Location: ../editclass.php?error=sqlerror");
			}
			else{
				mysqli_stmt_bind_param($stmt2, "s", $classId);
				mysqli_stmt_execute($stmt2);

				$_SESSION['sectionId'] = $sectionId;
				$_SESSION['sectionName'] = $sectionName;
				header("Location: ../classes.php?success=classdeleted");
				exit();
			}
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