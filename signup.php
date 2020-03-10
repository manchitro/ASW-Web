<?php
$backGround = "images/classroom.jpg";
$gh_icon = "images/gh_icon.png";
$fb_icon = "images/fb_icon.png";
$gmail_icon = "images/gmail_icon.png";
?>

<!DOCTYPE html>
<html>
<head>
	<title>ASW - Signup</title>
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

<div class="banner-signup">
	<h1 id="title">Signup</h1>
	<p id="subtitle">(Faculty only)</p>
	<div class="divider-banner"></div>
	<div class="agileits-top">
		<form action="#" method="post">
			<input class="text" type="text" name="academicid" placeholder="Academic ID (XXXX-XXXX-X)" required="">
			<input class="text" type="text" name="firstname" placeholder="First Name" required="">
			<input class="text" type="text" name="lastname" placeholder="Last Name" required="">
			<input class="text-email" type="email" name="email" placeholder="Academic Email (@aiub.edu)" required="">
			<input class="text" type="password" name="password" placeholder="Password" required="">
			<input class="text-w3lpass" type="password" name="password" placeholder="Confirm Password" required="">

			<input type="submit" value="SIGNUP">
		</form>
		<p id="already">Already have an Account? <a href="login.php"> Login Now!</a></p>
	</div>
</div>

<footer id="footer">
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