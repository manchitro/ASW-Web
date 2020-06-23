<?php
include 'includes/autologin.inc.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>ASW - Home</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="icon" href="favicon.png">
</head>
<body>

	<!-- Header -->
	<?php include 'header.php'; ?>

	<!-- Banner -->
	<section id="banner">
		<div class="inner">
			<header>
				<h1 id="page-title">Welcome to ASW</h1>
				<p>Automate Your Class with Attendance Scanning</p>
			</header>
				<div class="divider-banner"></div>
			<div class="flex ">

				<div onclick="location.href='login.php';" style="cursor: pointer;">
					<span><img src="images/login.png"></span>
					<h3>Login</h3>
					<p>to your account from the login page</p>
				</div>

				<div>
					<span><img src="images/project.png"></span>
					<h3>Project</h3>
					<p>QR code in class from faculty's dashboard</p>
				</div>

				<div>
					<span><img src="images/scan.png"></span>
					<h3>Scan</h3>
					<p>QR code with student's scanner app</p>
				</div>

			</div>
		</div>
	</section>

	<!-- Footer -->
	<?php include 'footer.php'; ?>

	<!-- Scripts -->
	<?php include 'scripts.php'; ?>

</body>
</html>
