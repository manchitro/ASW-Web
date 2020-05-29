<script src="assets/js/fontawesome.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<nav>
	<label class="logo"><a href="index.php">Attendance Scanning Wizard</a></label>
	<ul class="navigation">
		<li><a href="index.php" <?php if(strpos($_SERVER['PHP_SELF'], "index")) echo 'id="active"';?> class="nav-links">Home</a></li>
		<li><a href="login.php" <?php if(strpos($_SERVER['PHP_SELF'], "login")) echo 'id="active"';?> class="nav-links">Login</a></li>
		<li><a href="signup.php" <?php if(strpos($_SERVER['PHP_SELF'], "signup")) echo 'id="active"';?> class="nav-links">Signup</a></li>
		<li><a href="about.php" <?php if(strpos($_SERVER['PHP_SELF'], "about")) echo 'id="active"';?> class="nav-links">About</a></li>
	</ul>
	<input type="checkbox" id="check">
	<label for="check" class="checkbtn">
		<i class="fas fa-bars"></i>
	</label>
</nav>
<script type="text/javascript">
	$('#check').on('change', function () {
		if ($('#check').is(':checked')) {
			$('.navigation').css('left', '0');
		} else {
			$('.navigation').css('left', '-100%');
		}
	});
</script>