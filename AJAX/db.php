<?php
$host="localhost"; // Host name 
$username_host="unn_w14025337"; // Mysql username 
$password="sufyan733"; // Mysql password 
$db_name="unn_w14025337"; // Database name 
$tbl_name="PCH_expressedInterest"; // Table name 

// Connect to server and select database.
mysql_connect("$host", "$username_host", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// Create connection
$conn = new mysqli("$host", "$username_host", "$password" , "$db_name");
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



  $conn = mysqli_connect('localhost', 'unn_w14025337', 'sufyan733', 'unn_w14025337');
  if (mysqli_connect_errno()) {
		echo "<p>Connection failed:".mysqli_connect_error()."</p>\n";
  }

?>