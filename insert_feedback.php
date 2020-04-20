<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>insert feedback</title>
</head>

<body>
<?php
include('db.php'); //db connection
include('header.php'); // include header section
include('function_login.php'); //login functions
user_login(); // check user log in
include('functions.php'); //include functions

//if user not insert then display error message
if (!(isset($_POST['event_name']) && ($_POST['username_post']) && ($_POST['text_comment']) && ($_POST['rating_input']) )) {

  error_style(); //include style
  ?>
  <div class="error">
	<p>Please type a comment and rate the event out of 1-5. With 1 being the lowest and 5 being the highest.</p>
  </div>
  <?php
  include('footer.php');
	
} // error end function

//if no error then execute code below
else {

  //strip, prevent, strip html tags & post function
  $event_name = stripslashes($_POST['event_name']);
  $event_name = mysql_real_escape_string($event_name);
  $event_name = strip_tags($event_name);
  
  $username_post = stripslashes($_POST['username_post']);
  $username_post = mysql_real_escape_string($username_post);
  $username_post = strip_tags($username_post);
  
  $text_comment = stripslashes($_POST['text_comment']);
  $text_comment = mysql_real_escape_string($text_comment);
  $text_comment = strip_tags($text_comment);
  
  $rating_input = stripslashes($_POST['rating_input']);
  $rating_input = mysql_real_escape_string($rating_input);
  $rating_input = strip_tags($rating_input);
  
  //store varibales in a session
  $_SESSION["rating_input"] = $rating_input;
  $_SESSION["username"] = $username_post;
  $_SESSION["event_name"] = $event_name;
  $_SESSION["text_comment"] = $text_comment;

  // Function select table, count rows then do ----------------------------------------------------------------//
  $sql="SELECT * FROM feedback".$event_name." WHERE user_name_feedback='$username_post'";
  $result2=mysqli_query($conn,$sql);
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result2);
  
  // Free result set
  mysqli_free_result($result2);
  //end count function for feedback comment----------------------------------------------------------------------//
  
  //if user left feedback then execute below code
  if ($rowcount >= 1) {	
	  
	  error_style(); //include style
	  ?>
	  <div class="error">
		<p>You have already left feedback. If wish to delete or ammend your post you can do this on the event feedback page</p>
	  </div>
	  <?php
	  
	//if usser left no comment then execute below code  
  } else {
  
  //insert into table feedback $event name
  $sql = "INSERT INTO feedback".$event_name." (user_name_feedback, event_name, comments, rating)
	  VALUES ('$username_post', '$event_name', '$text_comment', $rating_input)";
	  
	  if ($conn->query($sql) === TRUE) {
		  //if done then re-direct
		  $_SESSION['event_name']=$event_name;
		  header("location:leave_feedback.php");
		  
		//if not successfull then  
	  } else {
		  
		  error_style(); //include style
		  ?>
		  <div class="error">
			<p>Unknown error: could not insert comment. Try to type comment without pasting, or adding any additional material</p>
		  </div>
		  <?php
		  
	  } // check connection end code
  } // end check comment  
} // check error code end

?>
<?php include('footer.php'); ?>
</body>
</html>