<?php
$backGround = "images/classroom.jpg";
$gh_icon = "images/gh_icon.png";
$fb_icon = "images/fb_icon.png";
$gmail_icon = "images/gmail_icon.png";

session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_SESSION['userType']) && $_SESSION['userType'] == 0){
		header("Location: faculty/sections/sections.php");
	}
	else if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
		header("Location: student/dashboard.php");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ASW - Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
	<link rel="icon" href="favicon.png">
	
</head>
<body style="background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('<?php echo $backGround; ?>');
background-size: cover;
background-repeat: no-repeat;
background-position: center center;
background-attachment: fixed;">
<header>
	<nav>
		<div class="logo"><a href="index.html"><strong>Attendance Scanning Wizard</strong></a></div>
		<ul class="nav-links">
			<li><a href="index.php">Home</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="signup.php">Signup</a></li>
			<li><a href="about.php">About</a></li>
		</ul>
		<div class="burger">
			<div class="line1"></div>
			<div class="line2"></div>
			<div class="line3"></div>
		</div>
	</nav>
</header>

<script src="assets/js/app.js"></script>

<div class="banner">
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

<footer id="footer-login">
	<div class="bottom">
		<p>Attendance Scanning Wizard | Developed by Md. Sazid Uddin</p>

		<div class="contact">
			<ul class="contact-list">
				<li><?php echo '<a href="https://github.com/manchitro/"><img src="'.$gh_icon.'"></a>' ?></li>
				<li><?php echo '<a href="https://www.facebook.com/doctorwhouse"><img src="'.$fb_icon.'"></a>' ?></li>
				<li><?php echo '<a href="mailto:initialsaremsu@gmail.com"><img src="'.$gmail_icon.'"></a>' ?></li>
			</ul>
		</div>
	</div>
</footer>
</body>
</html>

