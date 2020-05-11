session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if ($_SESSION['userEmail'] == "admin") {
		header("Location: admin/profile.php");
	}
	else if(isset($_SESSION['userType']) && $_SESSION['userType'] == 0){
		header("Location: faculty/sections/sections.php");
		exit();
	}
	else if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1){
		header("Location: student/dashboard.php");
		exit();
	}
}