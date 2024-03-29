<!DOCTYPE html>
<html>
<head>
	<title> 
    <?php
      if(!isset($_SERVER['HTTP_REFERER'])){
      // redirect them to your desired location
      header('location: index.html');
      exit;
      }
      include 'login.php'; 
      echo $_SESSION['emp_name'];
    ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="w3-style.css">
  <style type="text/css">
    ul{
      margin: 0px;
      background-color: #eee;
      cursor: pointer;
    }
    li{
      padding: 12px;
    }
    li:hover{
      background-color: #fff;
    }
  </style>
<script src="jquery.min.js"></script>
  <script src="jquery-ui.js"></script>
  <script src="bootstrap.min.js"></script>
</head>
<body>

<!-- Header -->
<div class="header">
  <img class="header-left" src="drdo.png" height="155" width="165">
  <div>
  <center>
  	<h1 style="color: #09418C; font-family: Gotham Book,sans-serif;"><center>Instruments Research & Development Establishment</center></h1>
	<h3 style="color: #09418C; font-family: Gotham Book,sans-serif;">
        <center>Welcome Mr. 
          <?php
          echo $_SESSION['emp_name'];
          ?>
          (ID: <?php
          echo $_SESSION['id'];
          ?>)
        </center>
      </h3>
      <h4 style="color: #09418C; font-family: Gotham Book,sans-serif;">
        <center>
          <?php
          echo $_SESSION['designation'];
          ?><br>Director
        </center>
      </h4>
  </center>
  </div>
</div>
<!-- /Header -->

<!-- Body -->
<div class="row">

<!-- Vertical bar -->
<div class="side">
   <label class="lblbtn"><b>NOTIFICATIONS</b></label>
<div class="btn-group">
  <button onclick="document.getElementById('hr').style.display='none';document.getElementById('id01').style.display='block'"><b>HR DIVISION - NEW COURSE</b>
<?php 
    $id = $_SESSION['id'];
      $div_acr_value = $_SESSION['division'];
    $count_nom = "SELECT course_div.course_id FROM course_div INNER JOIN course ON course.course_id = course_div.course_id INNER JOIN user_login ON user_login.id = '$id'  WHERE course.login_time BETWEEN user_login.last_login AND CURRENT_TIME";
      $count_nom_result = mysqli_query($connection, $count_nom) or die(mysqli_error($connection));
      $count_nom_value = mysqli_num_rows($count_nom_result);
      $_SESSION['count_nom_cnt'] = $count_nom_value;
      
      if ($_SESSION['count_nom_cnt'] == 0) {
        ;
      }
      else{
        echo "<span id='hr' class='badge'>";
        echo $_SESSION['count_nom_cnt']."</span>" ;
      }
    ?>
  </button>
  <button onclick="document.getElementById('hrac').style.display='none';document.getElementById('id08').style.display='block'"><b>HR DIVISION - FORWARDED COURSES</b>
<?php
      $id = $_SESSION['id'];
      $div_no = $_SESSION['division_no'];
      $nom_query = "SELECT applied_course.emp_id, course.course_fees FROM applied_course INNER JOIN course ON applied_course.course_id = course.course_id  INNER JOIN user_login ON user_login.id = '$id' WHERE course.course_fees = '0' AND applied_course.hr_flag = 1 AND applied_course.hr_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
      $nom_result = mysqli_query($connection, $nom_query) or die(mysqli_error($connection));
      $nom_count = mysqli_num_rows($nom_result);
      $nom_array = mysqli_fetch_array($nom_result);
      $value = $nom_array['course_fees'];
      if ($nom_count == 0) {
            ;
          }
          else{
            echo "<span id='hrac' class='badge'>";
            echo $nom_count."</span>" ;
          }
    ?>
  </button>
  <button onclick="document.getElementById('gd').style.display='none';document.getElementById('id06').style.display='block'"><b>DIVISIONAL APPROVING AUTHORITY</b>
<?php
          $id = $_SESSION['id'];
          $div_no = $_SESSION['division_no'];
          $nom_query = "SELECT applied_course.emp_id FROM applied_course INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.gd_flag = 1 AND applied_course.gd_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
          $nom_result = mysqli_query($connection, $nom_query) or die(mysqli_error($connection));
          $nom_count = mysqli_num_rows($nom_result);
          if ($nom_count == 0) {
                ;
              }
              else{
                echo "<span id='gd' class='badge'>";
                echo $nom_count."</span>" ;
              }
        ?>
  </button>
  <button onclick="document.getElementById('emp').style.display='none';document.getElementById('id07').style.display='block'"><b>EMPLOYEES</b>
