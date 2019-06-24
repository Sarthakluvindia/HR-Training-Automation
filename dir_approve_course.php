<?php

require('connect.php');
include 'login.php';

echo '<script> window.setTimeout("window.close()", 10); </script>';

if (isset($_POST['approve'])) {
	$id = $_SESSION['emp_id'];
	$course_id = $_SESSION['course_id'];

	$update_query = "UPDATE `applied_course` SET `dir_flag` = '1', `dir_approve_time` = CURRENT_TIMESTAMP WHERE `applied_course`.`emp_id` = '$id' AND `applied_course`.`course_id` = '$course_id'";
	mysqli_query($connection, $update_query) or die(mysqli_error($connection));
	$update_query = "UPDATE applied_course SET remarks = 'Approved By Director' WHERE applied_course.emp_id = '$id' AND applied_course.course_id = '$course_id'";
		mysqli_query($connection, $update_query) or die(mysqli_error($connection));
}
if (isset($_POST['disapprove'])) {
	$id = $_SESSION['emp_id'];
	$course_id = $_SESSION['course_id'];

	$disapprove_query_update = "UPDATE `applied_course` SET `dir_flag` = '0', `dir_approve_time` = CURRENT_TIMESTAMP WHERE `applied_course`.`emp_id` = '$id' AND `applied_course`.`course_id` = '$course_id'";
	mysqli_query($connection, $disapprove_query_update) or die(mysqli_error($connection));
	$update_query = "UPDATE applied_course SET remarks = 'Not Approved by Director' WHERE applied_course.emp_id = '$id' AND applied_course.course_id = '$course_id'";
		mysqli_query($connection, $update_query) or die(mysqli_error($connection));

}
?>
