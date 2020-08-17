<?php
$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_POST['userId']) && isset($_POST['userPassword']) ){
		if (preg_match("/^\d{2}-\d{5}-[1-3]$/", $_POST['userId'])) {
			include_once('../libs/simple_html_dom.php');
			//building post string
			$data = array("UserName"=>$_POST['userId'], "Password"=>$_POST['userPassword']);
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
					$response['error'] = false;
					$response['message'] = "Logged in";
					$response['userId'] = $_POST['userId'];
					$response['userFullName'] = (string)$name;
				}
				else{
					$response['error'] = true;
					$response['message'] = "Login failed. Please check your ID and password";
				}
			}
			else{
				$response['error'] = true;
				$response['message'] = "Could not connect to portal.aiub.edu";
			}
		}
		else{
			$response['error'] = true;
			$response['message'] = "ID Format not recognized";
		}
	}
	else{
		$response['error'] = true;
		$response['message'] = "Please enter your username and password";
	}
}
else{
	$response['error'] = true;
	$response['message'] = "Invalid request";
}

echo json_encode($response);