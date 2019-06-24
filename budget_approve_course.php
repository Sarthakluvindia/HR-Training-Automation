<?php

require('connect.php');
include 'login.php';

echo '<script> window.setTimeout("window.close()", 10); </script>';

if (isset($_POST['approve'])) {
	$id = $_SESSION['emp_id'];
	$course_id = $_SESSION['course_id'];

	$update_query = "UPDATE `applied_course` SET `budget_flag` = '1', `budget_approve_time` = CURRENT_TIMESTAMP WHERE `applied_course`.`emp_id` = '$id' AND `applied_course`.`course_id` = '$course_id'";
	mysqli_query($connection, $update_query) or die(mysqli_error($connection));
	$update_query = "UPDATE applied_course SET remarks = 'Forwarded By Budget' WHERE applied_course.emp_id = '$id' AND applied_course.course_id = '$course_id'";
		mysqli_query($connection, $update_query) or die(mysqli_error($connection));
}
if (isset($_POST['disapprove'])) {
	$id = $_SESSION['emp_id'];
	$course_id = $_SESSION['course_id'];

$sel_query = "SELECT dir_flag FROM applied_course WHERE emp_id = '$id' AND course_id = '$course_id'";
	$sel_result = mysqli_query($connection, $sel_query) or die(mysqli_error($connection));
	$sel_array = mysqli_fetch_array($sel_result);
	$dir_flag = $sel_array['dir_flag'];

	if ($dir_flag == '1') {
		echo '<script> window.alert("You cannot cancel now. Director has approved the course."); </script>';		
	}
else{
	$disapprove_query_update = "UPDATE `applied_course` SET `budget_flag` = '0', `budget_approve_time` = CURRENT_TIMESTAMP WHERE `applied_course`.`emp_id` = '$id' AND `applied_course`.`course_id` = '$course_id'";
	mysqli_query($connection, $disapprove_query_update) or die(mysqli_error($connection));
	$update_query = "UPDATE applied_course SET remarks = 'Rejected By Budget' WHERE applied_course.emp_id = '$id' AND applied_course.course_id = '$course_id'";
		mysqli_query($connection, $update_query) or die(mysqli_error($connection));
}
}
?>