<?php
          $id = $_SESSION['id'];
          $nom_query = "SELECT * FROM applied_course INNER JOIN course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.apply_time BETWEEN user_login.last_login AND CURRENT_TIME";
          $nom_result = mysqli_query($connection, $nom_query) or die(mysqli_error($connection));
          $nom_count = mysqli_num_rows($nom_result);
          if ($nom_count == 0) {
            ;
          }
          else{
            echo "<span id='emp' class='badge'>";
            echo $nom_count."</span>" ;
          }
        ?>
  </button>
  <button onclick="document.getElementById('bud').style.display='none';document.getElementById('id09').style.display='block'"><b>BUDGET</b>
     <?php
      $id = $_SESSION['id'];
      $div_no = $_SESSION['division_no'];
      $nom_query = "SELECT applied_course.emp_id FROM applied_course INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.budget_flag = 1 AND applied_course.budget_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
      $nom_result = mysqli_query($connection, $nom_query) or die(mysqli_error($connection));
      $nom_count = mysqli_num_rows($nom_result);
      if ($nom_count == 0) {
            ;
          }
          else{
            echo "<span id='bud' class='badge'>";
            echo $nom_count."</span>" ;
          }
    ?>
  </button>
</div>
<label class="lblbtn"><b>REPORTS</b></label>
  <div class="btn-group">
    <button onclick="document.getElementById('id12').style.display='block'"><b>DIVISION-WISE SORTING</b></button>
    <button onclick="document.getElementById('id11').style.display='block'"><b>DATE-WISE SORTING</b></button>
    <button onclick="document.getElementById('id10').style.display='block'"><b>EMPLOYEE-WISE SORTING</b></button>
    <button onclick="document.getElementById('id13').style.display='block'"><b>EXPENDITURE INCCURED ON COURSES</b></button>
  </div>
<label class="lblbtn"><b>ACCOUNT DETAILS</b></label>
  <div class="btn-group">
    <button onclick="window.location.href='change_password.html'"><b>CHANGE PASSWORD</b></button>
    <button onclick="document.getElementById('id05').style.display='block'"><b>LOGOUT</b></button>
  </div>
</div>
<!-- /Vertical bar -->

 <!-- Table -->
  <div class="main">
<h3>Budget Forwarded Courses</h3>
    <table border="0" style="margin-top: 20px;" id="bud_course_table">
    <tr>
      <th style="cursor: pointer;" onclick="sortTablebud(0)">SNO</th>
      <th style="cursor: pointer;" onclick="sortTablebud(1)">Course ID</th> 
      <th style="cursor: pointer;" onclick="sortTablebud(2)">Course Name</th>
      <th style="cursor: pointer;" onclick="sortTablebud(3)">Employee ID</th>
      <th style="cursor: pointer;" onclick="sortTablebud(4)">Employee Name</th>
      <th style="cursor: pointer;" onclick="sortTablebud(5)">Course Fees</th>
      <th style="cursor: pointer;" onclick="sortTablebud(6)">Course Agency</th>
      <th style="cursor: pointer;">Remarks</th>
    </tr>
    <?php 
      $div_no = $_SESSION['division_no'];
      $retrieve_course_query = "SELECT mini_pis_details.ID, mini_pis_details.EMP_NAME, course.course_id, course.course_name, course.course_fees, course.course_agency, applied_course.remarks FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.budget_flag = 1 ORDER BY course.course_id DESC";
      $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
      $i=1;
      while($row = mysqli_fetch_array($course_result)) {
        if ($row['course_fees'] > '0') {
        
    ?>
    <tr class="bud_data" id="course_id_<?php echo $i; ?>" style="cursor: pointer;">
      <td><?php echo $i; ?></td>
      <td class="cid"><?php echo $row['course_id']; ?></td>
      <td><?php echo $row['course_name']; ?></td>
      <td class="eid"><?php echo $row['ID']; ?></td>
      <td><?php echo $row['EMP_NAME']; ?></td>
      <td><?php echo $row['course_fees']; ?></td>
      <td><?php echo $row['course_agency']; ?></td>
      <td><?php echo $row['remarks']; $i++; } } ?></td>
    </tr>
  </table>

<script>
   $(document).ready(function(){  
      $('.bud_data').click(function(){  
           var js_id = $(this).closest("tr").find(".cid").text();
           var js_eid = $(this).closest("tr").find(".eid").text();
           $.ajax({  
                url:"course_approval.php",  
                method:"post",  
                data:{js_id:js_id, js_eid:js_eid},  
                success:function(data){  
                     $('#modal_body_approve').html(data);  
                     $('#id03').modal("show");  
                }  
           });  
      });  
  });  
