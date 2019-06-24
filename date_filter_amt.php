<?php
require 'connect.php';
      if(isset($_POST["from_date_modal_amt"], $_POST["to_date_modal_amt"])){
        $from_date_modal_amt = $_POST["from_date_modal_amt"];
        $to_date_modal_amt = $_POST["to_date_modal_amt"];
        $output = ''; 
        $output .= '<table border="0">
      <tr>
        <th style="cursor: pointer;">SNO</th>
        <th style="cursor: pointer;">Course ID</th> 
        <th style="cursor: pointer;">Course Name</th>
        <th style="cursor: pointer;">Employee Name</th>
        <th style="cursor: pointer;">Start Date</th>
        <th style="cursor: pointer;">End Date</th>
        <th style="cursor: pointer;">Course Fees</th>
        <th style="cursor: pointer;">Course Agency</th>
        <th style="cursor: pointer;">Location</th>
      </tr> 
    ';
      $retrieve_course_query = "SELECT * FROM course INNER JOIN course_div ON course.course_id = course_div.course_id INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.apply_time BETWEEN '$from_date_modal_amt' AND '$to_date_modal_amt' ORDER BY course.course_id DESC";
      $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
      $i=1;
      while($row = mysqli_fetch_array($course_result)) {
        $output .= '<tr class="view_data" style="cursor: pointer;">
        <td>'.$i.'</td>
        <td class="co_id">'.$row["course_id"].'</td>
        <td>'.$row["course_name"].'</td>
        <td>'.$row["EMP_NAME"].'</td>
        <td>'.$row["course_period_start_date"].'</td>
        <td>'.$row["course_period_end_date"].'</td>
        <td>'.$row["course_fees"].'</td>
        <td>'.$row["course_agency"].'</td>
        <td>'.$row["location"].'</td>
      </tr>';
      $i++;
      }
      $output .='</table>';
      $sum_query = "SELECT SUM(course.course_fees) FROM course INNER JOIN course_div ON course.course_id = course_div.course_id INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.apply_time BETWEEN '$from_date_modal_amt' AND '$to_date_modal_amt' ORDER BY course.course_id DESC";
      $sum_res = mysqli_query($connection, $sum_query) or die(mysqli_error($connection));
      $sum_arr = mysqli_fetch_array($sum_res);
      $output .='<p> The total money spent is: '.$sum_arr['SUM(course.course_fees)'].'</p>';
      echo $output;
      }
    ?>