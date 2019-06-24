<?php 
require 'connect.php';
include 'login.php';

 if(isset($_POST["edit_div_co_id"]))  
 {  
  $output = '<form action="update_div.php" method="post" target="_blank">
  <input id="edit_div_course_id" name="edit_div_course_id" type="hidden" value="'.$_POST["edit_div_co_id"].'">
  <label>Select Division to add:</label>
      <select id="edit_div_selector" class="w3-select" style="width: 25%; border: 1px solid;" name="edit_div_selector">';
  $divi_query = "SELECT DIV_CODE FROM divisionsu";
          $divi_res = mysqli_query($connection, $divi_query) or die(mysqli_error($connection));
          while ($dert = mysqli_fetch_array($divi_res)) {
            $output .='<option>'.$dert['DIV_CODE'].'</option>';
          }
  $output .= '</select>
      <input class="w3-button w3-black"  type="submit" name="add_div" id="add_div" value="Add" class="btn btn-info" onclick="window.location.reload();" />
    </form>';
  echo $output;  
  }
    ?>
      
        
           