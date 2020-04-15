<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if (isset($_POST['submit']) && isset($_POST['section-id']) && $_POST['section-id'] !== "") {
		$sectionId = $_POST['section-id'];
		
		require '../../../includes/dbh.inc.php';

		$sql0 = "SELECT * FROM sections where Id = ? AND FacultyId = ?;";
		$stmt0 = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt0, $sql0)){
			$_SESSION['sectionId'] = $sectionId;
			$_SESSION['sectionName'] = $sectionName;
			header("Location: ../editsection.php?error=sqlerror0");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt0, "ss", $sectionId, $_SESSION['userId']);
			mysqli_stmt_execute($stmt0);
			mysqli_stmt_store_result($stmt0);
			if(mysqli_stmt_num_rows($stmt0) == 0){
				$_SESSION['sectionId'] = $sectionId;
				$_SESSION['sectionName'] = $sectionName;
				header("Location: ../editsection.php?error=sec404");
				exit();
			}
			else{
				$sql1 = "DELETE FROM sectiontimes WHERE SectionId = ?;";
				$stmt1 = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt1, $sql1)){
					$_SESSION['sectionId'] = $sectionId;
					$_SESSION['sectionName'] = $sectionName;
					header("Location: ../editsection.php?error=sqlerror1");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt1, "s", $sectionId);
					mysqli_stmt_execute($stmt1);

					$sql2 = "DELETE FROM sections WHERE Id = ?;";
					$stmt2 = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt2, $sql2)){
						$_SESSION['sectionId'] = $sectionId;
						$_SESSION['sectionName'] = $sectionName;
						header("Location: ../editsection.php?error=sqlerror2");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt2, "s", $sectionId);
						mysqli_stmt_execute($stmt2);
						$affectedRows = mysqli_stmt_affected_rows($stmt2);
					}
				}
			}
		}
		mysqli_stmt_close($stmt0);
		mysqli_stmt_close($stmt1);
		mysqli_stmt_close($stmt2);
		mysqli_close($conn);

		header("Location: ../sections.php?secdeleted=".$_POST['section-name']);
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