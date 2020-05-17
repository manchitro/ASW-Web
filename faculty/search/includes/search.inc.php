<?php
session_start();
if (isset($_SESSION['userId']) && $_SESSION['userId']!== "") {
	if(isset($_POST['key']) && isset($_POST['facultyId'])){
		$key = $_POST['key'];
		$facultyId = $_POST['facultyId'];

		require '../../../includes/dbh.inc.php';

		if ($key == "") {
			echo "<p>Please insert a search term first</p>";
		}
		else if(preg_match("~[0-9]~", $key) == 1){
			$sql = "SELECT Id, SectionName FROM sections WHERE FacultyId = ?";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo "Failed to retrieve data";
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt, $section_Id, $section_Name);

				if(mysqli_stmt_num_rows($stmt) == 0){
					echo "<p>You have no students as of now.";
				}
				else{
					echo '<table class=student-table>';
					echo '<tr><th>Academic ID</th><th>Name</th><th>Section</th></tr>';
					while (mysqli_stmt_fetch($stmt)) {
						$sql2 = "SELECT AcademicId, FirstName, LastName FROM users where AcademicId like ? AND UserType = 1 AND id in
						(select StudentId FROM SectionStudents where SectionId = ?)";
						$stmt2 = mysqli_stmt_init($conn);

						if (!mysqli_stmt_prepare($stmt2, $sql2)) {
							echo "Failed to retrieve data";
							exit();
						}
						else{
							$key = "%{$key}%";
							mysqli_stmt_bind_param($stmt2, "ss", $key, $section_Id);
							mysqli_stmt_execute($stmt2);
							mysqli_stmt_store_result($stmt2);
							mysqli_stmt_bind_result($stmt2, $stu_aid, $stu_fname, $stu_lname);

							while (mysqli_stmt_fetch($stmt2)){
								echo '<tr><td>'.$stu_aid.'</td><td>'.$stu_fname.' '.$stu_lname.'</td><td>'.$section_Name.'</td></tr>';				
							}
						}
					}
					echo '</table>';
				}
			}
		}
		else{
			$sql = "SELECT Id, SectionName FROM sections WHERE FacultyId = ?";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo "Failed to retrieve data";
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt, $section_Id, $section_Name);

				if(mysqli_stmt_num_rows($stmt) == 0){
					echo "<p>You have no students as of now.";
				}
				else{
					echo '<table class=student-table>';
					echo '<tr><th>Academic ID</th><th>Name</th><th>Section</th></tr>';
					while (mysqli_stmt_fetch($stmt)) {
						$sql2 = "SELECT AcademicId, FirstName, LastName FROM users where (FirstName like ? OR LastName LIKE ?) AND UserType = 1 AND id in
						(select StudentId FROM SectionStudents where SectionId = ?)";
						$stmt2 = mysqli_stmt_init($conn);

						if (!mysqli_stmt_prepare($stmt2, $sql2)) {
							echo "Failed to retrieve data";
							exit();
						}
						else{
							$key = "%{$key}%";
							mysqli_stmt_bind_param($stmt2, "sss", $key, $key, $section_Id);
							mysqli_stmt_execute($stmt2);
							mysqli_stmt_store_result($stmt2);
							mysqli_stmt_bind_result($stmt2, $stu_aid, $stu_fname, $stu_lname);		

							while (mysqli_stmt_fetch($stmt2)){
								echo '<tr><td>'.$stu_aid.'</td><td>'.$stu_fname.' '.$stu_lname.'</td><td>'.$section_Name.'</td></tr>';				
							}
						}
					}
					echo '</table>';
				}
			}
		}

		/*$sql = "UPDATE attendances SET Entry = ? WHERE Id = ?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "Attendance update failed: sqlerror";
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "ii", $attEntry, $attId);
			mysqli_stmt_execute($stmt);

			echo "changed: ".$attId." to ".$attEntry;
			exit();
		}*/		
	}
	else{
		echo "Attendance update failed: no post";
	}
}
else{
	echo "Attendance update failed: no session";
}