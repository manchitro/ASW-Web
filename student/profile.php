<?php
session_start();
if (isset($_SESSION['userAcademicId']) && $_SESSION['userAcademicId']!== "" && isset($_SESSION['userFullName']) && $_SESSION['userFullName']!== "") {
	//echo $_SESSION['userAcademicId']." ".$_SESSION['userFullName'];
}
else{
	header("Location: ../login.php?error=nosession");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/student-dashboard.css">
	<link rel="icon" href="../favicon.png">
</head>
<body>
	<header>
		<div class="back-button">
			<a href="dashboard.php"><button name="back"></button></a>
		</div>
		<div id="message">
			<?php echo'<p id="name">Welcome '.$_SESSION['userFullName'].'</p>'?>
			<?php echo'<p id="aid">'.$_SESSION['userAcademicId'].'</p>'?>
		</div>
		<div id="logout">
			<a href="includes/logout.inc.php"><button name="logout">Logout</button></a>
		</div>
	</header>
	<div id="main">
		<div class="page-title">
			<p>Profile</p>
		</div>
		<div class="profile-div">
			<form action="includes/edit-profile.inc.php" method="post">
			<table class="profile-table">
			<?php
			require '../includes/dbh.inc.php';
			$sql ="SELECT AcademicId, FirstName, LastName, Email FROM users WHERE AcademicId=?";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo "Could not retrieve data";
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $_SESSION['userAcademicId']);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt, $user_academicId, $user_firstName, $user_lastName, $user_email);
				if(mysqli_stmt_fetch($stmt)){
					echo '<tr><td class="key">Academic Id: </td><td class="value"><p>'.$user_academicId.'</p></td></tr>';
					echo '<tr><td class="key">First Name: </td><td class="value"><input type="text" name="firstName" value="'.$user_firstName.'"></td></tr>';
					echo '<tr><td class="key">Last Name: </td><td class="value"><input type="text" name="lastName" value="'.$user_lastName.'"></td></tr>';
					echo '<tr><td class="submit-button"><input type="submit" name="submit" value="Save"></td><td></td></tr>';
				}
				else{
					echo '<p class="warning">You currently do not exist in the ASW database. When a faculty puts you in a section, your profile will be automatically created.</p>';
				}
			}
			?>
			</table>
		</form>
		<p class="warning">Warning: If you change your name it will be updated throughout the system. Meaning, your faculty will see your updated name beside your ID. Change your name only when it is incorrect and always use your real name used by your university.</p>
		</div>
	</div>
</body>
</html>