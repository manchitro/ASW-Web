<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['attId']) && isset($_POST['attEntry'])){
		$attId = $_POST['attId'];
		$attEntry = $_POST['attEntry'];

		require '../../../includes/dbh.inc.php';

		$sql = "UPDATE attendances SET Entry = ? WHERE Id = ?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "Attendance update failed: sqlerror";
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "ii", $attEntry, $attId);
			mysqli_stmt_execute($stmt);

			echo "changed: ".$attId." to ".$attEntry;
			exit();
		}		
	}
	else{
		echo "Attendance update failed: no post";
	}
}
else{
	echo "Attendance update failed: no session";
}