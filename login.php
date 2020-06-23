<!DOCTYPE HTML>
<html>
<head>
	<title>ASW - Login</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body>
	<!-- Header -->
	<header id="header">
		<div class="inner">
			<a href="index.php" class="logo"><strong>ATTENDANCE SCANNING WIZARD</strong></a>
			<nav id="nav">
				<a href="index.php">Home</a>
				<a href="login.php">Login</a>
				<a href="signup.php">Signup</a>
				<a href="about.php">About</a>
			</nav>
			<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
		</div>
	</header>

	<!-- Banner -->
	<section id="banner">
		<div class="inner">
			<header>
				<h1 id="page-title">Login</h1>
				<p>Students login with VUES credential</p>
			</header>
			<div class="divider-banner"></div>
			<div class="flex ">
				<form action="includes/login.inc.php" method="post">
					<?php
						
					?>
					<input class="text" type="text" name="email" placeholder="Academic ID or Email" required="">
					<input class="text" type="password" name="password" placeholder="Password" required="">

					<button type="submit" name="login-submit">LOGIN</button>
					<p id="already">Need an Account? <a href="signup.php"> Signup Now!</a></p>
					<p id="reset"><a href="passwordreset.php"> Forgot Password?</a></p>
				</form>


			</div>
		</div>
	</section>

	<footer id="footer">
		<div class="inner">
			<div class="copyright">
				Attendance Scanning Wizard | Contact Developer
			</div>
			<div class="contact-links">
				<ul class="contact-list">
					<li><a href="https://github.com/manchitro/"><img src="images/gh_icon.png"></a></li>
					<li><a href="https://www.facebook.com/ortihcnam"><img src="images/fb_icon.png"></a></li>
					<li><a href="mailto:initialsaremsu@gmail.com"><img src="images/gmail_icon.png"></a></li>
				</ul>
			</div>
		</div>
	</footer>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>