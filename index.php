<?php
$backGround = "images/classroom.jpg";
$gh_icon = "images/gh_icon.png";
$fb_icon = "images/fb_icon.png";
$gmail_icon = "images/gmail_icon.png";
$login_icon = "images/login.png";
$project_icon = "images/project.png";
$scan_icon = "images/scan.png";
$down_win = "images/windows_download.png";
$down_android = "images/android_download.png";
$down_ios = "images/ios_download.png";

session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>ASW - Home</title>
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
			<div class="logo"><a href="index.php"><strong>Attendance Scanning Wizard</strong></a></div>
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
		<h1 id="title">Welcome to ASW</h1>
		<p id="subtitle">Automate Your Classroom with Attendance Scanning</p>
		<div class="divider-banner"></div>
		<div class="steps">
			<ul class="step-list">
				<li>
					<?php echo '<img src="'.$login_icon.'">' ?>
					<h2>Login</h2>
					<p>to your account from the login page</p>
				</li>
				<li>
					<?php echo '<img src="'.$project_icon.'">' ?>
					<h2>Project</h2>
					<p>QR code in class from faculty's dashboard</p>
				</li>
				<li>
					<?php echo '<img src="'.$scan_icon.'">' ?>
					<h2>Scan</h2>
					<p>QR code with student's dashboard</p>
				</li>
			</ul>
		</div>
	</div>
	<footer>
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