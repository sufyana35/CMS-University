<?php
include('db.php'); // db connection

// update server details here
$key=$_GET['key'];
$array = array();

$query=mysql_query("select * from users where username LIKE '%{$key}%'");
while($row=mysql_fetch_assoc($query))
{
  $array[] = $row['username'];
}
echo json_encode($array);
?>
