<?php
$backGround = "images/classroom.jpg";
$gh_icon = "images/gh_icon.png";
$fb_icon = "images/fb_icon.png";
$gmail_icon = "images/gmail_icon.png";
?>

<?php
$academicid = $_POST["academicid"];
$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];
$default_salt = "default_salt";

$fname = trim(preg_replace('/\s+/',' ', $fname));
$lname = trim(preg_replace('/\s+/',' ', $lname));
$email = trim(preg_replace('/\s+/',' ', $email));

$query = "INSERT INTO `users`(`AcademicId`, `FirstName`, `LastName`, `Email`, `Password`, `Salt`, `UserType`) VALUES ('".$academicid."', '".$fname."', '".$lname."','".$email."','".$password."', '".$default_salt."', 0)";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Message</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	
	
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
	<h1 id="title">Signup</h1>
	<p id="subtitle">Message</p>
	<div class="divider-banner"></div>
	<div class="agileits-top">
		<h3 id="message">
			<?php
			try{
				$conn = mysqli_connect('localhost', 'root','','aswdb');
				if ($conn->connect_error) {
					echo 'Could no establish connection with the server. Please try again';
				}else{
					if ($conn->query($query) === TRUE) {
						echo 'Account created successfully. Login <a href="login.php">here.';
					} else if($conn->error){
						echo 'Your account could not be created. There might be an account with the same academic ID or email. Please try again or if you already have an account, login <a href="login.php"> here';
					}
					$conn->close();
				}
			}
			catch(Exception $e){
				echo 'Could not connect to server. PLease try again';
			}
			?></h3>
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


