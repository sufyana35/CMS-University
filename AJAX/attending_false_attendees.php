<?php
include('db.php');
session_start();

$search_word=$_GET['q'];

//loop waiting list for $event --------------------------------------------------------------------------------------------//
$query9 = "SELECT * FROM ".$search_word." WHERE (attending='N/A' AND waiting_list='false')";
	 
$result9 = mysql_query($query9) or die(mysql_error());

//select data from waiting_list_$event_name & users table -------------------------------------------//
while($waiting_list_result = mysql_fetch_array($result9)){
   
   $event_name = $waiting_list_result['event_name'];
   $event_name_waiting_list = $waiting_list_result['waiting_list'];
   $event_name_reg_date = $waiting_list_result['reg_date'];
   $event_username = $waiting_list_result['event_username'];
   
  $query0 = "SELECT * FROM users WHERE username='$event_username'";
	 
  $result0 = mysql_query($query0) or die(mysql_error());
  
  //select data from waiting_list_$event_name & users table ----------------------------------//
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

  <div class="details">
      
      <div class="details_text">
          <div class="image_box">
          </div>
			<?php echo $event_name_reg_date; ?>
            <?php echo $event_userID; ?>
            <?php echo $event_username; ?>
            <?php echo $event_firstname; ?>
            <?php echo $event_surname; ?>
            <?php echo $event_email; ?>
            <?php echo $event_gender; ?>
            <?php echo $event_DOB; ?>
      </div>   
        
  </div>
    

<?php
} // ends loop for registrant details from database ---------------------------------------------------//
//loop waiting list for $event ended---------------------------------------------------------------------------------------//
?>


