<?php  
session_start(); //Start the Session
require('connect.php'); //Get connection details
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['id']) and isset($_POST['password'])){
//3.1.1 Assigning posted values to variables.
$id = $_POST['id'];
$password = $_POST['password'];
$_SESSION['id'] = $id;
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM `PASSWD` WHERE ID='$id' and PASSWORD='$password'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

//Getting the name of the employee
$name_query = "SELECT emp_name FROM mini_pis_details WHERE id = '$id'";
$name_query_result = mysqli_query($connection, $name_query) or die(mysqli_error($connection));
$name_query_array = mysqli_fetch_array($name_query_result);
$name_query_value = $name_query_array['emp_name'];
$_SESSION['emp_name'] = $name_query_value;

//Getting the designation of the employee
$designation_query = "SELECT desigcode.designation FROM mini_pis_details INNER JOIN desigcode ON mini_pis_details.grade_cd1 = desigcode.code WHERE mini_pis_details.id = '$id'";
$designation_query_results = mysqli_query($connection, $designation_query) or die(mysqli_error($connection));
$designation_query_array = mysqli_fetch_array($designation_query_results);
$designation_query_value = $designation_query_array['designation'];
$_SESSION['designation'] = $designation_query_value;

//The function gets last login time, division numbr and code from database of the logged in employee.
function database($id, $connection){
	$retrieve_login_query = "SELECT last_login FROM user_login WHERE id = '$id'";
	$last_login_result = mysqli_query($connection, $retrieve_login_query) or die(mysqli_error($connection));
	$last_login_array = mysqli_fetch_array($last_login_result);
	$last_login_value = $last_login_array['last_login'];

	$div_acr = "SELECT divisionsu.div_no, divisionsu.div_code FROM divisionsu INNER JOIN mini_pis_details ON mini_pis_details.divi = divisionsu.div_no INNER JOIN passwd ON mini_pis_details.id = passwd.id WHERE passwd.id = '$id'";
	$div_acr_result = mysqli_query($connection, $div_acr) or die(mysqli_error($connection));
	$div_acr_array = mysqli_fetch_array($div_acr_result);
	$div_acr_no = $div_acr_array['div_no'];
	$div_acr_value = $div_acr_array['div_code'];
	$_SESSION['division_no'] = $div_acr_no;
	$_SESSION['division'] = $div_acr_value;
}

//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
	$_SESSION['id'] = $id;
	database($id, $connection);
	header("location: employee.php");
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
	$fmsg = "Invalid Login Credentials.";
	echo "<script> window.alert('Invalid Login Credentials');
	window.location.href = '/drdo/index.html';</script>";
}
}
?>