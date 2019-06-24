<?php
require 'connect.php';
include 'login.php';
echo '<script> window.setTimeout("window.close()", 10); </script>';

 if(isset($_POST["add_div"]))  
 {  
 	$div = $_POST['edit_div_selector'];
 	$course_id = $_POST['edit_div_course_id'];
 	echo $div;
 	echo $course_id;
 	$update_query = "UPDATE course_div SET $div = '1' WHERE course_id = '$course_id'";
 	echo $update_query;
 	mysqli_query($connection, $update_query) or die(mysqli_error($connection));
 }
?>