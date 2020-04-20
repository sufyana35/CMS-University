<?php

//update server details
include('db.php'); // db connection
include('header.php'); // include header function
include('function_login.php'); //include login functions
user_login(); //check user login function
include('functions.php'); //include functions

//update server details
if (!(isset($_POST['event_name']) && ($_POST['comments2']) && ($_POST['uid']) )) {

  error_style(); //include style
  ?>
  <div class="error">
	<p>Error: Please type a valid comment in.</p>
  </div>
  <?php
  include('footer.php');
	
}
else 
{

  $event_name=$_POST['event_name'];
  $comments2=$_POST['comments2'];
  $id=$_POST['uid'];
  
  $sql="SELECT * FROM ".$event_name." WHERE id='$id'";
  $result=mysql_query($sql);			
  echo $count=mysql_num_rows($result);

  if($count==1){
	  $sql = "UPDATE feedback".$event_name." SET comments='$comments2' WHERE id='$id'";
	if (mysqli_query($conn, $sql)) {
		 header("location:leave_feedback.php?event_name=".$event_name."");
	} else {
		mysqli_error($conn);
		 header("location:leave_feedback.php?event_name=".$event_name."");
	}
  } else {
	  $sql = "UPDATE feedback".$event_name." SET comments='$comments2' WHERE id='$id'";
	  if (mysqli_query($conn, $sql)) {
		 header("location:leave_feedback.php?event_name=".$event_name."");
	} else {
		 mysqli_error($conn);
		 header("location:leave_feedback.php?event_name=".$event_name."");
	}
  }
}
?>