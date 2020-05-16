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

$_SESSION['sectionId'] = $sectionId;
$_SESSION['sectionName'] = $sectionName;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Remove Students</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/css/faculty-dashboard.css">
	<link rel="icon" href="../../favicon.png">
	<script language="JavaScript">
		function toggle(source) {
			checkboxes = document.getElementsByName('foo[]');
			for(var i=0, n=checkboxes.length;i<n;i++) {
				checkboxes[i].checked = source.checked;
			}
		}
	</script>
</head>
<body>
	<?php include '../header.php';?>
	<div class="main">
		<?php include '../navigation.php'?>
		<div class="right-panel">
			<div class="page-title">
				<a href="students.php"><button class="back-button"><img src="../../images/back.png"></button></a>
				<p>Remove students from <?php echo $_POST['sectionName']?></p>
			</div>
			<div class="main-container-table">
				<?php
				require '../../includes/dbh.inc.php';
				$sql = "SELECT * FROM users where Id in (SELECT studentId from sectionstudents where sectionId = ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					echo '<p class="error-msg">Error retrieving your data</p>';
				}
				else{
					mysqli_stmt_bind_param($stmt, "s", $sectionId);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					mysqli_stmt_bind_result($stmt, $stu_id, $stu_academicId, $stu_firstname, $stu_lastname, $stu_email, $stu_pass, $stu_userType, $stu_createdAt);
					if(mysqli_stmt_num_rows($stmt) == 0){
						echo "<p>There are no students in this section.";
					}
					else{
						echo '<form action="includes/remove-student.inc.php" method="post" class="student-remove-form" onsubmit="return confirm(\'Are your sure you want to remove selected student(s)? All attendance data will be deleted pemanently!\')">';
						echo '<table class="student-table">';
						echo '<tr>';
						echo '<th>#</th>';
						echo '<th>Academic ID</th>';
						echo '<th>Name</th>';
						echo '<th><input type="checkbox" onClick="toggle(this)"></th>';
						echo '</tr>';
						$index = 1;
						while (mysqli_stmt_fetch($stmt)){
							echo '<tr>';
							echo '<td>'.$index.'</td>';
							echo '<td>'.$stu_academicId.'</td>';
							echo '<td>'.$stu_firstname." ".$stu_lastname.'</td>';
							echo '<td><input type="checkbox" name="foo[]" value="'.$stu_id.'"></td>';
							echo '</tr>';
							$index++;
						}
						echo '</table>';
						echo '<input type="hidden" name="sectionId" value='.$sectionId.'>';
						echo '<input type="hidden" name="sectionName" value='.$sectionName.'>';
						echo '<input type="submit" name="submit" value="Remove Selected">';
						echo '</form>';
						if(isset($_GET['error']) && $_GET['error']=="nosel") echo '<p style = "color: red;">Please select some students  before proceeding</p>';
					}
				}
				?>
			</div>
		</div>
	</body>
	</html>