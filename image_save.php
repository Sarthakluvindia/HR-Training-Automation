<?php
echo '<script> window.setTimeout("window.close()", 10); </script>';
require('connect.php');
$id_array = "";
//Get previous ID from the database
	$get_id_query = "SELECT course_id FROM course WHERE login_time = (SELECT MAX(login_time) FROM course)";
	$result_get_id = mysqli_query($connection, $get_id_query);
	$get_id_array = mysqli_fetch_array($result_get_id);
	$get_id_value = $get_id_array['course_id'];
	$get_id_count = mysqli_num_rows($result_get_id);
 	
 	//Creating new ID
	$id_array = preg_split('/(?<=[A-Z])(?=[0-9]+)/i',$get_id_value);
	$firstword = 'CR';
	$new = $id_array[1]+1;
	$num_padded = sprintf("%04d", $new);
	$updated_course_id = $firstword.$num_padded;

$uploaddir = 'brochures/';
$uploadfile = $uploaddir . basename($_FILES['scan']['name']);
echo "<p>";
$extension=end(explode(".", $uploadfile));
if (move_uploaded_file($_FILES['scan']['tmp_name'], $uploadfile)) {
  echo "File is valid, and was successfully uploaded.\n";
} else {
   echo "Upload failed";
}
rename($uploadfile, "brochures/".$updated_course_id.".".$extension);
echo "</p>";
echo '<pre>';
echo 'Here is some more debugging info:';
print_r($_FILES);
print "</pre>";

?>