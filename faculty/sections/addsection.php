<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
}
else{
	header("Location: ../login.php?error=nosession");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Faculty - Create Section</title>
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
				<p>Add Section</p>
			</div>
			<div class="main-container">
				<form method="post" action="includes/create-section.inc.php" id="create-section-form">
					
					<div class="section-name-div">
						Section Name: <input type="text" name="section-name" placeholder="i.e.: WEB TECHNOLOGIES [A]" required title="Please use this format for section name: Course[X]" pattern="^[a-zA-Z0-9 _]+\[[A-Z]\]$" value="<?php echo(isset($_GET['name']))?$_GET['name']:''?>">
					</div>
					<div class="section-time">
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
							<option value="0" <?php if (isset($_GET['wd1']) && $_GET['wd1'] == 0 ) echo 'selected' ; ?> >Sunday</option>
							<option value="1" <?php if (isset($_GET['wd1']) && $_GET['wd1'] == 1 ) echo 'selected' ; ?> >Monday</option>
							<option value="2" <?php if (isset($_GET['wd1']) && $_GET['wd1'] == 2 ) echo 'selected' ; ?> >Tuesday</option>
							<option value="3" <?php if (isset($_GET['wd1']) && $_GET['wd1'] == 3 ) echo 'selected' ; ?> >Wednesday</option>
							<option value="4" <?php if (isset($_GET['wd1']) && $_GET['wd1'] == 4 ) echo 'selected' ; ?> >Thursday</option>
						</select>
						from <select name="start-time-1">
							<option value="0" <?php if (isset($_GET['st1']) && $_GET['st1'] == 0 ) echo 'selected' ; ?> >8:00</option>
							<option value="1" <?php if (isset($_GET['st1']) && $_GET['st1'] == 1 ) echo 'selected' ; ?> >8:30</option>
							<option value="2" <?php if (isset($_GET['st1']) && $_GET['st1'] == 2 ) echo 'selected' ; ?> >9:00</option>
							<option value="3" <?php if (isset($_GET['st1']) && $_GET['st1'] == 3 ) echo 'selected' ; ?> >9:30</option>
							<option value="4" <?php if (isset($_GET['st1']) && $_GET['st1'] == 4 ) echo 'selected' ; ?> >10:00</option>
							<option value="5" <?php if (isset($_GET['st1']) && $_GET['st1'] == 5 ) echo 'selected' ; ?> >10:30</option>
							<option value="6" <?php if (isset($_GET['st1']) && $_GET['st1'] == 6 ) echo 'selected' ; ?> >11:00</option>
							<option value="7" <?php if (isset($_GET['st1']) && $_GET['st1'] == 7 ) echo 'selected' ; ?> >11:30</option>
							<option value="8" <?php if (isset($_GET['st1']) && $_GET['st1'] == 8 ) echo 'selected' ; ?> >12:00</option>
							<option value="9" <?php if (isset($_GET['st1']) && $_GET['st1'] == 9 ) echo 'selected' ; ?> >12:30</option>
							<option value="10" <?php if (isset($_GET['st1']) && $_GET['st1'] == 10 ) echo 'selected' ; ?> >1:00</option>
							<option value="11" <?php if (isset($_GET['st1']) && $_GET['st1'] == 11 ) echo 'selected' ; ?> >1:30</option>
							<option value="12" <?php if (isset($_GET['st1']) && $_GET['st1'] == 12 ) echo 'selected' ; ?> >2:00</option>
							<option value="13" <?php if (isset($_GET['st1']) && $_GET['st1'] == 13 ) echo 'selected' ; ?> >2:30</option>
							<option value="14" <?php if (isset($_GET['st1']) && $_GET['st1'] == 14 ) echo 'selected' ; ?> >3:00</option>
							<option value="15" <?php if (isset($_GET['st1']) && $_GET['st1'] == 15 ) echo 'selected' ; ?> >3:30</option>
							<option value="16" <?php if (isset($_GET['st1']) && $_GET['st1'] == 16 ) echo 'selected' ; ?> >4:00</option>
							<option value="17" <?php if (isset($_GET['st1']) && $_GET['st1'] == 17 ) echo 'selected' ; ?> >4:30</option>
							<option value="18" <?php if (isset($_GET['st1']) && $_GET['st1'] == 18 ) echo 'selected' ; ?> >5:00</option>
							<option value="19" <?php if (isset($_GET['st1']) && $_GET['st1'] == 19 ) echo 'selected' ; ?> >5:30</option>
							<option value="20" <?php if (isset($_GET['st1']) && $_GET['st1'] == 20 ) echo 'selected' ; ?> >6:00</option>
							<option value="21" <?php if (isset($_GET['st1']) && $_GET['st1'] == 21 ) echo 'selected' ; ?> >6:30</option>
							<option value="22" <?php if (isset($_GET['st1']) && $_GET['st1'] == 22 ) echo 'selected' ; ?> >7:00</option>
							<option value="23" <?php if (isset($_GET['st1']) && $_GET['st1'] == 23 ) echo 'selected' ; ?> >7:30</option>
							<option value="24" <?php if (isset($_GET['st1']) && $_GET['st1'] == 24 ) echo 'selected' ; ?> >8:00</option>
						</select>
						to <select name="end-time-1">
							<option value="0" <?php if (isset($_GET['et1']) && $_GET['et1'] == 0 ) echo 'selected' ; ?> >8:00</option>
							<option value="1" <?php if (isset($_GET['et1']) && $_GET['et1'] == 1 ) echo 'selected' ; ?> >8:30</option>
							<option value="2" <?php if (isset($_GET['et1']) && $_GET['et1'] == 2 ) echo 'selected' ; ?> >9:00</option>
							<option value="3" <?php if (isset($_GET['et1']) && $_GET['et1'] == 3 ) echo 'selected' ; ?> >9:30</option>
							<option value="4" <?php if (isset($_GET['et1']) && $_GET['et1'] == 4 ) echo 'selected' ; ?> >10:00</option>
							<option value="5" <?php if (isset($_GET['et1']) && $_GET['et1'] == 5 ) echo 'selected' ; ?> >10:30</option>
							<option value="6" <?php if (isset($_GET['et1']) && $_GET['et1'] == 6 ) echo 'selected' ; ?> >11:00</option>
							<option value="7" <?php if (isset($_GET['et1']) && $_GET['et1'] == 7 ) echo 'selected' ; ?> >11:30</option>
							<option value="8" <?php if (isset($_GET['et1']) && $_GET['et1'] == 8 ) echo 'selected' ; ?> >12:00</option>
							<option value="9" <?php if (isset($_GET['et1']) && $_GET['et1'] == 9 ) echo 'selected' ; ?> >12:30</option>
							<option value="10" <?php if (isset($_GET['et1']) && $_GET['et1'] == 10 ) echo 'selected' ; ?> >1:00</option>
							<option value="11" <?php if (isset($_GET['et1']) && $_GET['et1'] == 11 ) echo 'selected' ; ?> >1:30</option>
							<option value="12" <?php if (isset($_GET['et1']) && $_GET['et1'] == 12 ) echo 'selected' ; ?> >2:00</option>
							<option value="13" <?php if (isset($_GET['et1']) && $_GET['et1'] == 13 ) echo 'selected' ; ?> >2:30</option>
							<option value="14" <?php if (isset($_GET['et1']) && $_GET['et1'] == 14 ) echo 'selected' ; ?> >3:00</option>
							<option value="15" <?php if (isset($_GET['et1']) && $_GET['et1'] == 15 ) echo 'selected' ; ?> >3:30</option>
							<option value="16" <?php if (isset($_GET['et1']) && $_GET['et1'] == 16 ) echo 'selected' ; ?> >4:00</option>
							<option value="17" <?php if (isset($_GET['et1']) && $_GET['et1'] == 17 ) echo 'selected' ; ?> >4:30</option>
							<option value="18" <?php if (isset($_GET['et1']) && $_GET['et1'] == 18 ) echo 'selected' ; ?> >5:00</option>
							<option value="19" <?php if (isset($_GET['et1']) && $_GET['et1'] == 19 ) echo 'selected' ; ?> >5:30</option>
							<option value="20" <?php if (isset($_GET['et1']) && $_GET['et1'] == 20 ) echo 'selected' ; ?> >6:00</option>
							<option value="21" <?php if (isset($_GET['et1']) && $_GET['et1'] == 21 ) echo 'selected' ; ?> >6:30</option>
							<option value="22" <?php if (isset($_GET['et1']) && $_GET['et1'] == 22 ) echo 'selected' ; ?> >7:00</option>
							<option value="23" <?php if (isset($_GET['et1']) && $_GET['et1'] == 23 ) echo 'selected' ; ?> >7:30</option>
							<option value="24" <?php if (isset($_GET['et1']) && $_GET['st1'] == 24 ) echo 'selected' ; ?> >8:00</option>
						</select>
						<br>
						Class Type:
						<input type="radio" id="lab" name="class-type-1" value="0" <?php if (isset($_GET['ct1']) && $_GET['ct1'] == 0 ) echo 'checked = "true"' ; else if(!isset($_GET['ct1'])) echo 'checked="true"'; ?> >
						<label for="lab">Lab</label>
						<input type="radio" id="theory" name="class-type-1" value="1" <?php if (isset($_GET['ct1']) && $_GET['ct1'] == 1 ) echo 'checked = "true"' ; ?> >
						<label for="theory">Theory</label>
						<br>
						Room: <input type="text" name="room-1" placeholder="i.e. 1115/D0203" required="" value="<?php echo(isset($_GET['r1']))?$_GET['r1']:''?>">
					</div>
					<div class="one-class">
						Select if this section has only one class per week (Section time 2 will be ignored) <input type="checkbox" name="one-class" value="1">
					</div>
					<div class="section-time">
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
							<option value="0" <?php if (isset($_GET['wd2']) && $_GET['wd2'] == 0 ) echo 'selected' ; ?> >Sunday</option>
							<option value="1" <?php if (isset($_GET['wd2']) && $_GET['wd2'] == 1 ) echo 'selected' ; ?> >Monday</option>
							<option value="2" <?php if (isset($_GET['wd2']) && $_GET['wd2'] == 2 ) echo 'selected' ; ?> >Tuesday</option>
							<option value="3" <?php if (isset($_GET['wd2']) && $_GET['wd2'] == 3 ) echo 'selected' ; ?> >Wednesday</option>
							<option value="4" <?php if (isset($_GET['wd2']) && $_GET['wd2'] == 4 ) echo 'selected' ; ?> >Thursday</option>
						</select>
						from <select name="start-time-2">
							<option value="0" <?php if (isset($_GET['st2']) && $_GET['st2'] == 0 ) echo 'selected' ; ?> >8:00</option>
							<option value="1" <?php if (isset($_GET['st2']) && $_GET['st2'] == 1 ) echo 'selected' ; ?> >8:30</option>
							<option value="2" <?php if (isset($_GET['st2']) && $_GET['st2'] == 2 ) echo 'selected' ; ?> >9:00</option>
							<option value="3" <?php if (isset($_GET['st2']) && $_GET['st2'] == 3 ) echo 'selected' ; ?> >9:30</option>
							<option value="4" <?php if (isset($_GET['st2']) && $_GET['st2'] == 4 ) echo 'selected' ; ?> >10:00</option>
							<option value="5" <?php if (isset($_GET['st2']) && $_GET['st2'] == 5 ) echo 'selected' ; ?> >10:30</option>
							<option value="6" <?php if (isset($_GET['st2']) && $_GET['st2'] == 6 ) echo 'selected' ; ?> >11:00</option>
							<option value="7" <?php if (isset($_GET['st2']) && $_GET['st2'] == 7 ) echo 'selected' ; ?> >11:30</option>
							<option value="8" <?php if (isset($_GET['st2']) && $_GET['st2'] == 8 ) echo 'selected' ; ?> >12:00</option>
							<option value="9" <?php if (isset($_GET['st2']) && $_GET['st2'] == 9 ) echo 'selected' ; ?> >12:30</option>
							<option value="10" <?php if (isset($_GET['st2']) && $_GET['st2'] == 10 ) echo 'selected' ; ?> >1:00</option>
							<option value="11" <?php if (isset($_GET['st2']) && $_GET['st2'] == 11 ) echo 'selected' ; ?> >1:30</option>
							<option value="12" <?php if (isset($_GET['st2']) && $_GET['st2'] == 12 ) echo 'selected' ; ?> >2:00</option>
							<option value="13" <?php if (isset($_GET['st2']) && $_GET['st2'] == 13 ) echo 'selected' ; ?> >2:30</option>
							<option value="14" <?php if (isset($_GET['st2']) && $_GET['st2'] == 14 ) echo 'selected' ; ?> >3:00</option>
							<option value="15" <?php if (isset($_GET['st2']) && $_GET['st2'] == 15 ) echo 'selected' ; ?> >3:30</option>
							<option value="16" <?php if (isset($_GET['st2']) && $_GET['st2'] == 16 ) echo 'selected' ; ?> >4:00</option>
							<option value="17" <?php if (isset($_GET['st2']) && $_GET['st2'] == 17 ) echo 'selected' ; ?> >4:30</option>
							<option value="18" <?php if (isset($_GET['st2']) && $_GET['st2'] == 18 ) echo 'selected' ; ?> >5:00</option>
							<option value="19" <?php if (isset($_GET['st2']) && $_GET['st2'] == 19 ) echo 'selected' ; ?> >5:30</option>
							<option value="20" <?php if (isset($_GET['st2']) && $_GET['st2'] == 20 ) echo 'selected' ; ?> >6:00</option>
							<option value="21" <?php if (isset($_GET['st2']) && $_GET['st2'] == 21 ) echo 'selected' ; ?> >6:30</option>
							<option value="22" <?php if (isset($_GET['st2']) && $_GET['st2'] == 22 ) echo 'selected' ; ?> >7:00</option>
							<option value="23" <?php if (isset($_GET['st2']) && $_GET['st2'] == 23 ) echo 'selected' ; ?> >7:30</option>
							<option value="24" <?php if (isset($_GET['st2']) && $_GET['st2'] == 24 ) echo 'selected' ; ?> >8:00</option>
						</select>
						to <select name="end-time-2">
							<option value="0" <?php if (isset($_GET['et2']) && $_GET['et2'] == 0 ) echo 'selected' ; ?> >8:00</option>
							<option value="1" <?php if (isset($_GET['et2']) && $_GET['et2'] == 1 ) echo 'selected' ; ?> >8:30</option>
							<option value="2" <?php if (isset($_GET['et2']) && $_GET['et2'] == 2 ) echo 'selected' ; ?> >9:00</option>
							<option value="3" <?php if (isset($_GET['et2']) && $_GET['et2'] == 3 ) echo 'selected' ; ?> >9:30</option>
							<option value="4" <?php if (isset($_GET['et2']) && $_GET['et2'] == 4 ) echo 'selected' ; ?> >10:00</option>
							<option value="5" <?php if (isset($_GET['et2']) && $_GET['et2'] == 5 ) echo 'selected' ; ?> >10:30</option>
							<option value="6" <?php if (isset($_GET['et2']) && $_GET['et2'] == 6 ) echo 'selected' ; ?> >11:00</option>
							<option value="7" <?php if (isset($_GET['et2']) && $_GET['et2'] == 7 ) echo 'selected' ; ?> >11:30</option>
							<option value="8" <?php if (isset($_GET['et2']) && $_GET['et2'] == 8 ) echo 'selected' ; ?> >12:00</option>
							<option value="9" <?php if (isset($_GET['et2']) && $_GET['et2'] == 9 ) echo 'selected' ; ?> >12:30</option>
							<option value="10" <?php if (isset($_GET['et2']) && $_GET['et2'] == 10 ) echo 'selected' ; ?> >1:00</option>
							<option value="11" <?php if (isset($_GET['et2']) && $_GET['et2'] == 11 ) echo 'selected' ; ?> >1:30</option>
							<option value="12" <?php if (isset($_GET['et2']) && $_GET['et2'] == 12 ) echo 'selected' ; ?> >2:00</option>
							<option value="13" <?php if (isset($_GET['et2']) && $_GET['et2'] == 13 ) echo 'selected' ; ?> >2:30</option>
							<option value="14" <?php if (isset($_GET['et2']) && $_GET['et2'] == 14 ) echo 'selected' ; ?> >3:00</option>
							<option value="15" <?php if (isset($_GET['et2']) && $_GET['et2'] == 15 ) echo 'selected' ; ?> >3:30</option>
							<option value="16" <?php if (isset($_GET['et2']) && $_GET['et2'] == 16 ) echo 'selected' ; ?> >4:00</option>
							<option value="17" <?php if (isset($_GET['et2']) && $_GET['et2'] == 17 ) echo 'selected' ; ?> >4:30</option>
							<option value="18" <?php if (isset($_GET['et2']) && $_GET['et2'] == 18 ) echo 'selected' ; ?> >5:00</option>
							<option value="19" <?php if (isset($_GET['et2']) && $_GET['et2'] == 19 ) echo 'selected' ; ?> >5:30</option>
							<option value="20" <?php if (isset($_GET['et2']) && $_GET['et2'] == 20 ) echo 'selected' ; ?> >6:00</option>
							<option value="21" <?php if (isset($_GET['et2']) && $_GET['et2'] == 21 ) echo 'selected' ; ?> >6:30</option>
							<option value="22" <?php if (isset($_GET['et2']) && $_GET['et2'] == 22 ) echo 'selected' ; ?> >7:00</option>
							<option value="23" <?php if (isset($_GET['et2']) && $_GET['et2'] == 23 ) echo 'selected' ; ?> >7:30</option>
							<option value="24" <?php if (isset($_GET['et2']) && $_GET['et1'] == 24 ) echo 'selected' ; ?> >8:00</option>
						</select>
						<br>
						Class Type: <input type="radio" id="lab" name="class-type-2" value="0" <?php if (isset($_GET['ct2']) && $_GET['ct2'] == 0 ) echo 'checked = "true"' ; else if(!isset($_GET['ct2'])) echo 'checked="true"'; ?> >
						<label for="lab">Lab</label>
						<input type="radio" id="theory" name="class-type-2" value="1" <?php if (isset($_GET['ct2']) && $_GET['ct2'] == 1 ) echo 'checked = "true"' ; ?> >
						<label for="theory">Theory</label><br>
						Room: <input type="text" name="room-2" placeholder="i.e. 1115/D0203" value="<?php echo(isset($_GET['r2']))?$_GET['r2']:''?>">
					</div>
					<div class="buttons">
						<input type="submit" name="submit" value="Create">
					</div>
				</form>
			</div>
		</div>
	</body>
	</html>