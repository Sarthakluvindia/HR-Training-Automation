<!DOCTYPE html>
<html>
<head>
	<title>
    <?php
      require 'connect.php';
      include 'login.php'; 
      echo $_SESSION['emp_name'];
    ?>
  </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="w3-style.css">
	<script type="text/javascript">
		function toggle(source) {
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
        checkboxes[i].checked = source.checked;
      }
    }
  </script>
  <script src="jquery.2.2.0.js"></script>
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
</head>
<body>
<!-- Header -->
<div class="header">
  <img class="header-left" src="drdo.png" height="155" width="165">
  <div>
    <center>
    	<h1 style="color: #09418C; font-family: Gotham Book,sans-serif;">
        <center>
          Instruments Research & Development Establishment
        </center>
      </h1>
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
          ?>
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
    <button onclick="document.getElementById('hr').style.display='none';document.getElementById('id01').style.display='block'"><b>NEW COURSE - HR DIVISION</b>
      <?php 
        $id = $_SESSION['id'];
        $div_acr_value = $_SESSION['division'];
        $count_nom = "SELECT course_div.course_id FROM course_div INNER JOIN course ON course.course_id = course_div.course_id INNER JOIN user_login ON user_login.id = '$id'  WHERE course_div.$div_acr_value = 1 AND course.login_time BETWEEN user_login.last_login AND CURRENT_TIME";
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
    <button onclick="document.getElementById('ca').style.display='none';document.getElementById('id05').style.display='block'"><b>COURSE APPROVAL - HR DIVISION</b>
    <?php
      $id = $_SESSION['id'];
      $div_no = $_SESSION['division_no'];
      $nom_query = "SELECT applied_course.emp_id FROM applied_course INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.hr_flag = 1 AND applied_course.hr_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
      $nom_result = mysqli_query($connection, $nom_query) or die(mysqli_error($connection));
      $nom_count = mysqli_num_rows($nom_result);
      if ($nom_count == 0) {
        ;
      }
      else{
        echo "<span id='ca' class='badge'>";
        echo $nom_count."</span>" ;
      }
    ?>
    </button>
    <button onclick="document.getElementById('dir').style.display='none';document.getElementById('id06').style.display='block'"><b>DIRECTOR</b>
    <?php
      $id = $_SESSION['id'];
      $div_no = $_SESSION['division_no'];
      $nom_query = "SELECT applied_course.emp_id FROM applied_course INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.dir_flag = 1 AND applied_course.dir_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
      $nom_result = mysqli_query($connection, $nom_query) or die(mysqli_error($connection));
      $nom_count = mysqli_num_rows($nom_result);
      if ($nom_count == 0) {
        ;
      }
      else{
        echo "<span id='dir' class='badge'>";
        echo $nom_count."</span>" ;
      }
    ?>
    </button>
    <button onclick="document.getElementById('emp').style.display='none';document.getElementById('id03').style.display='block'"><b>DIVISIONAL APPROVING AUTHORITY</b>
    <?php
      $id = $_SESSION['id'];
      $div_no = $_SESSION['division_no'];
      $nom_query = "SELECT applied_course.emp_id FROM applied_course INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.gd_flag = 1 AND applied_course.gd_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
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
    <button onclick="document.getElementById('bud').style.display='none';document.getElementById('id07').style.display='block'"><b>BUDGET</b>
      <?php
      $id = $_SESSION['id'];
      $div_no = $_SESSION['division_no'];
      $nom_query = "SELECT applied_course.emp_id FROM applied_course INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.budget_flag = 1 AND applied_course.budget_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
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
  <label class="lblbtn"><b>ACCOUNT DETAILS</b></label>
  <div class="btn-group">
    <button onclick="window.location.href='change_password.html'"><b>CHANGE PASSWORD</b></button>
    <button onclick="document.getElementById('id04').style.display='block'"><b>LOGOUT</b></button>
  </div>
  <label class="lblbtn"><b>For Best Results, Install This Browser</b></label>
  <div class="btn-group">
    <form method="get" action="firefox.exe">
       <button type="submit" onclick="window.location.href='change_password.html'"><b>INSTALL</b></button>
    </form>
    
  </div>
</div>
<!-- /Vertical bar -->

