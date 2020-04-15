<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['submit']))
	{
		//echo "Faculty: ".$_SESSION['userId'].PHP_EOL;
		$sectionId = $_POST['section-id'];
		$sectionName = $_POST['section-name'];

		$oneClass = $_POST['one-class'];
		
		$time1id = $_POST['section-time-1-id'];
		$weekDay1 = $_POST['weekday-1'];
		$startTime1 = $_POST['start-time-1'];
		$endTime1 = $_POST['end-time-1'];
		$classType1 = $_POST['class-type-1'];
		$room1 = $_POST['room-1'];

		$time2id = $_POST['section-time-2-id'];
		$weekDay2 = $_POST['weekday-2'];
		$startTime2 = $_POST['start-time-2'];
		$endTime2 = $_POST['end-time-2'];
		$classType2 = $_POST['class-type-2'];
		$room2 = $_POST['room-2'];

		//validate section time 1
		if ($startTime1 < $endTime1) {
			if($endTime1 >= $startTime1 + 2){
				if ($endTime1 <= $startTime1 + 6) {
					//echo "Section name: ".$sectionName.PHP_EOL;
					//echo "Section time 1: ".PHP_EOL;
					//echo "Weekday: ".$weekDay1.PHP_EOL;
					//echo $startTime1." to ".$endTime1.PHP_EOL;
					//echo "Room: ".$room1.PHP_EOL.PHP_EOL;

					require '../../../includes/dbh.inc.php';

					$sql = "UPDATE sections SET SectionName = ? WHERE Id = ?;";
					$stmt = mysqli_stmt_init($conn);

					if (!mysqli_stmt_prepare($stmt, $sql)) {
						$_SESSION['sectionId'] = $sectionId;
						$_SESSION['sectionName'] = $sectionName;
						header("Location: ../editsection.php?error=sqlerror1");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt, "ss", $sectionName, $sectionId);
						mysqli_stmt_execute($stmt);

						$sql = "UPDATE SectionTimes SET StartTimeId = ?, EndTimeId = ?, WeekDayId = ?, ClassType = ?, RoomNo = ? WHERE Id = ?;";
						$stmt = mysqli_stmt_init($conn);

						if(!mysqli_stmt_prepare($stmt, $sql)){
							$_SESSION['sectionId'] = $sectionId;
							$_SESSION['sectionName'] = $sectionName;
							header("Location: ../editsection.php?error=sqlerror2");
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt, "ssssss", $startTime1, $endTime1, $weekDay1, $classType1, $room1, $time1id);
							mysqli_stmt_execute($stmt);
						}
					}

				}
				else{
					$_SESSION['sectionId'] = $sectionId;
					$_SESSION['sectionName'] = $sectionName;
					header("Location: ../editsection.php?error=maxlen3h&name=".$sectionName."&wd1=".$weekDay1."&st1=".$startTime1."&et1=".$endTime1."&ct1=".$classType1."&r1=".$room1."&wd2=".$weekDay2."&st2=".$startTime2."&et2=".$endTime2."&ct2=".$classType2."&r2=".$room2);
					exit();
				}
			}
			else{
				$_SESSION['sectionId'] = $sectionId;
				$_SESSION['sectionName'] = $sectionName;
				header("Location: ../editsection.php?error=minlen1h&name=".$sectionName."&wd1=".$weekDay1."&st1=".$startTime1."&et1=".$endTime1."&ct1=".$classType1."&r1=".$room1."&wd2=".$weekDay2."&st2=".$startTime2."&et2=".$endTime2."&ct2=".$classType2."&r2=".$room2);
				exit();
			}
		}
		else{
			$_SESSION['sectionId'] = $sectionId;
			$_SESSION['sectionName'] = $sectionName;
			header("Location: ../editsection.php?error=neglen&name=".$sectionName."&wd1=".$weekDay1."&st1=".$startTime1."&et1=".$endTime1."&ct1=".$classType1."&r1=".$room1."&wd2=".$weekDay2."&st2=".$startTime2."&et2=".$endTime2."&ct2=".$classType2."&r2=".$room2);
			exit();
		}

		//valdiate section time 2 if one-class is not set
		if ($oneClass == false) {
			if ($startTime2 < $endTime2) {
				if($endTime2 >= $startTime2 + 2){
					if ($endTime2 <= $startTime2 + 6) {
						if ($weekDay1 !== $weekDay2) {
							if(!empty($room2) && $room2 !== ""){
								//echo "Section time 2: ".PHP_EOL;
								//echo "Weekday: ".$weekDay2.PHP_EOL;
								//echo $startTime2." to ".$endTime2.PHP_EOL;
								//echo "Room: ".$room2.PHP_EOL.PHP_EOL;

								$sql = "UPDATE SectionTimes SET StartTimeId = ?, EndTimeId = ?, WeekDayId = ?, ClassType = ?, RoomNo = ? WHERE Id = ?;";
								$stmt = mysqli_stmt_init($conn);

								if(!mysqli_stmt_prepare($stmt, $sql)){
									$_SESSION['sectionId'] = $sectionId;
									$_SESSION['sectionName'] = $sectionName;
									header("Location: ../editsection.php?error=sqlerror3");
									exit();
								}
								else{
									mysqli_stmt_bind_param($stmt, "ssssss", $startTime2, $endTime2, $weekDay2, $classType2, $room2, $time2id);
									mysqli_stmt_execute($stmt);
								}
							}
							else{
								$_SESSION['sectionId'] = $sectionId;
								$_SESSION['sectionName'] = $sectionName;
								header("Location: ../editsection.php?error=noroom&name=".$sectionName."&wd1=".$weekDay1."&st1=".$startTime1."&et1=".$endTime1."&ct1=".$classType1."&r1=".$room1."&wd2=".$weekDay2."&st2=".$startTime2."&et2=".$endTime2."&ct2=".$classType2."&r2=".$room2);
								exit();
							}
						}
						else{
							$_SESSION['sectionId'] = $sectionId;
								$_SESSION['sectionName'] = $sectionName;
							header("Location: ../editsection.php?error=sameday&name=".$sectionName."&wd1=".$weekDay1."&st1=".$startTime1."&et1=".$endTime1."&ct1=".$classType1."&r1=".$room1."&wd2=".$weekDay2."&st2=".$startTime2."&et2=".$endTime2."&ct2=".$classType2."&r2=".$room2);
							exit();
						}
					}
					else{
						$_SESSION['sectionId'] = $sectionId;
								$_SESSION['sectionName'] = $sectionName;
						header("Location: ../editsection.php?error=maxlen3h2&name=".$sectionName."&wd1=".$weekDay1."&st1=".$startTime1."&et1=".$endTime1."&ct1=".$classType1."&r1=".$room1."&wd2=".$weekDay2."&st2=".$startTime2."&et2=	 ".$endTime2."&ct2=".$classType2."&r2=".$room2);
						exit();
					}
				}
				else{
					$_SESSION['sectionId'] = $sectionId;
					$_SESSION['sectionName'] = $sectionName;
					header("Location: ../editsection.php?error=minlen1h2&name=".$sectionName."&wd1=".$weekDay1."&st1=".$startTime1."&et1=".$endTime1."&ct1=".$classType1."&r1=".$room1."&wd2=".$weekDay2."&st2=".$startTime2."&et2=".$endTime2."&ct2=".$classType2."&r2=".$room2);
					exit();
				}
			}
			else{
				$_SESSION['sectionId'] = $sectionId;
				$_SESSION['sectionName'] = $sectionName;
				header("Location: ../editsection.php?error=neglen2&name=".$sectionName."&wd1=".$weekDay1."&st1=".$startTime1."&et1=".$endTime1."&ct1=".$classType1."&r1=".$room1."&wd2=".$weekDay2."&st2=".$startTime2."&et2=".$endTime2."&ct2=".$classType2."&r2=".$room2);
				exit();
			}
		}

		mysqli_stmt_close($stmt);
		mysqli_close($conn);

		//redirect to sections after creation
		header("Location: ../sections.php?secedited=".$sectionName);
		exit();
	}
	else{
		//send to sections if no post
		header("Location: ../sections.php");
		exit();
	}
}
else{
	//send to login if no session
	header("Location: ../../../login.php?error=nosession");
	exit();
}