</script>
<script>
    $(document).ready(function(){
        $('#bud_course_table').after('<div id="nav_4" style = "position: relative; float: right;"></div>');
        var rowsShown = 11;
        var rowsTotal = $('#bud_course_table tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav_4').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#bud_course_table tbody tr').hide();
        $('#bud_course_table tbody tr').slice(0, rowsShown).show();
        $('#nav_4 a:first').addClass('active');
        $('#nav_4 a').bind('click', function(){

            $('#nav_4 a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#bud_course_table tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                    css('display','table-row').animate({opacity:1}, 300);
        });
    });
function sortTablebud(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("bud_course_table");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>


    <h3>HR Division Forwarded Courses</h3>
    <table border="0" style="margin-top: 20px;" id="applied_course_table">
    <tr>
      <th style="cursor: pointer;" onclick="sortTabledivhr(0)">SNO</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(1)">Course ID</th> 
      <th style="cursor: pointer;" onclick="sortTabledivhr(2)">Course Name</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(3)">Employee ID</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(4)">Employee Name</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(5)">Course Fees</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(6)">Course Agency</th>
      <th style="cursor: pointer;">Remarks</th>
    </tr>
    <?php 
      $div_no = $_SESSION['division_no'];
      $retrieve_course_query = "SELECT mini_pis_details.ID, mini_pis_details.EMP_NAME, course.course_id, course.course_name, course.course_fees, course.course_agency, applied_course.remarks FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.hr_flag = 1 ORDER BY course.course_id DESC";
      $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
      $i=1;
      while($row = mysqli_fetch_array($course_result)) {
        if ($row['course_fees'] == '0') {
        
    ?>
    <tr class="hr_data" id="course_id_<?php echo $i; ?>" style="cursor: pointer;">
      <td><?php echo $i; ?></td>
      <td class="cid"><?php echo $row['course_id']; ?></td>
      <td><?php echo $row['course_name']; ?></td>
      <td class="eid"><?php echo $row['ID']; ?></td>
      <td><?php echo $row['EMP_NAME']; ?></td>
      <td><?php echo $row['course_fees']; ?></td>
      <td><?php echo $row['course_agency']; ?></td>
      <td><?php echo $row['remarks']; $i++; } } ?></td>
    </tr>
  </table>

<script>
   $(document).ready(function(){  
      $('.hr_data').click(function(){  
           var js_id = $(this).closest("tr").find(".cid").text();
           var js_eid = $(this).closest("tr").find(".eid").text();
           $.ajax({  
                url:"course_approval.php",  
                method:"post",  
                data:{js_id:js_id, js_eid:js_eid},  
                success:function(data){  
                     $('#modal_body_approve').html(data);  
                     $('#id03').modal("show");  
                }  
           });  
      });  
  });  
</script>
<script>
    $(document).ready(function(){
        $('#applied_course_table').after('<div id="nav_3" style = "position: relative; float: right;"></div>');
        var rowsShown = 11;
        var rowsTotal = $('#applied_course_table tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav_3').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#applied_course_table tbody tr').hide();
        $('#applied_course_table tbody tr').slice(0, rowsShown).show();
        $('#nav_3 a:first').addClass('active');
        $('#nav_3 a').bind('click', function(){

            $('#nav_3 a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#applied_course_table tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                    css('display','table-row').animate({opacity:1}, 300);
        });
    });
function sortTabledivhr(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("applied_course_table");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
<!-- Table -->
   <h3>Main Course Table</h3>
    <table id="course_hr_table" border="0">
      <tr>
        <th style="cursor: pointer;" onclick="sortTable(0)">SNO</th>
        <th style="cursor: pointer;" onclick="sortTable(1)">Course ID</th> 
        <th style="cursor: pointer;" onclick="sortTable(2)">Course Name</th>
        <th style="cursor: pointer;" onclick="sortTable(3)">Start Date</th>
        <th style="cursor: pointer;" onclick="sortTable(4)">End Date</th>
        <th style="cursor: pointer;" onclick="sortTable(5)">Course Fees</th>
        <th style="cursor: pointer;" onclick="sortTable(6)">Course Agency</th>
        <th style="cursor: pointer;" onclick="sortTable(7)">Location</th>
      </tr>
      <?php 
        $retrieve_course_query = "SELECT * FROM course ORDER BY course_id DESC";
        $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
        $i=1;
        while($row = mysqli_fetch_array($course_result)) {
      ?>
      <tr class="view_data" style="cursor: pointer;">
        <td><?php echo $i; ?></td>
        <td class="co_id"><?php echo $row['course_id']; ?></td>
        <td><?php echo $row['course_name']; ?></td>
        <td><?php echo $row['course_period_start_date']; ?></td>
        <td><?php echo $row['course_period_end_date']; ?></td>
        <td><?php echo $row['course_fees']; ?></td>
        <td><?php echo $row['course_agency']; ?></td>
        <td><?php echo $row['location']; } ?></td>
      </tr>
    </table>
  <script>
$(document).ready(function(){  
      $('.view_data').click(function(){  
           var js_co_id = $(this).closest("tr").find(".co_id").text();
           $.ajax({  
                url:"course_view.php",  
                method:"post",  
                data:{js_co_id:js_co_id},  
                success:function(data){  
                     $('#modal_body').html(data);  
                     $('#id04').modal("show");  
                }  
           });  
      });  
  });

    $(document).ready(function(){
        $('#course_hr_table').after('<div id="nav" style = "position: relative; float: right;"></div>');
        var rowsShown = 11;
        var rowsTotal = $('#course_hr_table tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#course_hr_table tbody tr').hide();
        $('#course_hr_table tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#course_hr_table tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                    css('display','table-row').animate({opacity:1}, 300);
        });
    });
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("course_hr_table");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
  <!-- /Table -->

  <!-- Table -->
    <h3>Division-wise Course Table</h3>
    
    <?php
    if(isset($_POST['selector'])){
        $div = $_POST['selector'];
        }
        function getOptions($division,$divs){
        $options = '';
        while(list($k,$v)=each($divs)){
          if ($division == $v) {
            $options.= '<option selected>'.$v.'</option>';
          }
          else{
            $options.= '<option>'.$v.'</option>';
          }
          
        }
        return $options;
      }
      ?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <select id="selector" class="w3-select" style="width: 25%; border: 1px solid;" name="selector">
        <?php
        $divi_query = "SELECT DIV_CODE FROM divisionsu";
          $divi_res = mysqli_query($connection, $divi_query) or die(mysqli_error($connection));
          while ($dert = mysqli_fetch_array($divi_res)) {
            $fcs[] = $dert['DIV_CODE'];
          }
          $str = implode(",", $fcs);
          $divs = explode(",", $str);
          echo getOptions($div,$divs); ?>
      </select>
        <label for="person_name">&nbsp;&nbsp;From Date:</label>
           <input class="text_input" style="width: 20%; border: 1px solid;" type="Date" name="from_date" id="from_date" class="form-control" placeholder="From Date" />  
        <label for="person_name">&nbsp;&nbsp;To Date:</label>
           <input class="text_input" style="width: 20%; border: 1px solid;" type="Date" name="to_date" id="to_date" class="form-control" placeholder="To Date" /> 
           <input class="w3-button w3-black"  type="submit" name="filter" id="filter" value="Filter" class="btn btn-info" />
    </form>
      <?php
      if(isset($_POST['filter'],$_POST["from_date"], $_POST["to_date"])){
        $div = $_POST['selector'];
        $from_date = $_POST["from_date"];
        $to_date = $_POST["to_date"];
        $output = ''; 
        $output .= '<table id="course_hr_table_div" border="0">
      <tr>
        <th style="cursor: pointer;" onclick="sortTablediv(0)">SNO</th>
        <th style="cursor: pointer;" onclick="sortTablediv(1)">Course ID</th> 
        <th style="cursor: pointer;" onclick="sortTablediv(2)">Course Name</th>
        <th style="cursor: pointer;" onclick="sortTablediv(3)">Start Date</th>
        <th style="cursor: pointer;" onclick="sortTablediv(4)">End Date</th>
        <th style="cursor: pointer;" onclick="sortTablediv(5)">Course Fees</th>
        <th style="cursor: pointer;" onclick="sortTablediv(6)">Course Agency</th>
        <th style="cursor: pointer;" onclick="sortTablediv(7)">Location</th>
      </tr> 
    ';
    echo "<script>console.log('".$_POST["from_date"]."')</script>";
        if($_POST["from_date"]== ''){
           $retrieve_course_query = "SELECT * FROM course INNER JOIN course_div ON course.course_id = course_div.course_id INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID INNER JOIN divisionsu ON divisionsu.div_code = '$div' WHERE course_div.$div = 1  AND mini_pis_details.divi = divisionsu.div_no ORDER BY course.course_id DESC";
        }
        else{
          $retrieve_course_query = "SELECT * FROM course INNER JOIN course_div ON course.course_id = course_div.course_id INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID INNER JOIN divisionsu ON divisionsu.div_code = '$div' WHERE course_div.$div = 1  AND mini_pis_details.divi = divisionsu.div_no AND course.course_period_start_date BETWEEN '$from_date' AND '$to_date' ORDER BY course.course_id DESC";
        }
      $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
      $i=1;
      while($row = mysqli_fetch_array($course_result)) {
        $output .= '<tr class="view_data" style="cursor: pointer;">
        <td>'.$i.'</td>
        <td class="co_id">'.$row["course_id"].'</td>
        <td>'.$row["course_name"].'</td>
        <td>'.$row["course_period_start_date"].'</td>
        <td>'.$row["course_period_end_date"].'</td>
        <td>'.$row["ID"].'</td>
        <td>'.$row["EMP_NAME"].'</td>
        <td>'.$row["course_fees"].'</td>
        <td>'.$row["course_agency"].'</td>
        <td>'.$row["location"].'</td>
      </tr>';
      $i++;
      }
      $output .='</table>';
      echo $output;
      }
    ?>
  </div>
  <script>
    $(document).ready(function(){  
      $('.view_data').click(function(){  
           var js_co_id = $(this).closest("tr").find(".co_id").text();
           $.ajax({  
                url:"course_view.php",  
                method:"post",  
                data:{js_co_id:js_co_id},  
                success:function(data){  
                     $('#modal_body').html(data);  
                     $('#id04').modal("show");  
                }  
           });  
      });  
  });
    $(document).ready(function(){
        $('#course_hr_table_div').after('<div id="nav_2" style = "position: relative; float: right;"></div>');
        var rowsShown = 11;
        var rowsTotal = $('#course_hr_table_div tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav_2').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#course_hr_table_div tbody tr').hide();
        $('#course_hr_table_div tbody tr').slice(0, rowsShown).show();
        $('#nav_2 a:first').addClass('active');
        $('#nav_2 a').bind('click', function(){

            $('#nav_2 a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#course_hr_table_div tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                    css('display','table-row').animate({opacity:1}, 300);
        });
    });
function sortTablediv(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("course_hr_table_div");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
  <!-- /Table -->
</div>
<!-- /Body -->

<!-- Table Modal -->
<div class="w3-container">
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Notifications</h2>
      </header>
      <div style="padding: 12px">
        <h2>New Course</h2>
        <p>The following are the details of new course:</p>
        <table border="0">
          <tr>
            <th>SNO</th>
            <th>Course ID</th> 
            <th>Course Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Venue</th>
            <th>Organised By</th>
          </tr>
          <?php
            $div = $_SESSION['division'];
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT * FROM course INNER JOIN course_div ON course.course_id = course_div.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE course.login_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result_gd = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
            $course_count = mysqli_num_rows($course_result_gd);
            $i=1;
            while($row = mysqli_fetch_array($course_result_gd)) {
          ?>
          <tr class="dir_data_modal" id="course_id<?php echo $i; ?>" style="cursor: pointer;">
            <td><?php echo $i; ?></td>
            <td class="cid"><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td class="cdate"><?php echo $row['course_period_start_date']; ?></td>
            <td><?php echo $row['course_period_end_date']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['course_agency']; } ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){  
      $('.dir_data_modal').click(function(){  
           var js_id = $(this).closest("tr").find(".cid").text();
           var date_js = $(this).closest("tr").find(".cdate").text();
           $.ajax({  
                url:"course_application.php",  
                method:"post",  
                data:{js_id:js_id, date_js:date_js},  
                success:function(data){  
                     $('#modal_body_two').html(data);  
                     $('#id02').modal("show");  
                }  
           });  
      });  
  }); 
  var modal = document.getElementById('id01');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
  
</script>
<!-- /Table Modal -->

<!-- Table Modal -->
<div class="w3-container">
  <div id="id06" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id06').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Notifications</h2>
      </header>
      <div style="padding: 12px">
        <h2>Courses forwarded by Divisions</h2>
        <p>The following are the details of the recently forwarded courses:</p>
        <table border="0">
          <tr>
            <th>SNO</th>
            <th>Course ID</th> 
            <th>Course Name</th>
            <th>Start Date</th>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Venue</th>
            <th>Organised By</th>
          </tr>
          <?php
            $div = $_SESSION['division'];
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT * FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.gd_flag = 1 AND applied_course.gd_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result_gd = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
            $course_count = mysqli_num_rows($course_result_gd);
            $i=1;
            while($row = mysqli_fetch_array($course_result_gd)) {
          ?>
          <tr class="dir_data_modal" id="course_id<?php echo $i; ?>" style="cursor: pointer;">
            <td><?php echo $i; ?></td>
            <td class="cid"><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td class="cdate"><?php echo $row['course_period_start_date']; ?></td>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['EMP_NAME']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['course_agency']; } ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){  
      $('.dir_data_modal').click(function(){  
           var js_id = $(this).closest("tr").find(".cid").text();
           var date_js = $(this).closest("tr").find(".cdate").text();
           $.ajax({  
                url:"course_application.php",  
                method:"post",  
                data:{js_id:js_id, date_js:date_js},  
                success:function(data){  
                     $('#modal_body_two').html(data);
                     $('#id02').modal("show");
                }
           });
      });
  });
  var modal = document.getElementById('id06');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
  
</script>
<!-- /Table Modal -->

<!-- Table Modal -->
<div class="w3-container">
  <div id="id07" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id07').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Notifications</h2>
      </header>
      <div style="padding: 12px">
        <h2>Notification Details</h2>
        <p>The following are the details of nominations:</p>
        <table border="0">
          <tr>
            <th>SNO</th>
            <th>Course ID</th> 
            <th>Course Name</th>
            <th>Start Date</th>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Venue</th>
            <th>Organised By</th>
          </tr>
          <?php
            $div = $_SESSION['division'];
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT * FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.apply_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result_gd = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
            $course_count = mysqli_num_rows($course_result_gd);
            $i=1;
            while($row = mysqli_fetch_array($course_result_gd)) {
          ?>
          <tr class="view_data_modal" style="cursor: pointer;">
            <td><?php echo $i; ?></td>
            <td class="co_id"><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td ><?php echo $row['course_period_start_date']; ?></td>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['EMP_NAME']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['course_agency']; } ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){  
      $('.view_data_modal').click(function(){  
           var js_co_id = $(this).closest("tr").find(".co_id").text();
           $.ajax({  
                url:"course_view.php",  
                method:"post",  
                data:{js_co_id:js_co_id},  
                success:function(data){  
                     $('#modal_body').html(data);  
                     $('#id04').modal("show");  
                }  
           });  
      });  
  });
  var modal = document.getElementById('id07');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
  
