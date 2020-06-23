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
$sazid = "images/sazid.jpg";
$asir = "images/asir.jpg";
$pial = "images/pial.jpg";
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>ASW - About</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="icon" href="favicon.png">
</head>
<body>
	<!-- Header -->
	<?php include 'header.php'; ?>

<div class="banner-about">
	<h1 id="title-about">About</h1>
	<div class="divider-banner"></div>
	<div class="purpose">
		<h2>Purpose of ASW</h2>
		<p>ASW is another step towards classroom automation. Where traditional roll-calling takes 5-10 minutes to finish, ASW focuses on trimming it down to 5-10 seconds. Although ASW automates the process, it doesn't completely remove the manual entries. Faculty can still manually edit attenadances.</p>
	</div>
	<div class="divider-banner"></div>
	<h2 id="title-howitworks">How It Works</h2>
	<div class="para">
		<p>ASW was designed to be used by the Faculties and Students of American International University-Bangladesh. It works in the following way:</p>
		<p><strong>Step 1:</strong> Faculty logs in to the website on his/her laptop in the classroom.<br><br><strong>Step 2:</strong>After login, faculty will be able to manage(create, update, delete) his/her sections, students, classes etc.<br><br><strong>Step 3:</strong> For each lecture, a QR code will be generated and available to be displayed on that class day. This should be shown using the projector during class time. It will be available for the whole duration of the class. Faculty should project it only when the class is ready to scan.<br><br><strong>Step 4:</strong> Students login with VUES credentials on the website or their smartphone app and scan the QR code<br><br><strong>Step 5:</strong> Students' app will then automatically submit the attendance for that lecture to the ASW server when online. The data will then be updated on the server and in turn, on faculty's account.</p>
	</div>
	<div class="divider-banner"></div>
	<div class="personnel-project">
		<h2>Project developed by</h2>
		<div class="dev-sazid">
			<?php echo '<img src="'.$sazid.'">' ?>
			<h2 id="dev">Md. Sazid Uddin</h2>
			<p>B.Sc. in Software Engineering</p>
			<p>American International University-Bangladesh</p>
		</div>
	</div>
	<div class="divider-banner"></div>
	<div class="personnel-web">
		<h2>ASW Web App Development in co-operation with</h2>
		<div class="dev-asir">
			<?php echo '<img src="'.$asir.'">' ?>
			<h2 id="dev">Asir Intesar Ibne Zaman</h2>
			<p>B.Sc. in Computer Science and Engineering</p>
			<p>American International University-Bangladesh</p>
		</div>
		<div class="dev-pial">
			<?php echo '<img src="'.$pial.'">' ?>
			<h2 id="dev">Md. Pial Hasan</h2>
			<p>B.Sc. in Computer Information Systems</p>
			<p>American International University-Bangladesh</p>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>

<!-- Scripts -->
<?php include 'scripts.php'; ?>

</body>
</html>
