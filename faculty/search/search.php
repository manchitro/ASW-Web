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
	<title>Students</title>
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
				<input type="text" name="search" id="searchBox" placeholder="Search for students by ID or Name" required="">
				<button class="search-button" id="searchButton"><img src="../../images/search.png"></button>
				<input type="hidden" name="facultyId" id="facultyId" value='<?php echo $_SESSION["userId"]?>'>
			</div>
			<div class="main-container-table" id="main-container-table">

			</div>
			<script type="text/javascript" src="../js/search.js"></script>
		</div>
	</body>
	</html>