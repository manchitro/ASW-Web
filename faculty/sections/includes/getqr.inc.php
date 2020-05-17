<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['classId'])){

	}
	else{
		echo "Get QR failed: no post";
	}
}
else{
	echo "Get QR failed: no session";
}