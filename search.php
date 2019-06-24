<?php
require('connect.php');

if (isset($_POST['query'])) {
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_query = "SELECT DISTINCT course_name FROM course WHERE course_name LIKE '%".$_POST['query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="co_name">'.$row["course_name"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}

if (isset($_POST['sub_query'])) {
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_sub_query = "SELECT DISTINCT course_subject FROM course WHERE course_subject LIKE '%".$_POST['sub_query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_sub_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="co_sub">'.$row["course_subject"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}

if (isset($_POST['loc_query'])) {
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_loc_query = "SELECT DISTINCT location FROM course WHERE location LIKE '%".$_POST['loc_query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_loc_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="co_loc">'.$row["location"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}

if (isset($_POST['agency_query'])) {
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_agency_query = "SELECT DISTINCT course_agency FROM course WHERE course_agency LIKE '%".$_POST['agency_query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_agency_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="co_age">'.$row["course_agency"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}

if (isset($_POST['add_query'])) {
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_add_query = "SELECT DISTINCT course_agency_permanent_address FROM course WHERE course_agency_permanent_address LIKE '%".$_POST['add_query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_add_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="co_add">'.$row["course_agency_permanent_address"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}

if (isset($_POST['city_query'])) {
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_city_query = "SELECT DISTINCT course_city FROM course WHERE course_city LIKE '%".$_POST['city_query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_city_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="co_city">'.$row["course_city"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}

if (isset($_POST['person_query'])) {
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_person_query = "SELECT DISTINCT contact_person_name FROM course WHERE contact_person_name LIKE '%".$_POST['person_query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_person_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="co_per">'.$row["contact_person_name"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}

if (isset($_POST['email_query'])) {
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_email_query = "SELECT DISTINCT contact_person_email FROM course WHERE contact_person_email LIKE '%".$_POST['email_query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_email_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="co_ema">'.$row["contact_person_email"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}

if (isset($_POST['emp_name_query'])) {
	echo "<script>console.log('hello')</script>";
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_emp_name_query = "SELECT EMP_NAME FROM mini_pis_details WHERE EMP_NAME LIKE '%".$_POST['emp_name_query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_emp_name_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="co_emp">'.$row["EMP_NAME"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}
if (isset($_POST['name_query'])) {
	$output = '';
$output .='<ul style="padding-left:0;list-style:none;">';
$search_name_query = "SELECT DISTINCT course_name FROM course WHERE course_name LIKE '%".$_POST['name_query']."%' LIMIT 5";
$result = mysqli_query($connection, $search_name_query) or die(mysqli_error($connection));
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result)) {
		$output .='<li id="modal_course_name">'.$row["course_name"].'</li>';
	}
}
$output .= '</ul>';
echo $output;
}
?>