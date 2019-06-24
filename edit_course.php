<?php 
require 'connect.php';
include 'login.php';

 if(isset($_POST["edit_co_id"]))  
 {  
  $output = '';
  $edit_query = "SELECT * FROM course WHERE course_id = '".$_POST["edit_co_id"]."'";
  $edit_res = mysqli_query($connection, $edit_query) or die(mysqli_error($connection));  
  while($row = mysqli_fetch_array($edit_res))  
  {  
$output .='<form action="course_detail_entry.php" method="post" id="course_form" target="_blank">
          <input name="edit_course_id" id="edit_course_id" type="hidden" value="'.$_POST["edit_co_id"].'">
          <div class="row">
            <div class="col-15">
              <label for="cname">Course Name:</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="coursename" name="coursename" value="'.$row['course_name'].'">
            </div>
          </div>
          <div class="row">
            <div class="col-15">
              <label for="subject">Subject:</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="subject" name="subject" value="'.$row['course_subject'].'">
            </div>
          </div>
          <div class="col-15">
            <label for="start_date">Start Date:</label>
          </div>
          <input class="text_input" type="Date" id="start_date" name="start_date" value="'.$row['course_period_start_date'].'"><label for="end_date">&nbsp;(Format: mm/dd/yyyy)</label><br>
          <div class="col-15">
            <label for="end_date">End Date:</label>
          </div>
          <input class="text_input" type="Date" id="end_date" name="end_date" value="'.$row['course_period_end_date'].'"><label for="end_date">&nbsp;(Format: mm/dd/yyyy)</label><br>  
          <div class="row">
            <div class="col-15">
              <label for="location">Location:</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="location" name="location" value="'.$row['location'].'">
            </div>
          </div>
          <div class="row">
            <div class="col-15">
              <label for="fees">Fees (Rs.):</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="fees" name="fees" value="'.$row['course_fees'].'">
            </div>
          </div>
          <div class="row">
            <div class="col-15">
              <label for="fees">Eligibility:</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="eligibility" name="eligibility" value="'.$row['eligibility'].'">
            </div>
          </div>
          <div class="row">
            <div class="col-15">
              <label for="description">Description:</label>
            </div>
            <div class="col-85">
              <textarea id="description" class="modal_textarea" name="description" value="" style="height:200px">'.$row['course_description'].'</textarea>
            </div>
          </div> 
          <hr style="border: 1px dashed black;" />
          <div class="row">
            <div class="col-15">
              <label for="course_agency">Course Agency:</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="course_agency" name="course_agency" value="'.$row['course_agency'].'">
            </div>
          </div>
          <div class="row">
            <div class="col-15">
              <label for="course_agency_add">Address:</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="course_agency_add" name="course_agency_add" value="'.$row['course_agency_permanent_address'].'">
            </div>
          </div>
          <div class="row">
            <div class="col-15">
              <label for="city">City:</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="city" name="city" value="'.$row['course_city'].'">
            </div>
          </div>
          <hr style="border: 1px dashed black;" />
          <div class="row">
            <div class="col-15">
              <label for="person_name">Contact Person:</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="person_name" name="person_name" value="'.$row['contact_person_name'].'">
            </div>
          </div>
          <div class="row">
            <div class="col-15">
              <label for="mobile">Mobile Number(s):</label>
            </div>
            <div class="col-85">
              <input class="modal_text" type="text" id="mobile" name="mobile" value="'.$row['contact_person_number'].'">
            </div>
          </div>
          <div class="row">
            <div class="col-15">
              <label for="email">Email Address:</label>
            </div>
            <div class="col-85">
              <input style="margin-bottom: 6px;" class="modal_text" type="text" id="email" name="email" value="'.$row['contact_person_email'].'">
            </div>
          </div>
          <div class="w3-container w3-light-grey w3-padding">
            <input class="w3-button w3-right w3-white w3-border" type="submit" id="edit_course" name="edit_course" value="Save" onclick="window.location.reload();">
          </div>
        </form>';
  }
  echo $output;  
  }
    ?>
        