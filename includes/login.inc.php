<?php
if(isset($_POST['login-submit']))
{
	$uid = $_POST['email'];
	$password = $_POST['password'];

	//uid matches faculty
	if (preg_match("/^\d{4}-\d{4}-[1-3]$/", $uid) || preg_match("/^[a-zA-Z0-9]+@aiub\.edu$/", $uid)) {
		require 'dbh.inc.php';
		$sql ="SELECT * FROM users WHERE Email=? OR AcademicId=?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../login.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$passwordCheck = password_verify($password, $row['Password']);
				if ($passwordCheck == false) {
					header("Location: ../login.php?error=badcred");
					exit();
				}
				elseif ($passwordCheck == true) {
					session_start();
					$_SESSION['userId'] = $row['Id'];
					$_SESSION['userAcademicId'] = $row['AcademicId'];
					$_SESSION['userFirstName'] = $row['FirstName'];
					$_SESSION['userLastName'] = $row['LastName'];
					$_SESSION['userEmail'] = $row['Email'];
					$_SESSION['userType'] = $row['UserType'];
					$_SESSION['userCreatedAt'] = $row['CreatedAt'];

					header("Location: ../faculty/sections/sections.php");
				}
				else{
					header("Location: ../login.php?error=badcred");
					exit();
				}
			}
			else{
				header("Location: ../login.php?error=badcred");
				exit();
			}
		}
	}
	//uid matches student
	elseif (preg_match("/^\d{2}-\d{5}-[1-3]$/", $uid)) {
		include_once('../libs/simple_html_dom.php');
		//building post string
		$data = array("UserName"=>$uid, "Password"=>$password);
		$postString = http_build_query($data);
		$user_agent = "Mozilla/5.0 (X11; Linux i686; rv:24.0) Gecko/20140319 Firefox/24.0 Iceweasel/24.4.0";

		//curl to post to portal.aiub.edu
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, 'https://portal.aiub.edu/');
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		CURL_SETOPT($curl, CURLOPT_RETURNTRANSFER,True);
		CURL_SETOPT($curl, CURLOPT_FOLLOWLOCATION,True);
		CURL_SETOPT($curl, CURLOPT_POST,True);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $postString);
		CURL_SETOPT($curl, CURLOPT_COOKIEFILE,"cookie.txt");
		CURL_SETOPT($curl, CURLOPT_COOKIEJAR,"cookie.txt");
		CURL_SETOPT($curl, CURLOPT_CONNECTTIMEOUT,30);
		CURL_SETOPT($curl, CURLOPT_TIMEOUT,30);

		$result = curl_exec($curl);

		if(!empty($result)){
			if((strpos($result, 'Academics')!==false) && (strpos($result, 'Grade Reports')!==false)){
				try{
					$html = str_get_html($result);
					$name = $html->find('a[href=/Student/Home/Profile] small text',0);

					if($name == 'Array'){
						$name = 'Student';
					}
				}catch(Exception $e){
					$name = "Student";
				}

				session_start();
				$_SESSION['userAcademicId'] = $uid;
				$_SESSION['userFullName'] = (string)$name;
				//echo $_SESSION['userAcademicId']." ".$_SESSION['userFullName'];
				header("Location: ../student/dashboard.php");
				exit();
			}
			else{
				header("Location: ../login.php?error=vuesvalfailed");
				exit();
			}
		}
		else{
			header("Location: ../login.php?error=vuesvalfailed");
			exit();
		}

	}
	//uid matches admin
	elseif ($uid == 'admin') {
		require 'dbh.inc.php';
		$sql ="SELECT * FROM users WHERE Email=?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../login.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $uid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$passwordCheck = password_verify($password, $row['Password']);
				if ($passwordCheck == false) {
					header("Location: ../login.php?error=badcred");
					exit();
				}
				elseif ($passwordCheck == true) {
					session_start();
					$_SESSION['userId'] = $row['Id'];
					$_SESSION['userAcademicId'] = $row['AcademicId'];
					$_SESSION['userFirstName'] = $row['FirstName'];
					$_SESSION['userLastName'] = $row['LastName'];
					$_SESSION['userEmail'] = $row['Email'];
					$_SESSION['userType'] = $row['UserType'];
					$_SESSION['userCreatedAt'] = $row['CreatedAt'];

					header("Location: ../admin/profile.php");
				}
				else{
					header("Location: ../login.php?error=badcred");
					exit();
				}
			}
			else{
				header("Location: ../login.php?error=badcred");
				exit();
			}
		}
	}
	// uid matches nothing
	else{
		header("Location: ../login.php?error=invalidlogin");
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
}
else{
	header("Location: ../login.php?error=directaccess");
	exit();
}