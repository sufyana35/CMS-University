
<?php
include('db.php'); // include db connection

if($_POST["typeahead"])
{
  $event_name = $_POST["event_name"];
  $typeahead = $_POST["typeahead"];
  // Here, you can also perform some database query operations with above values.
  echo "Welcome ". $typeahead  ."!"; // Success Message

  session_start();
  $_SESSION["errror"] = "";
  //get variables
  $typeahead=$_POST['typeahead'];
  $_SESSION["typeahead"] = $typeahead;
  
  $event_name=$_POST['event_name'];
  $_SESSION["event_name"] = $event_name;
  
  $sql="SELECT * FROM users WHERE username='$typeahead'";
  $result=mysql_query($sql);
	
  // Mysql_num_row is counting table row
  $count=mysql_num_rows($result);
  
  // If result matched $username and $password, table row must be 1 row
  if($count==1){
	  
	  $sql="SELECT * FROM ".$event_name." WHERE (event_username='$typeahead' AND attending='true')";
	  $result=mysql_query($sql);	  
	  $count=mysql_num_rows($result);
	  
	  if($count==1){
  
		echo $_SESSION["errror"] = "Already registered";
		
	} else {
		  
		  $sql="SELECT * FROM ".$event_name." WHERE (event_username='$typeahead' AND waiting_list='true')";
		  $result=mysql_query($sql);		  
		  $count=mysql_num_rows($result);
		  
		  if($count==1){
	  
			echo $_SESSION["errror"] = "On waiting list";
			
		  } else {
		  
			$sql="SELECT * FROM ".$event_name." WHERE (event_username='$typeahead')";
			$result=mysql_query($sql);			
			$count=mysql_num_rows($result);
			
			if($count==1){
				$sql = "UPDATE ".$event_name." SET attending='true' WHERE (event_username='$typeahead' AND attending='N/A')";
			
			if (mysqli_query($conn, $sql)) {
				echo $_SESSION["errror"] = "Record updated successfully and registered";
			} else {
				echo $_SESSION["errror"] = "Error updating, User not registered for event" . mysqli_error($conn);
			}
		  
	  } else {
		  echo $_SESSION["errror"] = "Not registered for event";
	  }
		
		  }
			
			} 
  } else {
	  echo $_SESSION["errror"] = "User does not exist on system";
  } 

}