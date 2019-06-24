<?php
require 'connect.php';
      if(isset($_POST["emp_name"])){
        $emp_name = $_POST["emp_name"];
        $output = ''; 
        $output .= '<table border="0">
      <tr>
        <th style="cursor: pointer;">SNO</th>
        <th style="cursor: pointer;">Course ID</th> 
        <th style="cursor: pointer;">Course Name</th>
        <th style="cursor: pointer;">Start Date</th>
        <th style="cursor: pointer;">End Date</th>
        <th style="cursor: pointer;">Course Fees</th>
        <th style="cursor: pointer;">Course Agency</th>
        <th style="cursor: pointer;">Location</th>
      </tr> 
    ';
      $retrieve_course_query = "SELECT applied_course.emp_id,course.course_id,course.course_name,course.course_period_start_date,course.course_period_end_date,course.course_fees,course.course_agency,course.location FROM applied_course INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.id INNER JOIN course ON applied_course.course_id = course.course_id WHERE mini_pis_details.emp_name = '$emp_name'";
      $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
      $i=1;
      while($row = mysqli_fetch_array($course_result)) {
        $output .= '<tr class="view_data_emp" style="cursor: pointer;">
        <td>'.$i.'</td>
        <td class="co_id">'.$row["course_id"].'</td>
        <td>'.$row["course_name"].'</td>
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
      $(".view_data_emp").click(function(){  
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