<?php
include 'login.php'; //Start the Session
require('connect.php'); //Get connection details
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['id']) and isset($_POST['password']) and isset($_POST['new_password'])){
//3.1.1 Assigning posted values to variables.
$id = $_POST['id'];
$password = $_POST['password'];
$new_password = $_POST['new_password'];
$curr_id = $_SESSION['id'];
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM `PASSWD` WHERE ID='$id' and PASSWORD='$password'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);

//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
	if ($curr_id == $id) {
		$update_query = "UPDATE `PASSWD` SET PASSWORD = '$new_password' WHERE ID='$id'";
		mysqli_query($connection, $update_query);
		header("location: index.html");
	}
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
	echo "<script> window.alert('Invalid Credentials');
	window.location.href = '/drdo/index.html';</script>";
}
}
?>