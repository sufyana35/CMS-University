<?php
include('db.php'); // db connection

session_start();
$username = $_SESSION["username"];


//loop waiting list for $event --------------------------------------------------------------------------------------------//
$query9 = "SELECT * FROM events"; //select table
	 
$result9 = mysql_query($query9) or die(mysql_error()); //SQL query

//select data from waiting_list_$event_name & users table -------------------------------------------//
while($waiting_list_result = mysql_fetch_array($result9)){
   
  $event_name = $waiting_list_result['event_name'];
  $event_location = $waiting_list_result['location'];
  $event_vacancy= $waiting_list_result['vacancy'];
  $event_time = $waiting_list_result['time'];
  $event_date = $waiting_list_result['date'];
  $reg_date = $waiting_list_result['reg_date'];
   
  $query0 = "SELECT * FROM ".$event_name." WHERE event_username='$username'";
	 
  $result0 = mysql_query($query0) or die(mysql_error());
  
  //select data from waiting_list_$event_name & users table ----------------------------------//
  while($waiting_list_result2 = mysql_fetch_array($result0)){
	  	 
	// Count functions --------------------------------------------------------------------------------------------------------//
	// Function select table, count rows then do ----------------------------------------------------------------//
	$sql="SELECT * FROM ".$event_name." WHERE (attending='N/A' AND waiting_list='false')";
	$result2=mysqli_query($conn,$sql);
	// Return the number of rows in result set
	$attending_false=mysqli_num_rows($result2);
	
	// Free result set
	mysqli_free_result($result2);
	//end count function for vacancy------------------------------------------------------------------------------//
	
	// Function select table, count rows then do ----------------------------------------------------------------//
	$sql="SELECT * FROM ".$event_name." WHERE (attending='true' AND waiting_list='false')";
	$result3=mysqli_query($conn,$sql);
	// Return the number of rows in result set
	$attending_true=mysqli_num_rows($result3);
	
	// Free result set
	mysqli_free_result($result3);
	//end count function for vacancy------------------------------------------------------------------------------//
	
	// Function select table, count rows then do ----------------------------------------------------------------//
	$sql="SELECT * FROM ".$event_name." WHERE (attending='N/A' AND waiting_list='true')";
	$result4=mysqli_query($conn,$sql);
	// Return the number of rows in result set
	$waiting_list=mysqli_num_rows($result4);
	
	// Free result set
	mysqli_free_result($result4);
	//end count function for vacancy------------------------------------------------------------------------------//
	
	// Count functions ended---------------------------------------------------------------------------------------------------//
		 
	  
	?>
	
	  <div class="portfolio_reg">
		<div class="portfoliobox2_reg">
		  <div class="portfoliotext_reg">
			<p>Event Name</p>
		  </div>
		  <div class="portfoliotext_reg2">
			<p><?php echo $event_name?></p>
		  </div>
		</div>
		
		<div class="portfoliobox2_reg">
		  <div class="portfoliotext_reg">
			<p>Event Date</p>
		  </div>
		  <div class="portfoliotext_reg2">
			<p><?php echo $event_date?></p>
		  </div>
		</div>
		
		<div class="portfoliobox2_reg">
		  <div class="portfoliotext_reg">
			<p>Event Time</p>
		  </div>
		  <div class="portfoliotext_reg2">
			<p><?php echo $event_time?></p>
		  </div>
		</div>
		
		<div class="portfoliobox2_reg">
		  <div class="portfoliotext_reg">
			<p>Location</p>
		  </div>
		  <div class="portfoliotext_reg2">
			<p><?php echo $event_location?></p>
		  </div>
		</div>
        
        <?php $user_total =  $attending_false + $attending_true + $waiting_list;?>
		<div class="portfoliobox2_reg">
		  <div class="portfoliotext_reg">
			<p>Users</p>
		  </div>
		  <div class="portfoliotext_reg2">
			<p><?php echo $user_total?></p>
		  </div>
        </div>
        
        <div class="portfoliobox2_reg">
		  <div class="portfoliotext_reg">
			<p>Attending</p>
		  </div>
		  <div class="portfoliotext_reg2">
			<p><?php echo $attending_false?></p>
		  </div>
        </div>
        
        <div class="portfoliobox2_reg">
		  <div class="portfoliotext_reg">
			<p>Attended</p>
		  </div>
		  <div class="portfoliotext_reg2">
			<p><?php echo $attending_true?></p>
		  </div>
        </div>
        
        <div class="portfoliobox2_reg">
		  <div class="portfoliotext_reg">
			<p>Waiting List</p>
		  </div>
		  <div class="portfoliotext_reg2">
			<p><?php echo $waiting_list?></p>
		  </div>
        </div>
		
	  </div>
	  
	  <div class="board">
		<form id="feedback-form" action="./bulletin_board_feedback.php" method="post"> 
			  <input type="hidden" name="event_name" id="event_name" readonly="readonly" hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
			  <input type="hidden" name="event_vacancy" id="event_vacancy" readonly="readonly" hidden="" value="<?php echo $vacancy ?>" placeholder="<?php echo $vacancy ?>"  required/>
			  <input type="hidden" name="event_time" id="event_time" readonly="readonly" hidden="" value="<?php echo $time ?>" placeholder="<?php echo $time ?>"  required/>
			  <input type="hidden" name="event_date" id="event_date" readonly="readonly" hidden="" value="<?php echo $date ?>" placeholder="<?php echo $date ?>"  required/>
			  <input type="hidden" name="event_location" id="event_location" readonly="readonly" hidden="" value="<?php echo $location ?>" placeholder="<?php echo $location ?>"  required/>
			  <input type="hidden" name="event_image" id="event_image" readonly="readonly" hidden="" value="<?php echo $image_url ?>" placeholder="<?php echo $image_url ?>"  required/>
			  <input type="hidden" name="reg_date" id="reg_date" readonly="readonly" hidden="" value="<?php echo $reg_date ?>" placeholder="<?php echo $reg_date ?>"  required/>
		  <button type="submit" class="board_button" id="board_button">Access Chat Room</button>
		</form>
	  </div>
	
	<?php
	} // ends loop for registrant details from database ---------------------------------------------------//
	//loop waiting list for $event ended---------------------------------------------------------------------------------------//
}
?>