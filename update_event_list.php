<?php
include('db.php'); // include db connection

//this is a dynamic script, it will work with or without data

// FUNCTION START: Function select table -----------------------------------------------------------------------------------------------------------------//
$query="SELECT * FROM events";
$result = mysql_query($query) or die(mysql_error());

// START LOOP: Function select loop ---------------------------------------------------------------------------------------------//
while($row = mysql_fetch_array($result)){
	
	//variables from table
	$event_name = $row['event_name'];
	$event_vacancy = $row['vacancy'];
	
	// Function select table, count rows then do ----------------------------------------------------------------//
	$sql="SELECT * FROM ".$event_name." WHERE waiting_list='true'";
	$result3=mysqli_query($conn,$sql);
	// Return the number of rows in result set
	$waiting_list=mysqli_num_rows($result3);
	$event_username = $waiting_list['username'];
	
	// Free result set
	mysqli_free_result($result3);
	//end count function for waiting list -------------------------------------------------------------------------//
	
	//LOOP START: Loop user name from table $event_name ---------------------------------------------------------------------------------//
	$query2="SELECT * FROM ".$event_name." ORDER BY event_user_id";
	$result2 = mysql_query($query2) or die(mysql_error());
	
	while($row2 = mysql_fetch_array($result2)){
	$event_username = $row2['event_username'];
		
		// Function select table, count rows then do ----------------------------------------------------------------//
		$sql="SELECT * FROM ".$event_name." WHERE waiting_list='false'";
		$result3=mysqli_query($conn,$sql);
		// Return the number of rows in result set
		$rowcount=mysqli_num_rows($result3);
		
		// Free result set
		mysqli_free_result($result3);
		//end count function-----------------------------------------------------------------------------------------//
		
		//LOOP START: calculate vacancies left then loop the $calc2 variable/value that amount of times   
		$calc2 = $rowcount; // Assign New Varibale Name
		while ($calc2 < $event_vacancy) /*-- $calc2 (people who can attend) IS LESS THAN $event_vacancy THEN DO LOOP --*/ {	
	   
			//Updates the table and changes the status of the waiting list
			$sql = "UPDATE ".$event_name." SET waiting_list='false' WHERE event_username='$event_username' ";
			if (mysqli_query($conn, $sql)) {
			   
			   //successsfull
	
			} else {  
			
			   //error
			}
		  
		//reload data	  
		// Function select table, count rows then do ----------------------------------------------------------------//
		$sql="SELECT * FROM ".$event_name." WHERE waiting_list='false'";
		$result3=mysqli_query($conn,$sql);
		// Return the number of rows in result set
		$rowcount=mysqli_num_rows($result3);
		
		// Free result set
		mysqli_free_result($result3);
		//end count function for vacancy------------------------------------------------------------------------------//
		
		$calc2++; //increment value by one	
  
		}
		//LOOP END: calculate vacancies left then loop the $calc2 variable/value that amount of times
			
	}
	// LOOP END: Function select loop ---------------------------------------------------------------------------------------------//
	
}
// FUNCTION END: Function select table -----------------------------------------------------------------------------------------------------------------//
?>