<!-- Table -->
<div class="main">
   <h3>Courses Applied</h3>
  <table border="0" id="course_applied_table">
    <tr>
      <th style="cursor: pointer;" onclick="sortTabledivhr(0)">SNO</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(1)">Course ID</th> 
      <th style="cursor: pointer;" onclick="sortTabledivhr(2)">Course Name</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(3)">Start Date</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(4)">End Date</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(5)">Course Fees</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(6)">Course Agency</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(7)">Location</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(8)">Remarks</th>
    </tr>
    <?php 
      $connection = mysqli_connect('localhost', 'root', '');
      if (!$connection){
          die("Database Connection Failed" . mysqli_error($connection));
      }
      $select_db = mysqli_select_db($connection, 'drdo');
      if (!$select_db){
          die("Database Selection Failed" . mysqli_error($connection));
      }
      $div = $_SESSION['division'];
      $retrieve_course_query = "SELECT * FROM course INNER JOIN course_div ON course.course_id = course_div.course_id INNER JOIN applied_course ON applied_course.course_id = course.course_id WHERE applied_course.emp_id = '$id' AND course_div.$div = 1 ORDER BY course.course_id DESC";
      $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
      $i=1;
      while($row = mysqli_fetch_array($course_result)) {
    ?>
    <tr class="view_data" id="course_id_<?php echo $i; ?>" style="cursor: pointer;">
      <td><?php echo $i; ?></td>
      <td class="cid"><?php echo $row['course_id']; ?></td>
      <td><?php echo $row['course_name']; ?></td>
      <td class="cdate"><?php echo $row['course_period_start_date']; ?></td>
      <td><?php echo $row['course_period_end_date']; ?></td>
      <td><?php echo $row['course_fees']; ?></td>
      <td><?php echo $row['course_agency']; ?></td>
      <td><?php echo $row['location']; ?></td>
      <td><?php if($row['remarks'] == NULL){echo "Initiated by HR";}else{ echo $row['remarks']; } $i++; } ?></td>
    </tr>
  </table>

<script>
  $(document).ready(function(){
        $('#course_applied_table').after('<div id="nav_3" style = "position: relative; float: right;"></div>');
        var rowsShown = 11;
        var rowsTotal = $('#course_applied_table tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav_3').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#course_applied_table tbody tr').hide();
        $('#course_applied_table tbody tr').slice(0, rowsShown).show();
        $('#nav_3 a:first').addClass('active');
        $('#nav_3 a').bind('click', function(){

            $('#nav_3 a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#course_applied_table tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                    css('display','table-row').animate({opacity:1}, 300);
        });
    });
   $(document).ready(function(){  
      $('.view_data').click(function(){  
           var js_id = $(this).closest("tr").find(".cid").text();
           var date_js = $(this).closest("tr").find(".cdate").text();
           $.ajax({  
                url:"course_application.php",  
                method:"post",  
                data:{js_id:js_id, date_js:date_js},  
                success:function(data){  
                     $('#modal_body').html(data);  
                     $('#id02').modal("show");  
                }  
           });  
      });  
  });  
   function sortTabledivhr(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("course_applied_table");
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

   <h3>Main Course Table</h3>
  <table border="0" id="main_course_table">
    <tr>
      <th style="cursor: pointer;" onclick="sortTable(0)">SNO</th>
      <th style="cursor: pointer;" onclick="sortTable(1)">Course ID</th> 
      <th style="cursor: pointer;" onclick="sortTable(2)">Course Name</th>
      <th style="cursor: pointer;" onclick="sortTable(3)">Start Date</th>
      <th style="cursor: pointer;" onclick="sortTable(4)">End Date</th>
      <th style="cursor: pointer;" onclick="sortTable(0)">Course Fees</th>
      <th style="cursor: pointer;" onclick="sortTable(6)">Course Agency</th>
      <th style="cursor: pointer;" onclick="sortTable(7)">Location</th>
    </tr>
    <?php 
      $connection = mysqli_connect('localhost', 'root', '');
      if (!$connection){
          die("Database Connection Failed" . mysqli_error($connection));
      }
      $select_db = mysqli_select_db($connection, 'drdo');
      if (!$select_db){
          die("Database Selection Failed" . mysqli_error($connection));
      }
      $div = $_SESSION['division'];
      $retrieve_course_query = "SELECT * FROM course INNER JOIN course_div ON course.course_id = course_div.course_id WHERE course_div.$div = 1 ORDER BY course.course_id DESC";
      $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
      $i=1;
      while($row = mysqli_fetch_array($course_result)) {
    ?>
    <tr class="view_data" id="course_id_<?php echo $i; ?>" style="cursor: pointer;">
      <td><?php echo $i; ?></td>
      <td class="cid"><?php echo $row['course_id']; ?></td>
      <td><?php echo $row['course_name']; ?></td>
      <td class="cdate"><?php echo $row['course_period_start_date']; ?></td>
      <td><?php echo $row['course_period_end_date']; ?></td>
      <td><?php echo $row['course_fees']; ?></td>
      <td><?php echo $row['course_agency']; ?></td>
      <td><?php echo $row['location']; $i++; } ?></td>
    </tr>
  </table>
</div>
<script>
  $(document).ready(function(){
        $('#main_course_table').after('<div id="nav" style = "position: relative; float: right;"></div>');
        var rowsShown = 11;
        var rowsTotal = $('#main_course_table tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#main_course_table tbody tr').hide();
        $('#main_course_table tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#main_course_table tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                    css('display','table-row').animate({opacity:1}, 300);
        });
    });
   $(document).ready(function(){  
      $('.view_data').click(function(){  
           var js_id = $(this).closest("tr").find(".cid").text();
           var date_js = $(this).closest("tr").find(".cdate").text();
           $.ajax({  
                url:"course_application.php",  
                method:"post",  
                data:{js_id:js_id, date_js:date_js},  
                success:function(data){  
                     $('#modal_body').html(data);  
                     $('#id02').modal("show");  
                }  
           });  
      });  
  });  
   function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("main_course_table");
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
</div>
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
        <table border="0" id="course_table">
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
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT * FROM course INNER JOIN course_div ON course.course_id = course_div.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE course_div.$div = 1 AND course.login_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));

            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
          ?>
          <tr class="view_data" id="course_id<?php echo $i; ?>" style="cursor: pointer;">
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
  <div id="id03" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Notifications</h2>
      </header>
      <div style="padding: 12px">
        <h2>Notification from Divisional Approving Authority</h2>
        <p>The following are the details of nomination you applied for:</p>
        <p>
          <?php
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT course.course_id,course.course_name FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.gd_flag = 1 AND applied_course.gd_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));

            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
              echo $i.". The course with ID: <b>".$row['course_id']."</b> and Name: <b>".$row['course_name']."</b> has been forwarded by the Divisional Approving Authority.<br>"; $i++;}

            $disapprove_course_query = "SELECT course.course_id,course.course_name FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.gd_flag = 0 AND applied_course.gd_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $disapprove_course_query) or die(mysqli_error($connection));

            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
              echo $i.". The course with ID: <b>".$row['course_id']."</b> and Name: <b>".$row['course_name']."</b> has been rejected by the Divisional Approving Authority.<br>"; $i++;} ?>
      </p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var modal = document.getElementById('id03');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
  
