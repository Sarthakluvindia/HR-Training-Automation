<?php
echo '<script> window.setTimeout("window.close()", 10); </script>';
require('connect.php');
$id_array = "";

if (isset($_POST['next'])) {

	$coursename = $_POST['coursename'];
	$subject = $_POST['subject'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$location = $_POST['location'];
	$eligibility = $_POST['eligibility'];
	$fees = $_POST['fees'];
	$description = $_POST['description'];
	$agency = $_POST['course_agency'];
	$address = $_POST['course_agency_add'];
	$city = $_POST['city'];
	$person_name = $_POST['person_name'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];

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

	//Data entry in database
	$query = "INSERT INTO course VALUES ('$updated_course_id','$coursename','$start_date','$end_date','$fees','$subject','$agency','$address','$location','$city','$person_name','$mobile','$email','$description','$eligibility',CURRENT_TIMESTAMP)";
	if (mysqli_query($connection, $query)) {
	      echo "Data entered successfully.";
	} else {
	      echo "<script>window.alert('Error:".mysqli_error($connection)."')</script>";
	}
}
if (isset($_POST['edit_course'])) {

	$edit_course_id = $_POST['edit_course_id'];
	$coursename = $_POST['coursename'];
	$subject = $_POST['subject'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$location = $_POST['location'];
	$eligibility = $_POST['eligibility'];
	$fees = $_POST['fees'];
	$description = $_POST['description'];
	$agency = $_POST['course_agency'];
	$address = $_POST['course_agency_add'];
	$city = $_POST['city'];
	$person_name = $_POST['person_name'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];

	//Data update in database
	$query = "UPDATE `course` SET `course_name`='$coursename',`course_period_start_date`='$start_date',`course_period_end_date`='$end_date',`course_fees`='$fees',`course_subject`='$subject',`course_agency`='$agency',`course_agency_permanent_address`='$address',`location`='$location',`course_city`='$city',`contact_person_name`='$person_name',`contact_person_number`='$mobile',`contact_person_email`='$email',`course_description`='$description',`eligibility`='$eligibility' WHERE course_id = '$edit_course_id'";
	mysqli_query($connection, $query);
}
?>