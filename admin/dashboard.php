<?php

//session_start();
//if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {}
//else{
	//header("Location: ../login.php?error=nosession");
	//exit();
//}


	$backGround = "../images/classroom.jpg";
	$gh_icon = "../images/gh_icon.png";
	$fb_icon = "../images/fb_icon.png";
	$gmail_icon = "../images/gmail_icon.png";

	$cname[0] = "CreatedAt";
	$cname[1] = "AcademicId";
	$cname[2] = "Email";
	$cname[3] = "ClassTimeText";
	$cname[4] = "WeekDaytext";
	
	$tname[0] = "classtimes";
	$tname[1] = "users";
	$tname[2] = "weekdays";
	
	require '../includes/dbh.inc.php';
	$stmt = mysqli_stmt_init($conn);
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>ASW - Admin Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Spartan&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
		.one {
			background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('<?php echo $backGround; ?>');
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center center;
			background-attachment: fixed;
		}

		.two {
			border: 1px solid white;
			margin-bottom: 100px;
		}

		table.three {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		table.three td, table.three th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		table.three tr:nth-child(even) {
			background-color: #dddddd;
		}

		.four {
			margin-bottom: 25px;
		}
	</style>
</head>

<body class="one">

	<header>
		<nav>
			<div class="logo"><a href="index.php"><strong>Attendance Scanning Wizard</strong></a></div>
			<ul class="nav-links">
				<li><a href="index.php">Home</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="signup.php">Signup</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
			</ul>
			<div class="demo">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
			</div>
		</nav>
	</header>

	<div class="banner-signup">
		<h1 id="title">Admin Dashboard</h1>
		<p id="subtitle">Select, Insert, Delete and Update</p>
		<div class="divider-banner"></div>
		<div class="agileits-top">

			<form action="result.php" method="post">

				<select class="form-control four" name="tname" id="tname">
					<option value="">Table Name</option>
					<?php for($i=0; $i<3; $i++) { ?>
						<option value="<?php echo $tname[$i]; ?>"><?php echo $tname[$i]; ?></option>
					<?php } ?>
				</select>

				<select class="form-control four" name="cname" id="cname">
					<option value="">Column Name</option>
					<?php for($i=0; $i<5; $i++) { ?>
						<option value="<?php echo $cname[$i]; ?>"><?php echo $cname[$i]; ?></option>
					<?php } ?>
				</select>

				<input class="form-control" type="text" name="cvalue" placeholder="Column Value" required>

				<button type="submit" name="dashboard_submit">Submit</button>
			</form>

		</div>

		<div class="two">
			
		</div>
	</div>

	<footer id="footer">
		<div class="bottom">
			<p>Attendance Scanning Wizard</p>

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
