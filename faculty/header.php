<?php
if(!isset($_SESSION)){
	header("Location: sections/sections.php");
}
?>
<header>
	<div class="title">
		<h4>ASW Faculty Portal</h4>
	</div>
	<div class="welcome">
		<?php include 'messages.php'?>
		<?php echo "<p>Welcome, ".$_SESSION['userFirstName']." ".$_SESSION['userLastName']."</p>"; 
		?>
		<img src="../../images/login.png">
	</div>
</header>