</script>
<!-- /Table Modal -->

<!-- Table Modal -->
<div class="w3-container">
  <div id="id08" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id08').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Notifications</h2>
      </header>
      <div style="padding: 12px">
        <h2>Courses forwarded by HR Division</h2>
        <p>The following are the details of the recently forwarded courses:</p>
        <table border="0" id="course_table">
          <tr>
            <th>SNO</th>
            <th>Course ID</th> 
            <th>Course Name</th>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Course Fees</th>
            <th>Organised By</th>
          </tr>
          <?php
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT mini_pis_details.ID, mini_pis_details.EMP_NAME, course.course_id, course.course_name, course.course_fees, course.course_agency FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.hr_flag = 1 AND applied_course.hr_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
          ?>
           <tr class="hr_data_modal" id="course_id_<?php echo $i; ?>" style="cursor: pointer;">
            <td><?php echo $i; ?></td>
            <td class="cid"><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td class="eid"><?php echo $row['ID']; ?></td>
            <td><?php echo $row['EMP_NAME']; ?></td>
            <td><?php echo $row['course_fees']; ?></td>
            <td><?php echo $row['course_agency']; $i++; } ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){  
      $('.hr_data_modal').click(function(){  
           var js_id = $(this).closest("tr").find(".cid").text();
           var js_eid = $(this).closest("tr").find(".eid").text();
           $.ajax({  
                url:"course_approval.php",  
                method:"post",  
                data:{js_id:js_id, js_eid:js_eid},  
                success:function(data){  
                     $('#modal_body_approve').html(data);  
                     $('#id03').modal("show");  
                }  
           });  
      });  
  }); 
  var modal = document.getElementById('id08');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
  
