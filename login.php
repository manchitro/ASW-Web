<?php
$backGround = "images/classroom.jpg";
$gh_icon = "images/gh_icon.png";
$fb_icon = "images/fb_icon.png";
$gmail_icon = "images/gmail_icon.png";

include 'includes/autologin.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>ASW - Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	
	<link rel="icon" href="favicon.png">
	
</head>
<body style="background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('<?php echo $backGround; ?>');
background-size: cover;
background-repeat: no-repeat;
background-position: center center;
background-attachment: fixed;">
<?php include 'header.php';?>

<div class="banner-login">
	<h1 id="title">Login</h1>
	<p>(Students login with VUES credentials)</p>
	<div class="divider-banner"></div>
	<div class="agileits-top">
		<form action="includes/login.inc.php" method="post">
			<?php 
			if (isset($_GET['signup'])) {
				if ($_GET['signup'] == 'success') {
					echo '<p>Your account has been created. You can now login</p>';
				}
			}
			if (isset($_GET['error'])) {
				if ($_GET['error'] == 'invalidlogin') {
					echo "<p>Invalid Email or ID. Please try again</p>";
				}
				if ($_GET['error'] == 'badcred') {
					echo "<p>The Email/ID or password you've entered is incorrect. Please try again</p>";
				}
				if ($_GET['error'] == 'nosession') {
					echo "<p>Please login first</p>";
				}
				if ($_GET['error'] == 'vuesvalfailed') {
					echo "<p>Could not verify your VUES ID and Password. Please try again</p>";
				}
			}
			?>
			<input class="text" type="text" name="email" placeholder="Academic ID or Email" required="">
			<input class="text" type="password" name="password" placeholder="Password" required="">

			<button type="submit" name="login-submit">LOGIN</button>
		</form>
		<p id="already">Need an Account? <a href="signup.php"> Signup Now!</a></p>
		<p id="reset"><a href="passwordreset.php"> Forgot Password?</a></p>
	</div>
</div>

<?php include 'footer.php';?>
</body>
</html>

