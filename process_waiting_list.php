<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event waiting list</title>
<link href="CSS/process_waiting_list.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
include('db.php'); //db conection

// gets values from form Events.php
$event_name=$_POST['event_name'];
$_SESSION["event_name"] = $event_name;

//removes spaces	
$event_name=preg_replace('/\s+/', '', $event_name);

// Function select table, count rows then do ----------------------------------------------------------------//
$sql="SELECT * FROM ".$event_name." WHERE waiting_list='true'";
$result3=mysqli_query($conn,$sql);
// Return the number of rows in result set
$waiting_list=mysqli_num_rows($result3);

// Free result set
mysqli_free_result($result3);
//end count function for vacancy------------------------------------------------------------------------------//

include('header.php'); ?>
<div class="registrant_outer">
  <div class="title">
    <p>Waiting List</p>
  </div>
  <div class="label_box">
  
  <table width="100%" border="0">
    <tr>
      <td><div class="label_text">Reg Date</div></td>
      <td><div class="label_text">User ID</div></td>
      <td><div class="label_text">Username</div></td>
      <td><div class="label_text">Firstname</div></td>
      <td><div class="label_text">Surname</div></td>
      <td><div class="label_text_email">Email</div></td>
      <td><div class="label_text">Gender</div></td>
      <td><div class="label_text">DOB</div></td>
    </tr>
  </table>
    
</div>
<?php

$query9 = "SELECT * FROM ".$event_name." WHERE (event_name='$event_name' AND waiting_list='true')";
	 
$result9 = mysql_query($query9) or die(mysql_error());

//select data from waiting_list_$event_name & users table ----------------------------------------------------------------------------------//
while($waiting_list_result = mysql_fetch_array($result9)){
   
   $event_name = $waiting_list_result['event_name'];
   $event_name_waiting_list = $waiting_list_result['waiting_list'];
   $event_name_reg_date = $waiting_list_result['reg_date'];
   $event_username = $waiting_list_result['event_username'];
   
  $query0 = "SELECT * FROM users WHERE username='$event_username'";
	 
  $result0 = mysql_query($query0) or die(mysql_error());
  
  //select data from waiting_list_$event_name & users table ----------------------------------------------------------------------------------//
  while($waiting_list_result = mysql_fetch_array($result0)){
	 
		 $event_firstname = $waiting_list_result['firstname'];
		 $event_surname = $waiting_list_result['surname'];
		 $event_username = $waiting_list_result['username'];
		 $event_email = $waiting_list_result['email'];
		 $event_gender = $waiting_list_result['gender'];
		 $event_DOB = $waiting_list_result['DOB'];
		 $event_userID = $waiting_list_result['userID'];
	 
  }
   
?>

      <div class="registrant_details">
      
  <table width="100%" border="0">
    <tr>
      <td><div class="registrant_column"><?php echo $event_name_reg_date; ?></div></td>
      <td><div class="registrant_column"><?php echo $event_userID; ?></div></td>
      <td><div class="registrant_column"><?php echo $event_username; ?></div></td>
      <td><div class="registrant_column"><?php echo $event_firstname; ?></div></td>
      <td><div class="registrant_column"><?php echo $event_surname; ?></div></td>
      <td><div class="registrant_column_email"><?php echo $event_email; ?></div></td>
      <td><div class="registrant_column"><?php echo $event_gender; ?></td>
      <td><div class="registrant_column"><?php echo $event_DOB; ?></td>
    </tr>
  </table>
        
        
        </div>
    

<?php
} // ends loop for registrant details from database 
?>

  <div class="waiting">
    <p><?php echo $event_name, ": 	Amount of registrants on waiting list ", $waiting_list ?></p>
  </div>
</div>
</div>

<?php include('footer.php'); // include footer section ?>
</body>
</html>