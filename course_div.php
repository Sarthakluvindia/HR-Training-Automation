<?php
require('connect.php');

echo '<script> window.setTimeout("window.close()", 10); </script>';

$get_id_query = "SELECT course_id FROM course WHERE login_time = (SELECT MAX(login_time) FROM course)";
$result_get_id = mysqli_query($connection, $get_id_query);
$get_id_array = mysqli_fetch_array($result_get_id);
$get_id_value = $get_id_array['course_id'];

$query = "INSERT INTO course_div VALUES ('$get_id_value','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0')";

mysqli_query($connection, $query);

if (isset($_POST['send'])) {
	$div = "";  
	foreach($_POST['div_selection'] as $div)  
	   {  
	   	 $update_query = "UPDATE course_div SET $div = 1 WHERE course_id = '$get_id_value';";
	   	 mysqli_query($connection, $update_query);
	   }    
}
?>