</script>
<!-- /Table Modal -->

<!-- Table Modal -->
<div class="w3-container">
  <div id="id09" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id09').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Notifications</h2>
      </header>
      <div style="padding: 12px">
        <h2>Courses forwarded by Budget</h2>
        <p>The following are the details of the recently forwarded courses:</p>
        <table border="0">
          <tr>
            <th>SNO</th>
            <th>Course ID</th> 
            <th>Course Name</th>
            <th>Start Date</th>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Venue</th>
            <th>Organised By</th>
          </tr>
          <?php
            $div = $_SESSION['division'];
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT * FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.budget_flag = 1 AND applied_course.budget_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result_gd = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
            $course_count = mysqli_num_rows($course_result_gd);
            $i=1;
            while($row = mysqli_fetch_array($course_result_gd)) {
          ?>
          <tr class="bud_data_modal" id="course_id<?php echo $i; ?>" style="cursor: pointer;">
            <td><?php echo $i; ?></td>
            <td class="bud_cid"><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td class="bud_cdate"><?php echo $row['course_period_start_date']; ?></td>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['EMP_NAME']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['course_agency']; } ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){  
      $('.bud_data_modal').click(function(){  
           var js_id = $(this).closest("tr").find(".bud_cid").text();
           var date_js = $(this).closest("tr").find(".bud_cdate").text();
           $.ajax({  
                url:"course_application.php",  
                method:"post",
                data:{js_id:js_id, date_js:date_js},  
                success:function(data){  
                     $('#modal_body_two').html(data);  
                     $('#id02').modal("show");  
                }  
           });  
      });  
  }); 
  var modal = document.getElementById('id09');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
