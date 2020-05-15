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

	require '../../includes/dbh.inc.php';

	$sectionId = $_POST['sectionId'];
	$sectionName = $_POST['sectionName'];

	$sql2 = "SELECT * FROM classes WHERE Id = ?;";
	$stmt2 = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt2, $sql2)){
		echo '<p class="error-msg">Error retrieving your data. Please go back and try again!</p>';
	}
	else{
		mysqli_stmt_bind_param($stmt2, "s", $classId);
		mysqli_stmt_execute($stmt2);
		mysqli_stmt_store_result($stmt2);
		mysqli_stmt_bind_result($stmt2, $classId, $classSectionId, $classDate, $classType, $classStartTimeId, $classEndTimeId, $classRoomNo, $classQRCode, $classQRDisplayStartTime, $classQRDisplayEndTime, $classCreatedAt);
		if(mysqli_stmt_num_rows($stmt2) == 0){
			echo "<p>Error: Class not found</p>";
		}
		else{
			if(mysqli_stmt_fetch($stmt2)){
				$cId = $classId;
				$cSecId = $classSectionId;
				$cDate = $classDate;
				$ct1 = $classType;
				$st1 = $classStartTimeId;
				$et1 = $classEndTimeId;
				$room1 = $classRoomNo;
				$cQR = $classQRCode;
				$cQRStart = $classQRDisplayStartTime;
				$cQREnd = $classQRDisplayEndTime;
				$cCreated = $classCreatedAt;
			}
			else{
				header("Location: sections.php");
				exit();
			}
		}
	}
	mysqli_stmt_close($stmt2);
	mysqli_close($conn);
}
else{
	header("Location: ../../login.php?error=nosession");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Faculty - Edit Class</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/css/faculty-dashboard.css">
	<link rel="icon" href="../../favicon.png">
</head>
<body>
	<?php include '../header.php';?>
	<div class="main">
		<?php include '../navigation.php'?>
		<div class="right-panel">
			<div class="page-title">
				<a href="students.php"><button class="back-button"><img src="../../images/back.png"></button></a>
				<p>Edit class of <?php echo $_POST['sectionName']?></p>
			</div>
			<div class="main-container">
				<form method="post" action="includes/edit-class.inc.php">
					<div class="section-time">
						<p>Edit class's date, time, type and place</p>
						<div class="error1">
							<?php
							if (isset($_GET['error'])) {
								if ($_GET['error'] == 'neglen') {
									echo "<p>Class duration has to between 1 to 3 hours</p>";
								}
								if ($_GET['error'] == 'minlen1h') {
									echo "<p>Class duration has to between 1 to 3 hours</p>";
								}
								if ($_GET['error'] == 'maxlen3h') {
									echo "<p>Class duration has to between 1 to 3 hours</p>";
								}
								if ($_GET['error'] == 'sqlerror') {
									echo "<p>Your request could not be processed!</p>";
								}
							}
							?>
						</div>	
						Date: <input type="date" name="class-date" max='<?php echo date("Y\-m\-d", strtotime("+1 year"))?>' value='<?php echo $cDate?>'>
						from <select name="start-time">
							<option value="0" <?php if ( $st1 == 0 ) echo 'selected' ; ?> >8:00</option>
							<option value="1" <?php if ( $st1 == 1 ) echo 'selected' ; ?> >8:30</option>
							<option value="2" <?php if ( $st1 == 2 ) echo 'selected' ; ?> >9:00</option>
							<option value="3" <?php if ( $st1 == 3 ) echo 'selected' ; ?> >9:30</option>
							<option value="4" <?php if ( $st1 == 4 ) echo 'selected' ; ?> >10:00</option>
							<option value="5" <?php if ( $st1 == 5 ) echo 'selected' ; ?> >10:30</option>
							<option value="6" <?php if ( $st1 == 6 ) echo 'selected' ; ?> >11:00</option>
							<option value="7" <?php if ( $st1 == 7 ) echo 'selected' ; ?> >11:30</option>
							<option value="8" <?php if ( $st1 == 8 ) echo 'selected' ; ?> >12:00</option>
							<option value="9" <?php if ( $st1 == 9 ) echo 'selected' ; ?> >12:30</option>
							<option value="10" <?php if ( $st1 == 10 ) echo 'selected' ; ?> >1:00</option>
							<option value="11" <?php if ( $st1 == 11 ) echo 'selected' ; ?> >1:30</option>
							<option value="12" <?php if ( $st1 == 12 ) echo 'selected' ; ?> >2:00</option>
							<option value="13" <?php if ( $st1 == 13 ) echo 'selected' ; ?> >2:30</option>
							<option value="14" <?php if ( $st1 == 14 ) echo 'selected' ; ?> >3:00</option>
							<option value="15" <?php if ( $st1 == 15 ) echo 'selected' ; ?> >3:30</option>
							<option value="16" <?php if ( $st1 == 16 ) echo 'selected' ; ?> >4:00</option>
							<option value="17" <?php if ( $st1 == 17 ) echo 'selected' ; ?> >4:30</option>
							<option value="18" <?php if ( $st1 == 18 ) echo 'selected' ; ?> >5:00</option>
							<option value="19" <?php if ( $st1 == 19 ) echo 'selected' ; ?> >5:30</option>
							<option value="20" <?php if ( $st1 == 20 ) echo 'selected' ; ?> >6:00</option>
							<option value="21" <?php if ( $st1 == 21 ) echo 'selected' ; ?> >6:30</option>
							<option value="22" <?php if ( $st1 == 22 ) echo 'selected' ; ?> >7:00</option>
							<option value="23" <?php if ( $st1 == 23 ) echo 'selected' ; ?> >7:30</option>
							<option value="24" <?php if ( $st1 == 24 ) echo 'selected' ; ?> >8:00</option>
						</select>
						to <select name="end-time">
							<option value="0" <?php if ( $et1 == 0 ) echo 'selected' ; ?> >8:00</option>
							<option value="1" <?php if ( $et1 == 1 ) echo 'selected' ; ?> >8:30</option>
							<option value="2" <?php if ( $et1 == 2 ) echo 'selected' ; ?> >9:00</option>
							<option value="3" <?php if ( $et1 == 3 ) echo 'selected' ; ?> >9:30</option>
							<option value="4" <?php if ( $et1 == 4 ) echo 'selected' ; ?> >10:00</option>
							<option value="5" <?php if ( $et1 == 5 ) echo 'selected' ; ?> >10:30</option>
							<option value="6" <?php if ( $et1 == 6 ) echo 'selected' ; ?> >11:00</option>
							<option value="7" <?php if ( $et1 == 7 ) echo 'selected' ; ?> >11:30</option>
							<option value="8" <?php if ( $et1 == 8 ) echo 'selected' ; ?> >12:00</option>
							<option value="9" <?php if ( $et1 == 9 ) echo 'selected' ; ?> >12:30</option>
							<option value="10" <?php if ( $et1 == 10 ) echo 'selected' ; ?> >1:00</option>
							<option value="11" <?php if ( $et1 == 11 ) echo 'selected' ; ?> >1:30</option>
							<option value="12" <?php if ( $et1 == 12 ) echo 'selected' ; ?> >2:00</option>
							<option value="13" <?php if ( $et1 == 13 ) echo 'selected' ; ?> >2:30</option>
							<option value="14" <?php if ( $et1 == 14 ) echo 'selected' ; ?> >3:00</option>
							<option value="15" <?php if ( $et1 == 15 ) echo 'selected' ; ?> >3:30</option>
							<option value="16" <?php if ( $et1 == 16 ) echo 'selected' ; ?> >4:00</option>
							<option value="17" <?php if ( $et1 == 17 ) echo 'selected' ; ?> >4:30</option>
							<option value="18" <?php if ( $et1 == 18 ) echo 'selected' ; ?> >5:00</option>
							<option value="19" <?php if ( $et1 == 19 ) echo 'selected' ; ?> >5:30</option>
							<option value="20" <?php if ( $et1 == 20 ) echo 'selected' ; ?> >6:00</option>
							<option value="21" <?php if ( $et1 == 21 ) echo 'selected' ; ?> >6:30</option>
							<option value="22" <?php if ( $et1 == 22 ) echo 'selected' ; ?> >7:00</option>
							<option value="23" <?php if ( $et1 == 23 ) echo 'selected' ; ?> >7:30</option>
							<option value="24" <?php if ( $et1 == 24 ) echo 'selected' ; ?> >8:00</option>
						</select>
						<br>
						Class Type:
						<input type="radio" id="lab" name="class-type" value="0" <?php if ( $ct1 == 0 ) echo 'checked = "true"' ; ?> >
						<label for="lab">Lab</label>
						<input type="radio" id="theory" name="class-type" value="1" <?php if ( $ct1 == 1 ) echo 'checked = "true"' ; ?> >
						<label for="theory">Theory</label>
						<br>
						Room: <input type="text" name="room" placeholder="i.e. 1115/D0203" required="" value="<?php echo $room1; ?>">
					</div>
					<input type="hidden" name="sectionId" value="<?php echo $sectionId;?>">
					<input type="hidden" name="sectionName" value="<?php echo $sectionName;?>">
					<input type="hidden" name="classId" value="<?php echo $classId;?>">
					<div class="buttons">
						<input type="submit" name="submit" value="Save" class="save-button">
					</div>
				</form>
				<div class="button-delete">
					<form method="post" action="includes/delete-class.inc.php" id="deleteForm" onsubmit="return confirm('Are your sure you want to delete this class? All attendance data will be deleted pemanently!')">
						<input type="hidden" name="sectionId" value="<?php echo $sectionId;?>">
						<input type="hidden" name="sectionName" value="<?php echo $sectionName;?>">
						<input type="hidden" name="classId" value="<?php echo $classId;?>">
						<input type="submit" name="submit" value="Delete"/>
					</form>
				</div>	
			</div>
		</div>
	</body>
	</html>	