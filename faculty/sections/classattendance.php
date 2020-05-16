<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['sectionId']) && $_POST['sectionId'] !== "" && isset($_POST['classId']) && $_POST['classId'] !== ""){
		$sectionId = $_POST['sectionId'];
		$sectionName = $_POST['sectionName'];
		$classId = $_POST['classId'];
	}
	else if (isset($_SESSION['sectionId']) && isset($_SESSION['classId'])){
		$sectionId = $_POST['sectionId'] = $_SESSION['sectionId'];
		$sectionName = $_POST['sectionName'] = $_SESSION['sectionName'];
		$classId = $_POST['classId'] = $_SESSION['classId'];
	}
	else{
		header("Location: sections.php");
		exit();
	}
}
else{
	header("Location: ../login.php?error=nosession");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Class Attendance</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/css/faculty-dashboard.css">
	<link rel="icon" href="../../favicon.png">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
	<?php include '../header.php';?>
	<div class="main">
		<?php include '../navigation.php'?>
		<div class="right-panel">
			<div class="page-title">
				<a href="sections.php"><button class="back-button"><img src="../../images/back.png"></button></a>
				<p>Signle class attendance list of <?php echo $_POST['sectionName']?></p>
				<?php
				echo '<form method="post" action="addstudent.php">';
				echo '<input type="hidden" name="sectionId" value="'.$sectionId.'" />';
				echo '<input type="hidden" name="sectionName" value="'.$sectionName.'" />';
				echo '<input type="submit" class="addsection-button" value="Add Students">';
				echo '</form>';
				echo '<form method="post" action="removestudents.php">';
				echo '<input type="hidden" name="sectionId" value="'.$sectionId.'" />';
				echo '<input type="hidden" name="sectionName" value="'.$sectionName.'" />';
				echo '<input type="submit" class="addsection-button" value="Remove Students">';
				echo '</form>';
				?>
			</div>
			<div class="main-container-table">
				<table class="student-table">
					<?php
					$index = 1;
					require '../../includes/dbh.inc.php';

					$sql2 = "SELECT * FROM classes where Id = ?;";
					$stmt2 = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt2, $sql2)) {
						echo '<p class="error-msg">Error retrieving data</p>';
					}
					else{
						mysqli_stmt_bind_param($stmt2, "s", $classId);
						mysqli_stmt_execute($stmt2);
						mysqli_stmt_store_result($stmt2);
						mysqli_stmt_bind_result($stmt2, $class_id, $class_sectionId, $class_date, $class_type, $class_startTimeId, $class_endTimeId, $class_roomNo, $class_QRCode, $class_QRCodeDisplayStartTIme, $class_QRCodeDisplayEndTIme, $class_createdAt);

						echo '<tr>';
						echo '<th>#</th><th>ID</th><th>Name</th>';
						while (mysqli_stmt_fetch($stmt2)) {
							$formattedDate = date("M d", strtotime($class_date));
							echo '<th>'.$formattedDate.'</th>';
						}
						echo '</tr>';
					}

					$sql = "SELECT * FROM users where Id in (SELECT studentId from sectionstudents where sectionId = ?);";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo '<p class="error-msg">Error retrieving data</p>';
					}
					else{
						mysqli_stmt_bind_param($stmt, "s", $sectionId);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						mysqli_stmt_bind_result($stmt, $stu_id, $stu_academicId, $stu_firstname, $stu_lastname, $stu_email, $stu_pass, $stu_userType, $stu_createdAt);
						while(mysqli_stmt_fetch($stmt)){
							echo '<tr>';
							echo '<td>'.$index.'</td>'.'<td>'.$stu_academicId.'</td>'.'<td>'.$stu_firstname.' '.$stu_lastname.'</td>';
						//for each student
						//echo $stu_id.' '.$stu_academicId.' '.$stu_firstname.' '.$stu_lastname.' '.$stu_email.' '.$stu_pass.' '.$stu_userType.' '.$stu_createdAt.'<br>';

							$sql2 = "SELECT * FROM classes where Id = ?;";
							$stmt2 = mysqli_stmt_init($conn);
							if (!mysqli_stmt_prepare($stmt2, $sql2)) {
								echo '<p class="error-msg">Error retrieving data</p>';
							}
							else{
								mysqli_stmt_bind_param($stmt2, "s", $classId);
								mysqli_stmt_execute($stmt2);
								mysqli_stmt_store_result($stmt2);
								mysqli_stmt_bind_result($stmt2, $class_id, $class_sectionId, $class_date, $class_type, $class_startTimeId, $class_endTimeId, $class_roomNo, $class_QRCode, $class_QRCodeDisplayStartTIme, $class_QRCodeDisplayEndTIme, $class_createdAt);
								while(mysqli_stmt_fetch($stmt2)){
								//for each class
								//echo $class_id.' '.$class_sectionId.' '.$class_date.' '.$class_type.' '.$class_startTimeId.' '.$class_endTimeId.' '.$class_roomNo.' '.$class_QRCode.' '.$class_QRCodeDisplayStartTIme.' '.$class_QRCodeDisplayEndTIme.' '.$class_createdAt.'<br>';

									$sql3 = "SELECT * FROM attendances where ClassId = ? AND StudentId = ? ORDER BY StudentId;";
									$stmt3 = mysqli_stmt_init($conn);
									if (!mysqli_stmt_prepare($stmt3, $sql3)) {
										echo '<p class="error-msg">Error retrieving data</p>';
									}
									else{
										mysqli_stmt_bind_param($stmt3, "ss", $class_id, $stu_id);
										mysqli_stmt_execute($stmt3);
										mysqli_stmt_store_result($stmt3);
										mysqli_stmt_bind_result($stmt3, $att_id, $att_studentId, $att_classId, $att_entry, $att_scanTime, $att_createdAt);
										while(mysqli_stmt_fetch($stmt3)){
										//echo $att_id.' '.$att_studentId.' '.$att_classId.' '.$att_entry.' '.$att_scanTime.' '.$att_createdAt.'<br>';
											echo '<td contenteditable class="att" id="'.$att_id.'">'.$att_entry.'</td>';
										}
									}
								}
							}
							echo '</tr>';
							$index++;
						}
					}
					?>
					<script type="text/javascript" src="../js/attedit.js"></script>
				</table>
				<div class="attMessage"></div>
			</div>
		</div>
	</body>
	</html>