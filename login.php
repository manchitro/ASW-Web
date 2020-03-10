<?php
$backGround = "images/classroom.jpg";
$gh_icon = "images/gh_icon.png";
$fb_icon = "images/fb_icon.png";
$gmail_icon = "images/gmail_icon.png";
?>

<!DOCTYPE html>
<html>
<head>
	<title>ASW - Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
	
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
	<div class="divider-banner"></div>
	<div class="agileits-top">
		<form action="#" method="post">
			<input class="text" type="text" name="academicid" placeholder="Academic ID or Email" required="">
			<input class="text" type="password" name="password" placeholder="Password" required="">

			<input type="submit" value="LOGIN">
		</form>
		<p id="already">Need an Account? <a href="signup.php"> Signup Now!</a></p>
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

<?php

?>