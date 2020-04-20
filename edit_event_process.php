<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit event prcoess</title>
</head>

<body>
<?php
include('db.php'); // include db connection
include('header.php'); // include header
include('function_login.php'); //login functions
user_admin(); // check admin logged in
include('functions.php'); //include functions

if (!(isset($_POST['event_name']) && ($_POST['location']) && ($_POST['vacancy']) && ($_POST['time']) && ($_POST['date']) && ($_POST['myfile']) && ($_POST['event_name_new']) )) {
  error_style(); //include style
  ?>	
<div class="error">
	<p>Error: Please type all the fields</p>
  </div>
  <?php
  include('footer.php'); // include footer section
} else {
	
	$location = $_POST['location'];
	$event_name = $_POST['event_name'];
	$vacancy = $_POST['vacancy'];
	$time = $_POST['time'];
	$date = $_POST['date'];
	$myfile = "uploads/" .$_POST['myfile'];
	$event_name_new = $_POST['event_name_new'];
	
	$event_name_feedback_old = "feedback".$_POST['event_name'];
	$event_name_feedback_new = "feedback".$_POST['event_name_new'];
	
   $sql = "UPDATE events SET event_name='$event_name_new', location='$location', time='$time', date='$date' WHERE event_name='$event_name'";
   $result=mysql_query($sql);

   $sql = "UPDATE comments SET event_name='$event_name_new' WHERE event_name='$event_name'";
   $result=mysql_query($sql);

   $sql = "UPDATE images SET event_name='$event_name_new', image_url='$myfile' WHERE event_name='$event_name'";
   $result=mysql_query($sql);
  
   $sql = "UPDATE feedback".$event_name." SET event_name='$event_name_new' WHERE event_name='$event_name'";
   $result=mysql_query($sql);
  
   $sql = "UPDATE ".$event_name." SET event_name='$event_name_new' WHERE event_name='$event_name'";
   $result=mysql_query($sql);
	
   $sql  =" RENAME TABLE ".$event_name." TO ".$event_name_new." ";
   $result=mysql_query($sql);
	
   $sql  =" RENAME TABLE ".$event_name_feedback_old." TO ".$event_name_feedback_new." ";
   $result=mysql_query($sql);
   
   error_style(); //include style
  ?>	
  <div class="error">
	<p>Event updated to: </p>
    </div>
    <?php 
	echo $location = "Location: " .$_POST['location'];
	echo $vacancy = "Vacancy: " .$_POST['vacancy'];
	echo $time = "Time: " .$_POST['time'];
	echo $date = "Date: " .$_POST['date'];
	echo $myfile = "Uploads: " ."uploads/" .$_POST['myfile'];
	echo $event_name_new = "Event name: " .$_POST['event_name_new'];
	?>
  </div>
  <?php
  include('footer.php'); // include footer section

	

	
}
?>
</body>
</html>