<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Faculty - Students</title>
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
				<p>Student list of <?php echo $_POST['sectionName']?></p>
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
				<?php
				require '../../includes/dbh.inc.php';
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
					if(mysqli_stmt_num_rows($stmt) == 0){
						echo "<p>There are no students in this section. Please add students using the button above.";
					}
					else{
						echo '<table class="student-table">';
						echo '<tr>';
						echo '<th>#</th>';
						echo '<th>Academic ID</th>';
						echo '<th>Name</th>';
						echo '</tr>';
						$index = 1;
						while (mysqli_stmt_fetch($stmt)){
							echo '<tr>';
							echo '<td>'.$index.'</td>';
							echo '<td>'.$stu_academicId.'</td>';
							echo '<td>'.$stu_firstname." ".$stu_lastname.'</td>';
							echo '</tr>';
							$index++;
						}
						echo '</table>';
					}
				}
				?>
			</div>
		</div>
	</body>
	</html>