</script>
<!-- /Table Modal -->

<!-- Table Modal -->
<div class="w3-container">
  <div id="id10" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id10').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Report</h2>
      </header>
      <div style="padding: 12px">
        <h2>Employee-Wise Sorting</h2>
        <p>The following are the details of the employee-wise sorted courses:</p>
        <label for="person_name">&nbsp;&nbsp;Enter Employee Name:</label>
           <input class="text_input" style="width: 20%; border: 1px solid;" type="text" name="emp_name" id="emp_name"/>  
           <div id="emp_div"></div>
           <input class="w3-button w3-black" type="submit" name="emp_filter_modal" id="emp_filter_modal" value="Filter" class="btn btn-info"/>
      <div id="emp_filter"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
  $('#emp_name').keyup(function(){
    var emp_name_query = $(this).val();
    if (emp_name_query!= '') {
      $.ajax({  
          url:"search.php",  
          method:"post",  
          data:{emp_name_query:emp_name_query},  
          success:function(data){  
            $('#emp_div').fadeIn();  
            $('#emp_div').html(data);  
          }  
     });  
    }
    else{
      $('#emp_div').fadeOut();  
      $('#emp_div').html("");
    }
  });
  $(document).on('click','#co_emp', function(){
    $('#emp_name').val($(this).text());
    $('#emp_div').fadeOut();
  });
});
   $(document).ready(function(){  
      $('#emp_filter_modal').click(function(){  
           var emp_name = $('#emp_name').val();
           $.ajax({  
                url:"emp_filter.php",  
                method:"post",
                data:{emp_name:emp_name},  
                success:function(data){  
                     $('#emp_filter').html(data); 
                }  
           });  
      });  
  }); 
  var modal = document.getElementById('id10');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
