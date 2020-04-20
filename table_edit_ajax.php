<?php
include('db.php'); // db connection
include('header.php'); // header section
include('function_login.php'); //include login functions
user_login(); //check user login function
include('functions.php'); //include functions

//update server details
if (!(isset($_POST['lastname']) && ($_POST['id']) && ($_POST['firstname']) )) {
include('header.php');

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
	
  if (!(isset($_POST['url']) && ($_POST['url']) )) {
  
	$table_var = "comments";
	if($_POST['id'])
	{
		
		$id=mysql_escape_String($_POST['id']);
		$firstname=mysql_escape_String($_POST['firstname']);
		$lastname=mysql_escape_String($_POST['lastname']);
		$sql = "update ".$table_var." set comments='$lastname' where id='$id'";
		mysql_query($sql);
		
	}
		
  } else {
	  
	$table_var = "comments";
	if($_POST['id'])
	{
		$id=mysql_escape_String($_POST['id']);
		$firstname=mysql_escape_String($_POST['firstname']);
		$lastname=mysql_escape_String($_POST['lastname']);
		$sql = "update ".$table_var." set comments='$lastname' where id='$id'";
		mysql_query($sql); 
		
		echo "true";
		header("location:bulletin_board_feedback.php?event_name=".$event_name."");
	}

  }

}
?>