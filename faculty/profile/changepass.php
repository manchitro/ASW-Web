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
				<p>Change Password</p>
			</div>
			<div class="main-container">
				<div class="pass-change-title">
					<p>Change Password</p>
				</div>
				<div class="pass-change-form">
					<p class="error" style="color: red; margin-bottom: 10px;"><?php if(isset($_GET['error']) && $_GET['error'] == "badpass") echo "You have entered a wrong password"?></p>
					<form action="includes/change-password.inc.php" method="post">
						<table class="pass-table">
							<tr><td class="key">Old Password: </td><td class="value"><input type="password" name="oldPassword" required=""></td></tr>
							<tr><td class="key">New Password: </td><td class="value"><input type="password" name="password" id="password" required=""></td></tr>
							<tr><td class="key">Confirm Password: </td><td class="value"><input type="password" name="confirm_password" id="confirm_password" required=""></td></tr>
							<tr><td class="Key"></td><td class="submit-button"><input type="submit" name="submit" value="Change"></td></tr>
						</table>
					</form>
					<script src="../../assets/js/passval.js"></script>
				</div>
			</div>
		</div>
	</body>
	</html>