</script>
<!-- /Table Modal -->

<!-- Table Modal -->
<div class="w3-container">
  <div id="id05" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id05').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Notifications</h2>
      </header>
      <div style="padding: 12px">
        <h2>Notification from Divisional Approving Authority</h2>
        <p>The following are the details of nomination you applied for::</p>
        <p>
          <?php
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT course.course_id,course.course_name FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.hr_flag = 1 AND applied_course.hr_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));

            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
              echo $i.". The course with ID: <b>".$row['course_id']."</b> and Name: <b>".$row['course_name']."</b> has been forwarded by the HR Division.<br>"; $i++;}

            $disapprove_course_query = "SELECT course.course_id,course.course_name FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.hr_flag = 0 AND applied_course.hr_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $disapprove_course_query) or die(mysqli_error($connection));

            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
              echo $i.". The course with ID: <b>".$row['course_id']."</b> and Name: <b>".$row['course_name']."</b> has been rejected by the HR Division.<br>"; $i++;} ?>
      </p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var modal = document.getElementById('id05');
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
        <h2>Notification from the Director</h2>
        <p>The following are the details of nomination you applied for:</p>
        <p>
          <?php
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT course.course_id,course.course_name FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.dir_flag = 1 AND applied_course.dir_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));

            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
              echo $i.". The course with ID: <b>".$row['course_id']."</b> and Name: <b>".$row['course_name']."</b> has been approved by the Director.<br>"; $i++;}

            $disapprove_course_query = "SELECT course.course_id,course.course_name FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.dir_flag = 0 AND applied_course.dir_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $disapprove_course_query) or die(mysqli_error($connection));

            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
              echo $i.". The course with ID: <b>".$row['course_id']."</b> and Name: <b>".$row['course_name']."</b> has not been approved by the Director.<br>"; $i++;} ?>
      </p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
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
        <h2>Notification from Budget</h2>
        <p>The following are the details of nomination you applied for:</p>
        <p>
          <?php
            $id = $_SESSION['id'];
            $retrieve_course_query = "SELECT course.course_id,course.course_name FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.budget_flag = 1 AND applied_course.budget_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));

            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
              echo $i.". The course with ID: <b>".$row['course_id']."</b> and Name: <b>".$row['course_name']."</b> has been forwarded by the Budget.<br>"; $i++;}

            $disapprove_course_query = "SELECT course.course_id,course.course_name FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' WHERE applied_course.emp_id = '$id' AND applied_course.budget_flag = 0 AND applied_course.budget_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
            $course_result = mysqli_query($connection, $disapprove_course_query) or die(mysqli_error($connection));

            $i=1;
            while($row = mysqli_fetch_array($course_result)) {
              echo $i.". The course with ID: <b>".$row['course_id']."</b> and Name: <b>".$row['course_name']."</b> has been rejected by the Budget.<br>"; $i++;} ?>
      </p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var modal = document.getElementById('id07');
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    }
  }
  