</script>
<!-- /Table Modal -->

<!-- Table Modal -->
<div class="w3-container">
  <div id="id11" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id11').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Report</h2>
      </header>
      <div style="padding: 12px">
        <h2>Date-Wise Sorting</h2>
        <p>The following are the details of the date-wise sorted courses:</p>
         
        <label for="person_name">&nbsp;&nbsp;From Date:</label>
           <input class="text_input" style="width: 20%; border: 1px solid;" type="Date" name="from_date_modal" id="from_date_modal" class="form-control" placeholder="From Date" />  
        <label for="person_name">&nbsp;&nbsp;To Date:</label>
           <input class="text_input" style="width: 20%; border: 1px solid;" type="Date" name="to_date_modal" id="to_date_modal" class="form-control" placeholder="To Date" /> 
           <input class="w3-button w3-black"  type="submit" name="filter_modal" id="filter_modal" value="Filter" class="btn btn-info"/>
      <div id="date_filter"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){  
      $('#filter_modal').click(function(){  
           var date = new Date($('#from_date_modal').val());
           day = date.getDate();
           month = date.getMonth() + 1;
           year = date.getFullYear();
           from_date_modal = [year, month, day].join('-');
           var to_date= new Date($('#to_date_modal').val());
           to_day = to_date.getDate();
           to_month = to_date.getMonth() + 1;
           to_year = to_date.getFullYear();
           to_date_modal = [to_year, to_month, to_day].join('-');
           $.ajax({  
                url:"date_filter.php",  
                method:"post",
                data:{from_date_modal:from_date_modal, to_date_modal:to_date_modal},  
                success:function(data){  
                     $('#date_filter').html(data); 
                }  
           });  
      });  
  }); 
  var modal = document.getElementById('id11');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
</script>
<!-- /Table Modal -->

<!-- Division wise sorting modal -->
<div class="w3-container">
  <div id="id12" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id12').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Report</h2>
      </header>
      <div style="padding: 12px">
        <h2>Division-wise Sorting</h2>
        <p>The following is the representation of the division and applied employee data: </p>
        <div id="piechart_3d" align="center"></div>
          <?php 
          $column_query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'course_div'";
          $column_res = mysqli_query($connection, $column_query) or die(mysqli_error($connection)); 
          while ($row = mysqli_fetch_array($column_res)) {
            $division_code[] = $row['COLUMN_NAME'];
            $temp = $row['COLUMN_NAME'];
            $count_query = "SELECT COUNT(*) FROM course_div WHERE $temp = 1";  
            $count_res = mysqli_query($connection, $count_query) or die(mysqli_error($connection)); 
            while ($col = mysqli_fetch_array($count_res)) {
              $div_count[] = $col['COUNT(*)'];
            }
          }
          ?>
          <p>The following are the tabular details:</p>
        <table border="0">
          <tr>
            <th>Division</th>
            <th>Number of Employees</th> 
          </tr>
            <?php
            for($i=2, $k=2; $i<=sizeof($division_code)-1; $i++, $k++){
            echo "<tr><td>".$division_code[$i]."</td>
            <td>".$div_count[$k]."</td></tr>";
            }
            ?>
        </table>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var modal = document.getElementById('id12');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
</script>
<script type="text/javascript" src="loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Divisions', 'Number of Employees'],
          <?php
            for($i=2, $k=2; $i<=sizeof($division_code)-1; $i++, $k++){
              echo "['".$division_code[$i]."',".$div_count[$k]."],";
            }
          ?>
        ]);

        var options = {
          title: 'Division-wise Sorting',
          chartArea:{width:"100%",height:"100%"},
          width: 500,
          height: 500,
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
<!-- /Division wise sorting modal -->

<!-- Table Modal -->
<div class="w3-container">
  <div id="id13" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id13').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Report</h2>
      </header>
      <div style="padding: 12px">
        <h2>Total Amount</h2>
        <p>The following are the details of the amount spent on courses:</p>
         
        <label for="person_name">&nbsp;&nbsp;From Date:</label>
           <input class="text_input" style="width: 20%; border: 1px solid;" type="Date" name="from_date_modal_amt" id="from_date_modal_amt" class="form-control" placeholder="From Date" />  
        <label for="person_name">&nbsp;&nbsp;To Date:</label>
           <input class="text_input" style="width: 20%; border: 1px solid;" type="Date" name="to_date_modal_amt" id="to_date_modal_amt" class="form-control" placeholder="To Date" /> 
           <input class="w3-button w3-black"  type="submit" name="filter_modal_amt" id="filter_modal_amt" value="Filter" class="btn btn-info"/>
      <div id="date_filter_amt"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){  
      $('#filter_modal_amt').click(function(){  
           var date = new Date($('#from_date_modal_amt').val());
           day = date.getDate();
           month = date.getMonth() + 1;
           year = date.getFullYear();
           from_date_modal_amt = [year, month, day].join('-');
           var to_date= new Date($('#to_date_modal_amt').val());
           to_day = to_date.getDate();
           to_month = to_date.getMonth() + 1;
           to_year = to_date.getFullYear();
           to_date_modal_amt = [to_year, to_month, to_day].join('-');
           $.ajax({  
                url:"date_filter_amt.php",  
                method:"post",
                data:{from_date_modal_amt:from_date_modal_amt, to_date_modal_amt:to_date_modal_amt},  
                success:function(data){  
                     $('#date_filter_amt').html(data); 
                }  
           });  
      });  
  }); 
  var modal = document.getElementById('id13');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
