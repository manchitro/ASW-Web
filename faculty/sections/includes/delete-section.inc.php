<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if (isset($_POST['submit']) && isset($_POST['sectionId']) && $_POST['sectionId'] !== "") {
		$sectionId = $_POST['sectionId'];
		$sectionName = $_POST['sectionName'];

		require '../../../includes/dbh.inc.php';

		$sql = "SELECT Id FROM classes WHERE SectionId = ?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			$_SESSION['sectionId'] = $sectionId;
			$_SESSION['sectionName'] = $sectionName;
			header("Location: ../editsection.php?error=sqlerror");
			//echo "get classes ".mysqli_error($conn);
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $sectionId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_get_result($stmt);
			mysqli_stmt_bind_result($stmt, $class_Id);

			//=delete all attendances for each class
			while (mysqli_stmt_fetch($stmt)) {
				$sql2 = "DELETE FROM attendances where classId = ?";
				$stmt2 = mysqli_stmt_init($conn);

				if (!mysqli_stmt_prepare($stmt2, $sql2)) {
					$_SESSION['sectionId'] = $sectionId;
					$_SESSION['sectionName'] = $sectionName;
					header("Location: ../editsection.php?error=sqlerror");
					//echo "delete att ".mysqli_error($conn);
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt2, "s", $class_Id);
					mysqli_stmt_execute($stmt2);
					echo "deleted attendances";
				}
			}
		}

		//after deleting all attendances delete all classes
		$sql3 = "DELETE FROM classes where sectionId = ?";
		$stmt3 = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt3, $sql3)) {
			$_SESSION['sectionId'] = $sectionId;
			$_SESSION['sectionName'] = $sectionName;
			header("Location: ../editsection.php?error=sqlerror");
			//echo "delete classes ".mysqli_error($conn);
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt3, "s", $sectionId);
			mysqli_stmt_execute($stmt3);
			echo "deleted classes";
		}

		//after deleting classes remove all students from section
		$sql4 = "DELETE FROM sectionStudents where sectionId = ?";
		$stmt4 = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt4, $sql4)) {
			$_SESSION['sectionId'] = $sectionId;
			$_SESSION['sectionName'] = $sectionName;
			header("Location: ../editsection.php?error=sqlerror");
			//echo "delete sectionstudents ".mysqli_error($conn);
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt4, "s", $sectionId);
			mysqli_stmt_execute($stmt4);
			echo "deleted sectionstudents";
		}

		//after removing all students, delete all sectionTimes
		$sql5 = "DELETE FROM sectionTimes where sectionId = ?";
		$stmt5 = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt5, $sql5)) {
			$_SESSION['sectionId'] = $sectionId;
			$_SESSION['sectionName'] = $sectionName;
			header("Location: ../editsection.php?error=sqlerror");
			//echo "delete sectiontimes ".mysqli_error($conn);
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt5, "s", $sectionId);
			mysqli_stmt_execute($stmt5);
			echo "deleted sectiontimes";
		}

		//after deleting all sectionTimes, delete the section
		$sql6 = "DELETE FROM sections where Id = ?";
		$stmt6 = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt6, $sql6)) {
			$_SESSION['sectionId'] = $sectionId;
			$_SESSION['sectionName'] = $sectionName;
			header("Location: ../editsection.php?error=sqlerror");
			//echo "delete section ".mysqli_error($conn);
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt6, "s", $sectionId);
			mysqli_stmt_execute($stmt6);
			echo "deleted section";

			mysqli_stmt_close($stmt);
			mysqli_close($conn);

			//redirect to sections after creation
			header("Location: ../sections.php?secdeleted=".$sectionName);
			exit();
		}
	}
	else{
		header("Location: ../sections.php");
		exit();
	}
}
else{
	header("Location: ../../../login.php?error=nosession");
	exit();
}

?>