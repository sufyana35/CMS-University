<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include('db.php'); //db connection
include('header.php'); //header section
include('update_event_list.php'); //update waiting list
include('function_login.php'); //login functions
user_login(); // check user logged in
include('functions.php'); //include functions
$event_name=$_REQUEST['event_name'];

//variable equals sessions
$username = $_SESSION["username"];
	
// sql to delete a record
$sql = "DELETE FROM ".$event_name." WHERE event_username='$username'";

if ($conn->query($sql) === TRUE) {
	
	error_style(); //include style
	header( "refresh:10; url=/Charityfiy/your_events.php" );?>
	<div class="error">
	  <p>Registration Deleted</p>
      <p>You will be re-directed to your events page in 10 seconds
			 If not re-directed <a href="your_events.php" class="hover">click here</a>
	</div>
	<?php
} else {
	
	 error_style(); //include style
	 header( "refresh:10; url=/Charityfiy/your_events.php" );?>
	<div class="error">
	  <p>Error: Could not amend registration</p>
      <p>You will be re-directed to your events page in 10 seconds
			 If not re-directed <a href="your_events.php" class="hover">click here</a>
	</div>
	<?php
}

$conn->close();

include('footer.php'); //footer section
?>
</body>
</html>