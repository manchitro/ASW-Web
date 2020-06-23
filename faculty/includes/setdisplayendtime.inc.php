<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['classId'])){
		require '../../includes/dbh.inc.php';

		$sql = "SELECT * FROM classes WHERE Id = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo '<p class="error-msg">Error retrieving data</p>';
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $_POST['classId']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt, $classId, $classSectionId, $classDate, $classType, $classStartTimeId, $classEndTimeId, $classRoomNo, $classQRCode, $classQRDisplayStartTime, $classQRDisplayEndTime, $classCreatedAt);

			if (mysqli_stmt_fetch($stmt)) {
					$sql2 = "UPDATE classes SET QRDisplayEndTime = current_timestamp() WHERE Id = ?;";
					$stmt2 = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt2, $sql2)) {
						echo '<p class="error-msg">Error retrieving data</p>';
					}
					else{
						mysqli_stmt_bind_param($stmt2, "s", $classId);
						mysqli_stmt_execute($stmt2);

						//echo date("Y-m-d H:i:s");
					}
			}
			else{
				echo "no qr found";
			}
		}
	}
	else{
		echo "Get QR failed: no post";
	}
}
else{
	echo "Get QR failed: no session";
}