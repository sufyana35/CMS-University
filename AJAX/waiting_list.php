<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
include('db.php');
session_start();

$search_word=$_GET['q'];

// Function select table, count rows then do ----------------------------------------------------------------//
$sql="SELECT * FROM ".$search_word." WHERE (attending='N/A' AND waiting_list='true')";
$result4=mysqli_query($conn,$sql);
// Return the number of rows in result set
echo $waiting_list=mysqli_num_rows($result4);

// Free result set
mysqli_free_result($result4);
//end count function for vacancy------------------------------------------------------------------------------//
?>
<body>
</body>
</html>