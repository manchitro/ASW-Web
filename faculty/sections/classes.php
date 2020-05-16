<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	unset($_SESSION['classId']);
	if(isset($_POST['sectionId']) && $_POST['sectionId'] !== ""){
		$sectionId = $_POST['sectionId'];
		$sectionName = $_POST['sectionName'];
	}
	else if(isset($_SESSION['sectionId']) && $_SESSION['sectionId'] !== ""){
		$sectionId = $_SESSION['sectionId'];
		$sectionName = $_SESSION['sectionName'];
		$_POST['sectionId'] = $sectionId;
		$_POST['sectionName'] = $sectionName;
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
	<title>Classes</title>
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
				<p>Classes of <?php echo $_POST['sectionName']?></p>
				<?php
				echo '<form method="post" action="createclass.php">';
				echo '<input type="hidden" name="sectionId" value="'.$sectionId.'" />';
				echo '<input type="hidden" name="sectionName" value="'.$sectionName.'" />';
				echo '<input type="submit" class="addsection-button" value="Create Class">';
				echo '</form>';
				?>
			</div>
			<div class="main-container">
				<?php
				require '../../includes/dbh.inc.php';
				$sql = "SELECT * FROM classes where sectionId = ? ORDER BY ClassDate;";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo '<p class="error-msg">Error retrieving data</p>';
				}
				else{
					mysqli_stmt_bind_param($stmt, "s", $sectionId);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					mysqli_stmt_bind_result($stmt, $classId, $classSectionId, $classDate, $classType, $classStartTimeId, $classEndTimeId, $classRoomNo, $classQRCode, $classQRDisplayStartTime, $classQRDisplayEndTime, $classCreatedAt);
					if(mysqli_stmt_num_rows($stmt) == 0){
						echo "<p>No classes found. Add a class using the button above.</p>";
					}
					else{
						while (mysqli_stmt_fetch($stmt)) {
							echo '<div class="class-box">';
								echo '<p class="class-name">'.$sectionName.' - '.$classtype[$classType].'</p>';
								echo '<div class="class-times">';
									echo '<p class="class-time">'.'on '.date("M d", strtotime($classDate)).'</p>';
									echo '<p class="class-time">from '.$classtime[$classStartTimeId].' to '.$classtime[$classEndTimeId].' at '.$classRoomNo.'</p>';
									echo '<div class="class-menu">';
									echo '<form method="post" action="classattendance.php">';
										echo '<input type="hidden" name="sectionId" value="'.$sectionId.'" />';
										echo '<input type="hidden" name="sectionName" value="'.$sectionName.'" />';
										echo '<input type="hidden" name="classId" value="'.$classId.'" />';
										echo '<input type="submit" class="students" value="Attendances">';
									echo '</form>';
									echo '<form method="post" action="editclass.php">';
										echo '<input type="hidden" name="sectionId" value="'.$sectionId.'" />';
										echo '<input type="hidden" name="sectionName" value="'.$sectionName.'" />';
										echo '<input type="hidden" name="classId" value="'.$classId.'" />';
										echo '<input type="submit" class="classes" value="Edit">';
									echo '</form>';
								echo '</div>';
								echo '</div>';
								
							echo '</div>';
						}
					}
				}
				?>
			</div>
		</div>
	</body>
	</html>