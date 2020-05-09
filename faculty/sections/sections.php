<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	unset($_SESSION['sectionId']);
	unset($_SESSION['sectionName']);
}
else{
	header("Location: ../../login.php?error=nosession");
	exit();
}

$weekday['0']='Sunday';
$weekday['1']='Monday';
$weekday['2']='Tuesday';
$weekday['3']='Wednesday';
$weekday['4']='Thursday';
$weekday['5']='Friday';
$weekday['6']='Saturday';

$classtime['0']='8:00';
$classtime['1']='8:30';
$classtime['2']='9:00';
$classtime['3']='9:30';
$classtime['4']='10:00';
$classtime['5']='10:30';
$classtime['6']='11:00';
$classtime['7']='11:30';
$classtime['8']='12:00';
$classtime['9']='12:30';
$classtime['10']='1:00';
$classtime['11']='1:30';
$classtime['12']='2:00';
$classtime['13']='2:30';
$classtime['14']='3:00';
$classtime['15']='3:30';
$classtime['16']='4:00';
$classtime['17']='4:30';
$classtime['18']='5:00';
$classtime['19']='5:30';
$classtime['20']='6:00';
$classtime['21']='6:30';
$classtime['22']='7:00';
$classtime['23']='7:30';
$classtime['24']='8:00';

$classtype['0']='Lab';
$classtype['1']='Theory';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Faculty - Sections</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/css/faculty-dashboard.css">
	<link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
	<link rel="icon" href="../../favicon.png">
</head>
<body>
	<?php include '../header.php'?>
	<div class="main">
		<?php include '../navigation.php'?>
		<div class="right-panel">
			<div class="page-title">
				<p>Your Sections</p>
				<a href="addsection.php"><button class="addsection-button">Add Section</button></a>
			</div>
			<div class="main-container">
				<?php
				require '../../includes/dbh.inc.php';
				$sql = "SELECT * FROM sections WHERE FacultyId = ?;";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					echo '<p class="error-msg">Error retrieving your data</p>';
				}
				else{
					mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					mysqli_stmt_bind_result($stmt, $sectionId, $sectionName, $facultyId, $createdAt);
					if(mysqli_stmt_num_rows($stmt) == 0){
						echo "<p>You have no sections as of now. Use the add section button to create a section.";
					}
					else{
						while (mysqli_stmt_fetch($stmt)) {
							echo
							'<div class="section-box">
							<p class="sec-name">'.$sectionName.'</p>';

							$sql2 = "SELECT * FROM sectionTimes WHERE sectionId = ?;";
							$stmt2 = mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt2, $sql2)){
								echo '<p class="error-msg">Error retrieving your data - sectiontimes'.mysqli_error($conn).'</p>';
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
									echo '<div class="sec-times">';
									while (mysqli_stmt_fetch($stmt2)) {
										echo 
										'<p class="sec-time">'.$weekday[$weekDayId]." ".$classtime[$startTimeId]." - ".$classtime[$endTimeId]." [".$classtype[$classType]."] at ".$room.'</p>';
									}
									if(mysqli_stmt_num_rows($stmt2) == 1){
										echo '<p>2nd class of week not available/applicable</p>';
									}
									echo '<div class="section-menu">';
									echo '<form method="post" action="students.php">';
									echo '<input type="hidden" name="sectionId" value="'.$sectionId.'" />';
									echo '<input type="hidden" name="sectionName" value="'.$sectionName.'" />';
									echo '<input type="submit" class="students" value="Students">';
									echo '</form>';
									echo '<form method="post" action="classes.php">';
									echo '<input type="hidden" name="sectionId" value="'.$sectionId.'" />';
									echo '<input type="hidden" name="sectionName" value="'.$sectionName.'" />';
									echo '<input type="submit" class="classes" value="Classes">';
									echo '</form>';
									echo '<form method="post" action="editsection.php">';
									echo '<input type="hidden" name="sectionId" value="'.$sectionId.'" />';
									echo '<input type="hidden" name="sectionName" value="'.$sectionName.'" />';
									echo '<input type="submit" class="edit" value="Edit">';
									echo '</form>';
									echo '</div>';
									echo '</div>';
								}
							}
							echo '</div>';
						}
					}
				}
				?>
			</div>
		</div>
	</body>
	</html>