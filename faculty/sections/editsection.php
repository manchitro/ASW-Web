<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if (isset($_SESSION['sectionId']) && isset($_SESSION['sectionName'])) {
		$_POST['sectionId'] = $_SESSION['sectionId'];
		$_POST['sectionName'] = $_SESSION['sectionName'];
	}
	if(isset($_POST['sectionId']) && $_POST['sectionId'] !== ""){
		require '../../includes/dbh.inc.php';

		$sectionId = $_POST['sectionId'];
		$sectionName = $_POST['sectionName'];

		$sql2 = "SELECT * FROM sectionTimes WHERE sectionId = ?;";
		$stmt2 = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt2, $sql2)){
			echo '<p class="error-msg">Error retrieving your data. Please go back and try again!</p>';
		}
		else{
			mysqli_stmt_bind_param($stmt2, "s", $sectionId);
			mysqli_stmt_execute($stmt2);
			mysqli_stmt_store_result($stmt2);
			mysqli_stmt_bind_result($stmt2, $sectionTimeId, $startTimeId, $endTimeId, $weekDayId, $classType, $room, $sectionId, $createdAt);
			if(mysqli_stmt_num_rows($stmt2) == 0){
				echo "<p>Error: No section time found</p>";
			}
			else{
				//record section time 1
				if(mysqli_stmt_fetch($stmt2)){
					$time1id = $sectionTimeId;
					$st1 = $startTimeId;
					$et1 = $endTimeId;
					$wt1 = $weekDayId;
					$ct1 = $classType;
					$room1 = $room;
				}
				else{
					$time1id = -1;
					$st1 = 0;
					$et1 = 0;
					$wt1 = 0;
					$ct1 = 0;
					$room1 = "";
				}

				//record section time 2
				if(mysqli_stmt_fetch($stmt2)){
					$time2id = $sectionTimeId;
					$st2 = $startTimeId;
					$et2 = $endTimeId;
					$wt2 = $weekDayId;
					$ct2 = $classType;
					$room2 = $room;

					$oneClass = false;
				}
				else{
					$time2id = -1;
					$st2 = 0;
					$et2 = 0;
					$wt2 = 0;
					$ct2 = 0;
					$room2 = "";

					$oneClass = true;
				}
			}
		}
		mysqli_stmt_close($stmt2);
		mysqli_close($conn);
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

