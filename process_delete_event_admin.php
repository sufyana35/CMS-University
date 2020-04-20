<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Event</title>
</head>

<body>

<?php 
include('db.php'); // db connection
include('header.php'); // include header section
include('function_login.php'); //login functions
user_admin(); // check admin logged in
session_start();
// register user ------------------------------------------------------------------------------------------------------------------//		 
$event_name=$_POST['event_name'];
$_SESSION["event_name"];

$_SESSION["username"];
$username = $_SESSION["username"];
  
$sql="SELECT * FROM events WHERE event_name='$event_name'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $username and $password, table row must be 1 row
if($count==1){
	
  // Delete row from databse called events
  $sql="DELETE FROM events
		WHERE event_name='$event_name' ";	  
  $result=mysql_query($sql);
  
  //Delete $event table from database
  $sql="DROP TABLE IF EXISTS ".$event_name." ";  
  $result=mysql_query($sql);
  
  //Delete $event table from database
  $sql="DROP TABLE IF EXISTS feedback".$event_name." ";  
  $result=mysql_query($sql);
  
  // Delete row from databse called images
  $sql="DELETE FROM images
		WHERE event_name='$event_name' ";  
  $result=mysql_query($sql);
  
  // Delete row from databse called images
  $sql="DELETE FROM comments
		WHERE event_name='$event_name' "; 
  $result=mysql_query($sql);
  
  // error and display if deleted
  header( "refresh:0; url=/Charityfiy/delete_event.php" );

//if event doesn't exist then re-direct to error page
} else 
  
  // error and display if not deleted
   header( "refresh:0; url=/Charityfiy/delete_event.php" );
  ?>