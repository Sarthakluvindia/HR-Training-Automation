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
      require 'connect.php';
      echo $_SESSION['emp_name'];
    ?>
  </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="w3-style.css">
  <link rel="stylesheet" href="jquery-ui.css">
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

	<script type="text/javascript">
		function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
    </script>

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
          ?><br>Budget
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
<div class="btn-group">
  <label class="lblbtn"><b>NOTIFICATIONS</b></label> 
  <button onclick="document.getElementById('hr').style.display='none';document.getElementById('id08').style.display='block'"><b>HR DIVISION</b>
    <?php
      $id = $_SESSION['id'];
      $div_no = $_SESSION['division_no'];
      $nom_query = "SELECT mini_pis_details.ID, mini_pis_details.EMP_NAME, course.course_id, course.course_name, course.course_fees, course.course_agency, course.course_fees FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID INNER JOIN user_login ON user_login.id = '$id' WHERE course.course_fees > '0' AND applied_course.hr_flag = 1 AND applied_course.hr_approve_time BETWEEN user_login.last_login AND CURRENT_TIME";
      $nom_result = mysqli_query($connection, $nom_query) or die(mysqli_error($connection));
      $nom_count = mysqli_num_rows($nom_result);
      if ($nom_count == 0) {
        ;
      }
      else{
        echo "<span id='hr' class='badge'>";
        echo $nom_count."</span>";
      }
    ?>
  </button>
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
  <h3>HR Forwarded Courses</h3>
    <table border="0" style="margin-top: 20px;" id="applied_course_table">
    <tr>
      <th style="cursor: pointer;" onclick="sortTabledivhr(0)">SNO</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(1)">Course ID</th> 
      <th style="cursor: pointer;" onclick="sortTabledivhr(2)">Course Name</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(3)">Employee ID</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(4)">Employee Name</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(5)">Course Fees</th>
      <th style="cursor: pointer;" onclick="sortTabledivhr(6)">Course Agency</th>
      <th style="cursor: pointer;">Course Agency</th>
    </tr>
    <?php 
      $div_no = $_SESSION['division_no'];
      $retrieve_course_query = "SELECT mini_pis_details.ID, mini_pis_details.EMP_NAME, course.course_id, course.course_name, course.course_fees, course.course_agency, course.course_fees, applied_course.remarks FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.hr_flag = 1 ORDER BY course.course_id DESC";
      $course_result = mysqli_query($connection, $retrieve_course_query) or die(mysqli_error($connection));
      $i=1;
      while($row = mysqli_fetch_array($course_result)) {
        if ($row['course_fees'] == '0') {
          ;
        }else{
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
</div>
<!-- /Table -->
</div>

<!-- Table Modal -->
<div class="w3-container">
  <div id="id08" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom">
      <header class="w3-container w3-drdo-blue"> 
        <span onclick="document.getElementById('id08').style.display='none'" class="w3-button w3-drdo-blue w3-xlarge w3-display-topright">&times;</span>
        <h2>Notifications</h2>
      </header>
      <div style="padding: 12px">
        <h2>Courses forwarded by Divisions</h2>
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
            $retrieve_course_query = "SELECT mini_pis_details.ID, mini_pis_details.EMP_NAME, course.course_id, course.course_name, course.course_fees, course.course_agency FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN user_login ON user_login.id = '$id' INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID WHERE applied_course.hr_flag = 1 AND course.course_fees > '0' AND applied_course.hr_approve_time  BETWEEN user_login.last_login AND CURRENT_TIME";
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
    <form action="budget_approve_course.php" method="post" target="_blank">
        <input type="submit" name="approve" id="approve" value="Forward" class="w3-button w3-right w3-white w3-border" onclick="document.getElementById('id03').style.display='none'; window.location.reload();">
        <input type="submit" name="disapprove" id="disapprove" value="Reject" class="w3-button w3-right w3-drdo-red w3-border" onclick="document.getElementById('id03').style.display='none';window.location.reload();">
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

<!-- /Body -->
</body>
</html>
<?php
$update_query = "UPDATE user_login SET last_login = CURRENT_TIMESTAMP WHERE id = '$id';";
            $up_result = mysqli_query($connection, $update_query) or die(mysqli_error($connection));
?>