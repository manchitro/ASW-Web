<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	
}
else{
	header("Location: ../../login.php?error=nosession");
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/css/faculty-dashboard.css">
	
	<link rel="icon" href="../../favicon.png">
</head>
<body>
	<?php include '../header.php'?>
	<div class="main">
		<?php include '../navigation.php'?>
		<div class="right-panel">
			<div class="page-title">
				<p>Your Profile</p>
			</div>
			<div class="main-container">
				<div class="profile-form">
					<form action="includes/edit-profile.inc.php" method="post">
						<table class="profile-table">
							<tr><td class="key">Academic Id: </td><td class="value"><p><?php echo $_SESSION['userAcademicId']?></p></td></tr>
							<tr><td class="key">First Name: </td><td class="value"><input type="text" name="firstName" value="<?php echo $_SESSION['userFirstName']?>"></td></tr>
							<tr><td class="key">Last Name: </td><td class="value"><input type="text" name="lastName" value="<?php echo $_SESSION['userLastName']?>"></td></tr>
							<tr><td class="key">Email: </td><td class="value"><input type="email" name="email" pattern="^[a-zA-Z0-9]+@aiub\.edu$" value="<?php echo $_SESSION['userEmail']?>"></td></tr>
							<tr><td></td><td class="submit-button"><input type="submit" name="submit" value="Save"></td></tr>
						</table>
					</form>
				</div>
				<div class="pass-change-form">
					<table class="pass-table">
						<tr><td class="Key">Password: </td><td><a href="changepassword.php">Change</a></td></tr>
					</table>
				</div>
			</div>
		</div>
	</body>
	</html>