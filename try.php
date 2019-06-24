<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		
	</style>
</head>
<body>
	
<?php
require 'connect.php';

$query = "SELECT DISTINCT group_no, group_name FROM groups";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
	$groups[] = $row['group_no'];
	$group_name[] = ucwords(strtolower($row['group_name']));
}
$group_array = array_combine($groups, $group_name);
foreach($group_array as $groups => $group_name) {
	$que = "SELECT group_code FROM groups WHERE group_no = '$groups'";
	$res = mysqli_query($connection, $que) or die(mysqli_error($connection));
	$arr = mysqli_fetch_array($res);
	$val = $arr['group_code'];
	echo "<div style='display: inline-block; padding: 12px; border: 1px solid black;'>".
	"<b>$group_name ($val)</b>".
	"<br>";
$div_query = "SELECT div_no, div_name,div_code FROM divisionsu WHERE group_no = '$groups'";
$result = mysqli_query($connection, $div_query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
	echo ucwords(strtolower($row['div_name']))." (".$row['div_code'].")"."<br>";
}
echo "</div>";
}
?>

</body>
</html>
