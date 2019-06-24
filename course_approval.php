<?php
require 'connect.php';
include 'login.php';

if(isset($_POST["js_id"]))  
{
  $_SESSION['course_id'] = $_POST['js_id'];
  $_SESSION['emp_id'] = $_POST['js_eid'];
  $output = ''; 

  $add_query = "SELECT mini_pis_details.EMP_NAME, course.course_name, course.course_period_start_date, course.course_fees, course.eligibility, course.location, applied_course.remarks FROM course INNER JOIN applied_course ON applied_course.course_id = course.course_id INNER JOIN mini_pis_details ON mini_pis_details.ID=".$_POST['js_eid']." WHERE applied_course.emp_id = mini_pis_details.ID AND course.course_id = '".$_POST['js_id']."'";
  $result = mysqli_query($connection, $add_query) or die(mysqli_error($connection));  
while($row = mysqli_fetch_array($result))
  {
  $output .='<h2>Course Details</h2>
    <p>The following are the details of the course to which the employee applied for:</p>
    <p>
    <b>Employee Name:</b> '
    .$row["EMP_NAME"].
    '</p>
    <p>
    <b>Course Name:</b> '
    .$row["course_name"].
    '</p>
    <p>  
    <b>Course Start Date:</b> ' 
    .$row["course_period_start_date"].  
    '</p>
    <p>  
    <b>Course End Date:</b> ' 
    .$row["course_period_start_date"].  
    '</p>
    <p>
    <b>Course Fees:</b> '
    .$row["course_fees"].
    '</p>
    <p>
    <b>Course Eligibility:</b> '
    .$row["eligibility"].
    '</p>
    <p>
    <b>Course Location:</b> '
    .$row["location"].
    '</p>
    <p>
    <b>Status:</b> '
    .$row["remarks"].
    '</p>
    <h2> Past Training Records of the employee: </h2>
     ';
  }
  $output .= '
  <table border="0">
      <tr>
        <th>SNO</th>
        <th>Course ID</th>
        <th>Course Name</th>
        <th>Course Fees</th>
        <th>Course Agency</th>
        <th>Location</th>
      </tr>';

  $retrieve_course_modal_query = "SELECT mini_pis_details.ID, mini_pis_details.EMP_NAME, course.course_id, course.course_name, course.course_fees, course.eligibility,course.location, course.course_agency FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.emp_id = '".$_POST['js_eid']."'";
  $course_modal_result = mysqli_query($connection, $retrieve_course_modal_query) or die(mysqli_error($connection));  
  $i=1;
  while($row = mysqli_fetch_array($course_modal_result))
  {
    $output .= '
      <tr>
        <td>'.$i.'</td>
        <td>'.$row["course_id"].'</td>
        <td>'.$row["course_name"].'</td>
        <td>'.$row["course_fees"].'</td>
        <td>'.$row["course_agency"].'</td>
        <td>'.$row["location"].'</td>
      </tr>
    ';
    $i++;
  }
  $output .='</table>';
  echo $output; 
}
?>