</script>
<!-- /Table Modal -->

<!-- Approve Modal -->
<div class="w3-container">
  <div id="id03" class="w3-modal">
   <div class="w3-modal-content w3-card-4 w3-animate-zoom">
    <header class="w3-container w3-drdo-blue"> 
      <span onclick="document.getElementById('id03').style.display='none'" data-dismiss="modal" class="w3-button w3-drdo-blue w3-xlarge  w3-display-topright">&times;</span>
      <h2>Course Approval</h2>
    </header>
    <div id="modal_body_approve" style="padding: 12px">
    </div> 
     <div class="w3-container w3-light-grey w3-padding">
    <form action="dir_approve_course.php" method="post" target="_blank">
        <input type="submit" name="approve" id="approve" value="Approve" class="w3-button w3-right w3-white w3-border" onclick="document.getElementById('id03').style.display='none'; window.location.reload();">
        <input type="submit" name="disapprove" id="disapprove" value="Disapprove" class="w3-button w3-right w3-drdo-red w3-border" onclick="document.getElementById('id03').style.display='none';window.location.reload();">
      </form> 
      </div>
   </div>
  </div>
</div>
<script>
  var modal2 = document.getElementById('id03');
  window.onclick = function(event) {
    if (event.target == modal2) {
      modal2.style.display = "none";
    }
  }
</script>
<!-- /Approve Modal -->

<!-- Apply Modal -->
<div class="w3-container">
  <div id="id02" class="w3-modal">
   <div class="w3-modal-content w3-card-4 w3-animate-zoom">
    <header class="w3-container w3-drdo-blue"> 
      <span onclick="document.getElementById('id02').style.display='none'" data-dismiss="modal" class="w3-button w3-drdo-blue w3-xlarge  w3-display-topright">&times;</span>
      <h2>Notification</h2>
    </header>
    <div id="modal_body_two" style="padding: 12px">
    </div> 
   </div>
  </div>
</div>
<script>
  var modal2 = document.getElementById('id02');
  window.onclick = function(event) {
    if (event.target == modal2) {
      modal2.style.display = "none";
    }
  }
</script>
<!-- /Apply Modal -->

<!-- Apply Modal -->
<div class="w3-container">
  <div id="id04" class="w3-modal">
   <div class="w3-modal-content w3-card-4 w3-animate-zoom">
    <header class="w3-container w3-drdo-blue"> 
      <span onclick="document.getElementById('id04').style.display='none'" data-dismiss="modal" class="w3-button w3-drdo-blue w3-xlarge  w3-display-topright">&times;</span>
      <h2>Notification</h2>
    </header>
    <div id="modal_body" style="padding: 12px">
    </div>
   </div>
  </div>
</div>
<script>
  var modal2 = document.getElementById('id04');
  window.onclick = function(event) {
    if (event.target == modal2) {
      modal2.style.display = "none";
    }
  }
</script>

<!-- Logout Modal -->
<div class="w3-container">
  <div id="id05" class="w3-modal">
   <div class="w3-modal-content w3-card-4 w3-animate-zoom">
    <header class="w3-container w3-drdo-blue"> 
      <span onclick="document.getElementById('id05').style.display='none'" data-dismiss="modal" class="w3-button w3-drdo-blue w3-xlarge  w3-display-topright">&times;</span>
      <h2>Logout / Other Login</h2>
    </header>
    <div style="padding: 12px">
      <p>Are you sure you want to quit?</p>
    </div>
      <div class="w3-container w3-light-grey w3-padding">
        <form action="logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout" class="w3-button w3-right w3-white w3-border" onclick="document.getElementById('id05').style.display='none';">
        </form> 
        <input type="submit" name="cancel" id="cancel" value="Cancel" class="w3-button w3-right w3-drdo-red w3-border" onclick="document.getElementById('id05').style.display='none';">
      </div>
   </div>
  </div>
</div>
<script>
  var modal2 = document.getElementById('id05');
  window.onclick = function(event) {
    if (event.target == modal2) {
      modal2.style.display = "none";
    }
  }
</script>
<!-- /Logout Modal -->

</body>
</html>
<?php
$update_query = "UPDATE user_login SET last_login = CURRENT_TIMESTAMP WHERE id = '$id';";
            $up_result = mysqli_query($connection, $update_query) or die(mysqli_error($connection));
?>