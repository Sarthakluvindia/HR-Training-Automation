<?php
require('connect.php');
include 'login.php';
require('wordwrap.php');

if(isset($_POST["print"]))  
{
  $js_id = $_SESSION['course_id'];
  $js_eid = $_SESSION['emp_id'];
  $output = ''; 

  $add_query = "SELECT * FROM course WHERE course_id = '$js_id'";
  $result = mysqli_query($connection, $add_query) or die(mysqli_error($connection));  
  $result_row = mysqli_fetch_array($result);
  $course_name = $result_row['course_name'];
  $course_fees = $result_row['course_fees'];
  $course_loc = $result_row['location'];
  $course_agency = $result_row['course_agency'];
  $start_date = $result_row['course_period_start_date'];

  $retrieve_course_modal_query = "SELECT mini_pis_details.divi, mini_pis_details.EMP_NAME, course.course_id, course.course_name, course.course_fees, course.eligibility,course.location, course.course_agency, desigcode.designation FROM course INNER JOIN applied_course ON course.course_id = applied_course.course_id INNER JOIN mini_pis_details ON applied_course.emp_id = mini_pis_details.ID INNER JOIN desigcode ON mini_pis_details.grade_cd1 = desigcode.code WHERE applied_course.emp_id = '$js_eid'";
  $course_modal_result = mysqli_query($connection, $retrieve_course_modal_query) or die(mysqli_error($connection));  
  $row = mysqli_fetch_array($course_modal_result);
  $emp_name = $row['EMP_NAME'];
  $designation = $row['designation'];
  $divi = $row['divi'];

  $divi_query = "SELECT div_code FROM divisionsu WHERE div_no = $divi";
  $div_result = mysqli_query($connection, $divi_query) or die(mysqli_error($connection));
  $div_row = mysqli_fetch_array($div_result);
  $div_code = $div_row['div_code'];
}

$pdf = new PDF();
$header = array('','','','');
$data = array(array('Name:',$emp_name),array('Designation:',$designation,'DC:',$div_code),array('Course Name:',$course_name),array('Organising Agency:',$course_agency,'Date:',$start_date),array('Address:',$course_loc,'No. of Participants:','    1'),array('Remarks:','','Fees (in Rs.):',$course_fees));
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->Ln(13);
$pdf->Cell(30,0,"The following officers /  staff employees have been nominated and forwaded ");
$pdf->Ln(7);
$pdf->Cell(30,0,"by their Division Heads for the respective courses.");
$pdf->Ln(20);
$pdf->Line(10, 60, 210-10, 60);
//$pdf->BasicTable($header,$data);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25,0,"Name(s):");
$pdf->SetFont('');
$pdf->Cell(30,0,$emp_name);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(40,0,"Designation(s):");
$pdf->SetFont('');
$pdf->Cell(70,0,$designation);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,0,"Division(s):");
$pdf->SetFont('');
$pdf->Cell(30,0,$div_code);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(45,0,"Course Name:");
$pdf->SetFont('');
$pdf->Ln(3);
$text=$course_name;
$nb=$pdf->WordWrap($text,190);
$pdf->Write(7,$text);
$pdf->Ln(13);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(50,0,"Organising Agency:");
$pdf->SetFont('');
$pdf->Cell(30,0,$course_agency);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(18,0,"Date:");
$pdf->SetFont('');
$pdf->Cell(30,0,$start_date);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(25,0,"Address:");
$pdf->SetFont('');
$pdf->Cell(30,0,$course_loc);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(50,0,"No. of Participants:");
$pdf->SetFont('');
$pdf->Cell(30,0,'1');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(30,0,"Fees (Rs.):");
$pdf->SetFont('');
$pdf->Cell(30,0,$course_fees);
$pdf->Line(10, 165, 210-10, 165);

$pdf->Ln(20);
$pdf->Cell(25,0,"This is for your approval please.");

$pdf->Ln(30);
$pdf->Cell(190,0,"HRD Division",0,0,'R');
$pdf->Ln(7);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,0,"I.R.D.E Dehradun",0,0,'R');

$pdf->Ln(30);
$pdf->SetFont('');
$pdf->Cell(200,0,"Approve / Not Approved",0,0,'C');
$pdf->Ln(7);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(200,0,"Director",0,0,'C');


$pdf->Output();
?>