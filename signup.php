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
		<form action="includes/signup.inc.php" method="post">
			<?php
			if ($_GET) {
				if ($_GET['error'] == 'academicidexists') {
					echo "<p>Could not signup. Academic ID already belongs to an account</p>";

				}
				elseif ($_GET['error'] == 'emailexists') {
					echo "<p>Could not signup. Email already belongs to an account</p>";
				}
			}
			?>
			<input class="text" type="text" name="academicid" id="academicid" placeholder="Academic ID (XXXX-XXXX-X)" required title="XXXX-XXXX-X format required" pattern="^\d{4}-\d{4}-[1-3]$" value="<?php echo(isset($_GET['academicid']))?$_GET['academicid']:''?>">
			<input class="text" type="text" name="firstname" id="firstname" placeholder="First Name" required="" value="<?php echo(isset($_GET['firstname']))?$_GET['firstname']:''?>">
			<input class="text" type="text" name="lastname" id="lastname" placeholder="Last Name" required="" value="<?php echo(isset($_GET['lastname']))?$_GET['lastname']:''?>">
			<input class="text-email" type="email" name="email" id="email" placeholder="Academic Email (@aiub.edu)" required title="You need an aiub.edu email to sign up" pattern="^[a-zA-Z0-9]+@aiub\.edu$" value="<?php echo(isset($_GET['email']))?$_GET['email']:''?>">
			<input class="text" type="password" name="password" id="password" placeholder="Password" required title="Password has to be at lease 6 characters long" pattern=".{6,}">
			<input class="text-w3lpass" type="password" name="cpassword" id="confirm_password" placeholder="Confirm Password" required="">

			<button type="submit" name="signup-submit">SIGNUP</button>
		</form>
		<script src="assets/js/passval.js"></script>
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
