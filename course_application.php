<?php  
require 'connect.php';
include 'login.php';

 if(isset($_POST["js_id"]))  
 {  
  $_SESSION['course_id'] = $_POST['js_id'];
  $_SESSION['start_date'] = $_POST['date_js'];
  $output = ''; 
  $retrieve_course_modal_query = "SELECT * FROM course WHERE course_id = '".$_POST["js_id"]."'";
  $course_modal_result = mysqli_query($connection, $retrieve_course_modal_query) or die(mysqli_error($connection));   
  while($row = mysqli_fetch_array($course_modal_result))  
  {  
       $output .= '
       <h2>Notification Details</h2>
  		<p>The following are the details of nomination:</p>  
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
                 .$row["course_period_end_date"].  
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
                 <b>Course Description:</b> ' 
                 .$row["course_description"].  
            '</p>
            <p>  
                 <b>Course Venue:</b> ' 
                 .$row["location"].  
            '</p>
            <p>  
                 <b>Course Organised By:</b> ' 
                 .$row["course_agency"].  
            '</p>
             <input type="submit" name="view" id="view" value="View Brochure" class="w3-button w3-left w3-drdo-blue w3-border" onclick="window.open('."'brochures/".$_SESSION['course_id'].".pdf'".','."'_blank'".');"><br><br>
            ';  
      }  
      echo $output;  
 }  
 ?>
