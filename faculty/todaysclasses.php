<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<div class="today-title">
	<p class="todays-label">Today's classes</p>
</div>
<div class="todays-classes">
	<?php
	require '../../includes/dbh.inc.php';
	include 'values.php';

	$sql = "SELECT * FROM classes WHERE sectionId IN (SELECT Id from sections where facultyId = ?) AND ClassDate = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo '<p class="error-msg">Error retrieving data</p>';
	}
	else{
		$today = date("Y-m-d");
		mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userId'], $today);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt, $classId, $classSectionId, $classDate, $classType, $classStartTimeId, $classEndTimeId, $classRoomNo, $classQRCode, $classQRDisplayStartTime, $classQRDisplayEndTime, $classCreatedAt);
		if(mysqli_stmt_num_rows($stmt) == 0){
			echo '<p class="no-class">No classes today</p>';
		}
		else{
			$index = 1;
			while (mysqli_stmt_fetch($stmt)){
				$sql2 = "SELECT SectionName FROM sections WHERE Id = ?;";
				$stmt2 = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt2, $sql2)) {
					echo '<p class="error-msg">Error retrieving data</p>';
				}
				else{
					mysqli_stmt_bind_param($stmt2, "s", $classSectionId);
					mysqli_stmt_execute($stmt2);
					mysqli_stmt_store_result($stmt2);
					mysqli_stmt_bind_result($stmt2, $section_name);

					if(mysqli_stmt_fetch($stmt2)){
						if($index%2==0) echo '<div class="today-class-box">'; else echo '<div class="today-class-box-even">';
						echo '<table class="today-class-table">';
						echo '<tr><td><p class="section-name">'.$section_name.'</p></td><td><p class="class-room">at '.$classRoomNo.'</p></td></tr>';
						echo '<tr><td><p class="class-time">'.$classtime[$classStartTimeId].' - '.$classtime[$classEndTimeId].' ['.$classtype[$classType].']'.'</p></td><td class=qr-td><button class="qr-button" id="'.$classId.'"><img src="../../images/qr.png"></button></td></tr>';
						echo '</table>';
						echo '</div>';
					}
					else{
						echo '<p class="error-msg">Error retrieving data</p>';
					}
				}
				$index++;
			}
		}
	}

	?>
	<script type="text/javascript" src="../js/qrdisplay.js"></script>
	<script type="text/javascript" src="../js/qrcode.min.js"></script>
	

</div>
<div id="qrcode"></div>