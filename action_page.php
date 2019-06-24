<?php
$conn = new mysqli("localhost","root","","drdo");
if($_SERVER["REQUEST_METHOD"] == "POST") {
      $formusername = mysqli_real_escape_string($conn,$_POST['username']);
      $formpassword = mysqli_real_escape_string($conn,$_POST['password']); 
      
      $sql = "SELECT type FROM employee_login WHERE username = '$formusername' and password = '$formpassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      echo "";
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         header("location: '$row'.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>