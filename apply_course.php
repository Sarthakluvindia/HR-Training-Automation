<?php

require('connect.php');
include 'login.php';

echo '<script> window.setTimeout("window.close()", 10); </script>';

if (isset($_POST['apply'])) {
	$id = $_SESSION['id'];
	$course_id = $_SESSION['course_id'];
	$start_date = $_SESSION['start_date'];

	if ($start_date > date('Y-m-d')) {
		$apply_query = "INSERT INTO applied_course VALUES ('$id','$course_id',CURRENT_TIME,0,0,0,0,CURRENT_TIME,CURRENT_TIME,CURRENT_TIME,CURRENT_TIME,'')";
		mysqli_query($connection, $apply_query) or die(mysqli_error($connection));
		$update_query = "UPDATE applied_course SET remarks = 'Applied for the Course' WHERE applied_course.emp_id = '$id' AND applied_course.course_id = '$course_id'";
		mysqli_query($connection, $update_query) or die(mysqli_error($connection));
	}
	else{
		echo '<script> window.alert("Deadline of the course is passed. You cannot apply now."); </script>';		
	}
	
}
if (isset($_POST['cancel'])) {
	$id = $_SESSION['id'];
	$course_id = $_SESSION['course_id'];

	$sel_query = "SELECT gd_flag FROM applied_course WHERE course_id = '$course_id' AND emp_id = '$id'";
	$sel_result = mysqli_query($connection, $sel_query) or die(mysqli_error($connection));
	$sel_array = mysqli_fetch_array($sel_result);
	$gd_flag = $sel_array['gd_flag'];

	if ($gd_flag == '1') {
		echo '<script> window.alert("You cannot cancel now. GD has forwarded your request."); </script>';		
	}
else{
	$cancel_query = "DELETE FROM applied_course WHERE course_id = '$course_id' AND emp_id = '$id'";
	mysqli_query($connection, $cancel_query) or die(mysqli_error($connection));
	$update_query = "UPDATE applied_course SET remarks = 'Initiated by HR' WHERE applied_course.emp_id = '$id' AND applied_course.course_id = '$course_id'";
		mysqli_query($connection, $update_query) or die(mysqli_error($connection));
}
}
?>