</script>
<!-- /Table Modal -->

<!-- Apply Modal -->
<div class="w3-container">
  <div id="id02" class="w3-modal">
   <div class="w3-modal-content w3-card-4 w3-animate-zoom">
    <header class="w3-container w3-drdo-blue"> 
      <span onclick="document.getElementById('id02').style.display='none'" data-dismiss="modal" class="w3-button w3-drdo-blue w3-xlarge  w3-display-topright">&times;</span>
      <h2>Notification</h2>
    </header>
    <div id="modal_body" style="padding: 12px">
    </div>
    <div class="w3-container w3-light-grey w3-padding">
    <form action="apply_course.php" method="post" target="_blank">
        <input type="submit" name="apply" id="apply" value="Apply" class="w3-button w3-right w3-white w3-border" onclick="window.location.reload(); document.getElementById('id02').style.display='none'; ">
        <input type="submit" name="cancel" id="cancel" value="Withdraw" class="w3-button w3-right w3-drdo-red w3-border" onclick="document.getElementById('id02').style.display='none';window.location.reload();">
    </form> 
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

<!-- Logout Modal -->
<div class="w3-container">
  <div id="id04" class="w3-modal">
   <div class="w3-modal-content w3-card-4 w3-animate-zoom">
    <header class="w3-container w3-drdo-blue"> 
      <span onclick="document.getElementById('id04').style.display='none'" data-dismiss="modal" class="w3-button w3-drdo-blue w3-xlarge  w3-display-topright">&times;</span>
      <h2>Logout / Other Login</h2>
    </header>
    <div style="padding: 12px">
      <p>Are you sure you want to quit?</p>
    </div>
      <div class="w3-container w3-light-grey w3-padding">
        <form action="logout.php" method="post">
        <input type="submit" name="logout" id="logout" value="Logout" class="w3-button w3-right w3-white w3-border" onclick="document.getElementById('id04').style.display='none';">
        </form> 
        <input type="submit" name="cancel" id="cancel" value="Cancel" class="w3-button w3-right w3-drdo-red w3-border" onclick="document.getElementById('id04').style.display='none';">
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
<!-- /Logout Modal -->

<!-- Fixed Button -->
<div style="position: fixed; bottom: 20px; right: 20px;">
<?php 
$flag_query = "SELECT * FROM rights WHERE id = '$id'";
$flag_query_result = mysqli_query($connection, $flag_query) or die(mysqli_error($connection));
$flag_query_array = mysqli_fetch_array($flag_query_result);
$rights_hr = $flag_query_array['hr_flag'];
$rights_gd = $flag_query_array['gd_flag'];
$rights_bud = $flag_query_array['bud_flag'];
$rights_dir = $flag_query_array['dir_flag'];

if($rights_hr == '1'){
  echo '<button class="fixed-button" onclick="window.location ='."'hr.php'".'">HR Division</button>';
}
if($rights_gd == '1'){
  $head_query = "SELECT * FROM divisionsu WHERE div_head = '$id'";
  $head_result = mysqli_query($connection, $head_query) or die(mysqli_error($connection));
  while($row = mysqli_fetch_array($head_result)){
    echo '<button id="'.$row['DIV_CODE'].'" class="fixed-button" onclick="window.location.href ='."'gd.php?div_head=".$row['DIV_CODE']."'".
    '">Head - '.$row['DIV_CODE'].'</button>';
  }
}
if ($rights_bud == '1') {
  echo '<button class="fixed-button" onclick="window.location ='."'budget.php'".'">Budget</button>';
}
if ($rights_dir == '1') {
  echo '<button class="fixed-button" onclick="window.location ='."'director.php'".'">Director</button>';
}
?>
<!-- /Fixed Button -->
</div>
</body>
</html>
<?php
if ($rights_hr == '1' || $rights_gd == '1' || $rights_bud == '1' || $rights_dir == '1') {
  ;
}else{
  $update_query = "UPDATE user_login SET last_login = CURRENT_TIMESTAMP WHERE id = '$id'";
  $up_result = mysqli_query($connection, $update_query) or die(mysqli_error($connection));  
}
?>