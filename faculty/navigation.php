<div class="left-panel">
	<?php include 'todaysclasses.php'?>
	<nav>
		<div class="nav-bars" <?php if(strpos($_SERVER['PHP_SELF'], "sections")) echo 'id="active"';?>>
			<img src="../../images/sections.png">
			<a href="../sections/sections.php">Sections</a>
		</div>
		<div class="nav-bars" <?php if(strpos($_SERVER['PHP_SELF'], "search")) echo 'id="active"';?>>
			<img src="../../images/search.png">
			<a href="../search/search.php">Search</a>
		</div>
		<div class="nav-bars" <?php if(strpos($_SERVER['PHP_SELF'], "profile")) echo 'id="active"';?>>
			<img src="../../images/login.png">
			<a href="../profile/profile.php">Profile</a>
		</div>
		<div class="nav-bars">
			<img src="../../images/logout.png">
			<a href="../includes/logout.inc.php">Logout</a>
		</div>
	</nav>
</div>
