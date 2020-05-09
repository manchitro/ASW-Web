<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['sectionId']) && $_POST['sectionId'] !== ""){
		$sectionId = $_POST['sectionId'];
		$sectionName = $_POST['sectionName'];
	}
	else if (isset($_SESSION['sectionId'])){
		$sectionId = $_POST['sectionId'] = $_SESSION['sectionId'];
		$sectionName = $_POST['sectionName'] = $_SESSION['sectionName'];
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
	<title>Faculty - Add Students</title>
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
				<p>Add students in <?php echo $_POST['sectionName']?></p>
			</div>
			<div class="main-container">
				<div class="add-single-student-form">
					<form action="includes/add-single-student.inc.php" method="post">
						<div class="add-single-student-title">
							<p>Add Single Student</p>
						</div>
						<div class="add-single-student-fields">
							<label>Student ID:</label>
							<input type="text" name="student-id" pattern="^\d{2}-\d{5}-[1-3]$" required title="XX-XXXXX-X format required">
							<br>
							<label>First Name:</label>
							<input type="text" name="student-first-name" required>
							<br>
							<label>Last Name:</label>
							<input type="text" name="student-last-name" required>
						</div>
						<input type="hidden" name="sectionId" value="<?php echo $sectionId;?>">
						<input type="hidden" name="sectionName" value="<?php echo $sectionName;?>">
						<div class="add-single-student-button">
							<input type="submit" name="submit-single" value="Add">
						</div>
						<div class="or-divider">
							<p>Or</p>
						</div>
					</form>
					<form action="importspreadsheet.php" method="post">
						<div class="import-spreadsheet-title">
							<p>Import Spreadsheet</p>
						</div>
						<div class="import-spreadsheet-main">
							<p>Disclaimer: Spreadsheet import is an experimental feature. Please read the instructions first.</p>
							<p>Instructions for importing spreadsheet:</p>
							
								<input type="hidden" name="sectionid" value="<?php echo $sectionid;?>">
								<input type="hidden" name="sectionName" value="<?php echo $sectionName;?>">
								<input type="submit" name="submit-import" value="Proceed">
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
	</html>