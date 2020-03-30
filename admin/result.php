<?php
	$backGround = "images/classroom.jpg";
	$gh_icon = "images/gh_icon.png";
	$fb_icon = "images/fb_icon.png";
	$gmail_icon = "images/gmail_icon.png";

	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$dbname = "aswdb";

    $database = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);
    
    $result = array();

	function select( $tname, $cname, $cvalue ) {
		global $database, $result;
		
		$sql = "SELECT * FROM $tname WHERE $cname='$cvalue'";
        $query = mysqli_query($database, $sql);
        
		while( $query_result = mysqli_fetch_assoc($query) ) {
            array_push($result, $query_result);
        }

		return $result;
    }
    
    if( $_SERVER["REQUEST_METHOD"]=="POST" ) {
        $tname = $_POST['tname'];
        $cname = $_POST['cname'];
        $cvalue = $_POST['cvalue'];

        $result = select($tname, $cname, $cvalue);
    }
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
			background-color: #000000;
			color: #ffffff
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
			<div class="burger">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
			</div>
		</nav>
	</header>

	<div class="banner-signup">
		<h1 id="title">Admin Dashboard</h1>
		<p id="subtitle">Result</p>
		<div class="divider-banner"></div>

		<div class="two">
            <table class="three">
                <tr>
                    <?php foreach($result[0] as $key => $value) { ?>
                        <th> <?php echo $key; ?> </th>
                    <?php } ?>
                </tr>
                <?php for($i = 0; $i < count($result); $i++) { ?>
                    <tr>
                        <?php foreach($result[$i] as $key => $value) { ?>
                            <td> <?php echo $value; ?> </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
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