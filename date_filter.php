<?php
require 'connect.php';
      if(isset($_POST["from_date_modal"], $_POST["to_date_modal"])){
        echo "<script>console.log('hello')</script>";
        $from_date_modal = $_POST["from_date_modal"];
        $to_date_modal = $_POST["to_date_modal"];
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
      $retrieve_course_query = "SELECT * FROM course INNER JOIN course_div ON course.course_id = course_div.course_id INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.apply_time BETWEEN '$from_date_modal' AND '$to_date_modal' ORDER BY course.course_id DESC";
      $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
      $i=1;
      while($row = mysqli_fetch_array($course_result)) {
        $output .= '<tr class="view_table_data" style="cursor: pointer;">
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
      $output .= '
      <script>
      $(document).ready(function(){  
      $(".view_table_data").click(function(){  
           var js_co_id = $(this).closest("tr").find(".co_id").text();
           $.ajax({  
                url:"course_view.php",  
                method:"post",  
                data:{js_co_id:js_co_id},  
                success:function(data){  
                     $("#modal_body").html(data);  
                     $("#id04").modal("show");
                }  
           });  
      });  
  });</script>';
      echo $output;
      }
    ?>