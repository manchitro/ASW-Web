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
							<?php 
							require '../../includes/dbh.inc.php';
							$sql ="SELECT AcademicId, FirstName, LastName, Email FROM users WHERE Id=?";
							$stmt = mysqli_stmt_init($conn);

							if (!mysqli_stmt_prepare($stmt, $sql)) {
								echo "Could not retrieve data";
							}
							else{
								mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_store_result($stmt);
								mysqli_stmt_bind_result($stmt, $user_academicId, $user_firstName, $user_lastName, $user_email);
								if(mysqli_stmt_fetch($stmt)){
									echo '<tr><td class="key">Academic Id: </td><td class="value"><p>'.$user_academicId.'</p></td></tr>';
									echo '<tr><td class="key">First Name: </td><td class="value"><input type="text" name="firstName" value="'.$user_firstName.'"></td></tr>';
									echo '<tr><td class="key">Last Name: </td><td class="value"><input type="text" name="lastName" value="'.$user_lastName.'"></td></tr>';
									echo '<tr><td class="key">Email: </td><td class="value"><input type="email" name="email" title="Your email has to be 	on aiub.edu domain" pattern="^[A-Za-z0-9._%+-]+@aiub\.edu$" value="'.$user_email.'"></td></tr>';
									echo '<tr><td></td><td class="submit-button"><input type="submit" name="submit" value="Save"></td></tr>';
								}
								else{
									echo '<p>Data not found</p>';
								}
							}
							?>
							
						</table>
					</form>
				</div>
				<div class="pass-change-title">
					<p>Change Password</p>
				</div>
				<div class="pass-change-form">
					<p class="error" style="color: red; margin-bottom: 10px;"><?php if(isset($_GET['error']) && $_GET['error'] == "badpass") echo "You have entered a wrong password"?></p>
					<form action="includes/change-password.inc.php" method="post">
						<table class="pass-table">
							<tr><td class="key">Old Password: </td><td class="value"><input type="password" name="oldPassword" required=""></td></tr>
							<tr><td class="key">New Password: </td><td class="value"><input type="password" name="password" id="password" required="" pattern=".{6,}" autocomplete="new-password" title="Password has to be at least 6 characters long. Mix of uppercase, lowercase, numbers is recommended!"></td></tr>
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