<?php  
require 'connect.php';
include 'login.php';

 if(isset($_POST["js_co_id"]))  
 {  
  $_SESSION['course_id'] = $_POST['js_co_id'];
  $output = ''; 
  $retrieve_course_modal_query = "SELECT * FROM course WHERE course_id = '".$_POST["js_co_id"]."'";
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
            <p>
            <b>Course Sent To Divisions: </b>
            ';  
      }  

$div_query = "SELECT name FROM ( SELECT course_id,BC AS val, 'BC' AS name FROM course_div union all SELECT course_id,DIR, 'DIR' FROM course_div union all SELECT course_id,HRD, 'HRD' FROM course_div union all SELECT course_id,IP,'IP' FROM course_div union all SELECT course_id,LI, 'LI' FROM course_div union all SELECT course_id,ASG, 'ASG' FROM course_div union all SELECT course_id,FCS, 'FCS' FROM course_div union all SELECT course_id,MMG, 'MMG' FROM course_div union all SELECT course_id,NS, 'NS' FROM course_div union all SELECT course_id,OE, 'OE' FROM course_div union all SELECT course_id,OME, 'OME' FROM course_div union all SELECT course_id,PR, 'PR' FROM course_div union all SELECT course_id,SFI, 'SFI' FROM course_div union all SELECT course_id,VI, 'VI' FROM course_div union all SELECT course_id,WORKS, 'WORKS' FROM course_div union all SELECT course_id,ABS, 'ABS' FROM course_div union all SELECT course_id,AO, 'AO' FROM course_div union all SELECT course_id,ASS, 'ASS' FROM course_div union all SELECT course_id,ATD, 'ATD' FROM course_div union all SELECT course_id,DAR, 'DAR' FROM course_div union all SELECT course_id,EW, 'EW' FROM course_div union all SELECT course_id,GMC, 'GMC' FROM course_div union all SELECT course_id,HP, 'HP' FROM course_div union all SELECT course_id,KC, 'KC' FROM course_div union all SELECT course_id,LIC, 'LIC' FROM course_div union all SELECT course_id,MDS, 'MDS' FROM course_div union all SELECT course_id,MD, 'MD' FROM course_div union all SELECT course_id,MGMT, 'MGMT' FROM course_div union all SELECT course_id,MT, 'MT' FROM course_div union all SELECT course_id,OS, 'OS' FROM course_div union all SELECT course_id,PRIP, 'PRIP' FROM course_div union all SELECT course_id,RQA, 'RQA' FROM course_div union all SELECT course_id,SC, 'SC' FROM course_div union all SELECT course_id,SEC, 'SEC' FROM course_div union all SELECT course_id,SEEKER, 'SEEKER' FROM course_div union all SELECT course_id,SERVO, 'SERVO' FROM course_div union all SELECT course_id,TC, 'TC' FROM course_div union all SELECT course_id,TF, 'TF' FROM course_div union all SELECT course_id,TI, 'TI' FROM course_div union all SELECT course_id,TLX, 'TLX' FROM course_div union all SELECT course_id,UVIC, 'UVIC' FROM course_div union all SELECT course_id,WORKSSP, 'WORKSSP' FROM course_div union all SELECT course_id,ASP, 'ASP' FROM course_div union all SELECT course_id,DVPR, 'DVPR' FROM course_div union all SELECT course_id,TWH, 'TWH' FROM course_div union all SELECT course_id,ALLD, 'ALLD' FROM course_div union all SELECT course_id,AFV, 'AFV' FROM course_div) t where course_id = '".$_POST['js_co_id']."' AND val = '1'";
 $div_query_res = mysqli_query($connection, $div_query) or die(mysqli_error($connection));  
 while ($row = mysqli_fetch_array($div_query_res)){
    $div[] = $row["name"];
 }
  $output .= implode(', ', $div).'</p>';
  $cond_query = "SELECT * FROM applied_course WHERE course_id = '".$_POST["js_co_id"]."'";
  $cond_res = mysqli_query($connection, $cond_query) or die(mysqli_error($connection));
  $cond_count = mysqli_num_rows($cond_res);
  if ($cond_count > 0) {
    $output .= '
    <div class="w3-container w3-light-grey w3-padding">
      You cannot Edit course information now, as the employees have applied for the course.<br>
      <input class="w3-button w3-right w3-white w3-border" type="submit" id="edit_div" name="edit_div" value="Add / Modify Divisions" onclick="document.getElementById('."'id04'".').style.display='."'none'".';document.getElementById('."'id16'".').style.display='."'block'".'">
    </div>';
  }
  else{
    $output .= '
    <div class="w3-container w3-light-grey w3-padding">
      <input class="w3-button w3-right w3-white w3-border" type="submit" id="edit" name="edit" value="Modify Course Information" onclick="document.getElementById('."'id04'".').style.display='."'none'".';document.getElementById('."'id15'".').style.display='."'block'".'">
      <input class="w3-button w3-right w3-white w3-border" type="submit" id="edit_div" name="edit_div" value="Add / Modify Divisions" onclick="document.getElementById('."'id04'".').style.display='."'none'".';document.getElementById('."'id16'".').style.display='."'block'".'">
    </div>';
  }
      echo $output;  
 }  
 ?>