include 'values.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Faculty - Edit Section</title>
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
				<a href="sections.php"><button class="back-button"><img src="../../images/back.png"></button></a>
				<?php  echo '<p>Edit Section - '.$sectionName.'</p>'?>
			</div>
			<div class="main-container">
				<form method="post" action="includes/edit-section.inc.php" id="edit-section-form">

					<div class="section-name-div">
						Section Name: <input type="text" name="section-name" placeholder="i.e.: WEB TECHNOLOGIES [A]" required title="Please use this format for section name: Course[X]" pattern="^[a-zA-Z0-9 _]+\[[A-Z]\]$" value="<?php echo $sectionName?>">
						<input type="hidden" name="section-id" value="<?php echo $sectionId; ?>">
						<input type="hidden" name="one-class" value="<?php echo $oneClass; ?>">
					</div>
					<div class="section-time">
						<input type="hidden" name="section-time-1-id" value="<?php echo $time1id; ?>">
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
						<p>Section Time 1 (first class of the week)</p>
						Weekday: <select name="weekday-1">
							<option value="0" <?php if ( $wt1 == 0 ) echo 'selected' ; ?> >Sunday</option>
							<option value="1" <?php if ( $wt1 == 1 ) echo 'selected' ; ?> >Monday</option>
							<option value="2" <?php if ( $wt1 == 2 ) echo 'selected' ; ?> >Tuesday</option>
							<option value="3" <?php if ( $wt1 == 3 ) echo 'selected' ; ?> >Wednesday</option>
							<option value="4" <?php if ( $wt1 == 4 ) echo 'selected' ; ?> >Thursday</option>
						</select>
						from <select name="start-time-1">
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
						to <select name="end-time-1">
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
						<input type="radio" id="lab" name="class-type-1" value="0" <?php if ( $ct1 == 0 ) echo 'checked = "true"' ; ?> >
						<label for="lab">Lab</label>
						<input type="radio" id="theory" name="class-type-1" value="1" <?php if ( $ct1 == 1 ) echo 'checked = "true"' ; ?> >
						<label for="theory">Theory</label>
						<br>
						Room: <input type="text" name="room-1" placeholder="i.e. 1115/D0203" required="" value="<?php echo $room1; ?>">
					</div>
					<div class="section-time" <?php if($oneClass==true) echo 'style="display:none;"';?>>
						<input type="hidden" name="section-time-2-id" value="<?php echo $time2id; ?>">
						<div class="error1">
							<?php
							if (isset($_GET['error'])) {
								if ($_GET['error'] == 'neglen2') {
									echo "<p>Class duration has to between 1 to 3 hours</p>";
								}
								if ($_GET['error'] == 'minlen1h2') {
									echo "<p>Class duration has to between 1 to 3 hours</p>";
								}
								if ($_GET['error'] == 'maxlen3h2') {
									echo "<p>Class duration has to between 1 to 3 hours</p>";
								}
								if ($_GET['error'] == 'noroom') {
									echo "<p>Please insert Room!</p>";
								}
								if ($_GET['error'] == 'sameday') {
									echo "<p>Classes cannot be on the same day!</p>";
								}
							}
							?>
						</div>
						<p>Section Time 2 (second class of the week)</p>
						Weekday: <select name="weekday-2">
							<option value="0" <?php if ( $wt2 == 0 ) echo 'selected' ; ?> >Sunday</option>
							<option value="1" <?php if ( $wt2 == 1 ) echo 'selected' ; ?> >Monday</option>
							<option value="2" <?php if ( $wt2 == 2 ) echo 'selected' ; ?> >Tuesday</option>
							<option value="3" <?php if ( $wt2 == 3 ) echo 'selected' ; ?> >Wednesday</option>
							<option value="4" <?php if ( $wt2 == 4 ) echo 'selected' ; ?> >Thursday</option>
						</select>
						from <select name="start-time-2">
							<option value="0" <?php if ( $st2 == 0 ) echo 'selected' ; ?> >8:00</option>
							<option value="1" <?php if ( $st2 == 1 ) echo 'selected' ; ?> >8:30</option>
							<option value="2" <?php if ( $st2 == 2 ) echo 'selected' ; ?> >9:00</option>
							<option value="3" <?php if ( $st2 == 3 ) echo 'selected' ; ?> >9:30</option>
							<option value="4" <?php if ( $st2 == 4 ) echo 'selected' ; ?> >10:00</option>
							<option value="5" <?php if ( $st2 == 5 ) echo 'selected' ; ?> >10:30</option>
							<option value="6" <?php if ( $st2 == 6 ) echo 'selected' ; ?> >11:00</option>
							<option value="7" <?php if ( $st2 == 7 ) echo 'selected' ; ?> >11:30</option>
							<option value="8" <?php if ( $st2 == 8 ) echo 'selected' ; ?> >12:00</option>
							<option value="9" <?php if ( $st2 == 9 ) echo 'selected' ; ?> >12:30</option>
							<option value="10" <?php if ( $st2 == 10 ) echo 'selected' ; ?> >1:00</option>
							<option value="11" <?php if ( $st2 == 11 ) echo 'selected' ; ?> >1:30</option>
							<option value="12" <?php if ( $st2 == 12 ) echo 'selected' ; ?> >2:00</option>
							<option value="13" <?php if ( $st2 == 13 ) echo 'selected' ; ?> >2:30</option>
							<option value="14" <?php if ( $st2 == 14 ) echo 'selected' ; ?> >3:00</option>
							<option value="15" <?php if ( $st2 == 15 ) echo 'selected' ; ?> >3:30</option>
							<option value="16" <?php if ( $st2 == 16 ) echo 'selected' ; ?> >4:00</option>
							<option value="17" <?php if ( $st2 == 17 ) echo 'selected' ; ?> >4:30</option>
							<option value="18" <?php if ( $st2 == 18 ) echo 'selected' ; ?> >5:00</option>
							<option value="19" <?php if ( $st2 == 19 ) echo 'selected' ; ?> >5:30</option>
							<option value="20" <?php if ( $st2 == 20 ) echo 'selected' ; ?> >6:00</option>
							<option value="21" <?php if ( $st2 == 21 ) echo 'selected' ; ?> >6:30</option>
							<option value="22" <?php if ( $st2 == 22 ) echo 'selected' ; ?> >7:00</option>
							<option value="23" <?php if ( $st2 == 23 ) echo 'selected' ; ?> >7:30</option>
							<option value="24" <?php if ( $st2 == 24 ) echo 'selected' ; ?> >8:00</option>
						</select>
						to <select name="end-time-2">
							<option value="0" <?php if ( $et2 == 0 ) echo 'selected' ; ?> >8:00</option>
							<option value="1" <?php if ( $et2 == 1 ) echo 'selected' ; ?> >8:30</option>
							<option value="2" <?php if ( $et2 == 2 ) echo 'selected' ; ?> >9:00</option>
							<option value="3" <?php if ( $et2 == 3 ) echo 'selected' ; ?> >9:30</option>
							<option value="4" <?php if ( $et2 == 4 ) echo 'selected' ; ?> >10:00</option>
							<option value="5" <?php if ( $et2 == 5 ) echo 'selected' ; ?> >10:30</option>
							<option value="6" <?php if ( $et2 == 6 ) echo 'selected' ; ?> >11:00</option>
							<option value="7" <?php if ( $et2 == 7 ) echo 'selected' ; ?> >11:30</option>
							<option value="8" <?php if ( $et2 == 8 ) echo 'selected' ; ?> >12:00</option>
							<option value="9" <?php if ( $et2 == 9 ) echo 'selected' ; ?> >12:30</option>
							<option value="10" <?php if ( $et2 == 10 ) echo 'selected' ; ?> >1:00</option>
							<option value="11" <?php if ( $et2 == 11 ) echo 'selected' ; ?> >1:30</option>
							<option value="12" <?php if ( $et2 == 12 ) echo 'selected' ; ?> >2:00</option>
							<option value="13" <?php if ( $et2 == 13 ) echo 'selected' ; ?> >2:30</option>
							<option value="14" <?php if ( $et2 == 14 ) echo 'selected' ; ?> >3:00</option>
							<option value="15" <?php if ( $et2 == 15 ) echo 'selected' ; ?> >3:30</option>
							<option value="16" <?php if ( $et2 == 16 ) echo 'selected' ; ?> >4:00</option>
							<option value="17" <?php if ( $et2 == 17 ) echo 'selected' ; ?> >4:30</option>
							<option value="18" <?php if ( $et2 == 18 ) echo 'selected' ; ?> >5:00</option>
							<option value="19" <?php if ( $et2 == 19 ) echo 'selected' ; ?> >5:30</option>
							<option value="20" <?php if ( $et2 == 20 ) echo 'selected' ; ?> >6:00</option>
							<option value="21" <?php if ( $et2 == 21 ) echo 'selected' ; ?> >6:30</option>
							<option value="22" <?php if ( $et2 == 22 ) echo 'selected' ; ?> >7:00</option>
							<option value="23" <?php if ( $et2 == 23 ) echo 'selected' ; ?> >7:30</option>
							<option value="24" <?php if ( $et2 == 24 ) echo 'selected' ; ?> >8:00</option>
						</select>
						<br>
						Class Type:
						<input type="radio" id="lab" name="class-type-2" value="0" <?php if ( $ct2 == 0 ) echo 'checked = "true"' ; ?> >
						<label for="lab">Lab</label>
						<input type="radio" id="theory" name="class-type-2" value="1" <?php if ( $ct2 == 1 ) echo 'checked = "true"' ; ?> >
						<label for="theory">Theory</label>
						<br>
						Room: <input type="text" name="room-2" placeholder="i.e. 1115/D0203" <?php if($oneClass==false) echo 'required';?> value="<?php echo $room2; ?>">
					</div>
					<div class="buttons">
						<input type="submit" name="submit" value="Save" class="save-button">
					</div>
				</form>
				<div class="button-delete">
					<form method="post" action="includes/delete-section.inc.php" id="deleteForm" onsubmit="return confirm('Are your sure you want to delete this section? All attendance and student data will be deleted pemanently!')">
						<input type="hidden" name="section-id" value="<?php echo $sectionId;?>">
						<input type="hidden" name="section-name" value="<?php echo $sectionName;?>">
						<input type="submit" name="submit" value="Delete"/>
					</form>
				</div>
			</div>
		</div>
	</body>
	</html>