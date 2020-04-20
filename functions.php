<?php
//function display events
// -- FUNCTION DISPLAY EVENT ------------------------------------------------------------------------------------------------------------------------------------------------------------------//
function display_event() {

  include('db.php'); //db connection		
  ?>
  <!-- Display Event------------------------------------------------------------------------------------- -->
  <div class="display_events">
  <form action="Events.php" method="post">
  <?php

  if (isset($_POST['event_order']) && ($_POST['event_type']) && ($_POST['event_size']) ) {
	  $event_order = $_POST['event_order'];
	  $event_type = $_POST['event_type'];
	  $event_size = $_POST['event_size'];
	  $event_selected = $event_type. " ". $event_order. " ". "limit ". $event_size;
	  $event_selected_query = "Selected Search Query: ORDER: $event_order, TYPE: $event_type, LIMIT: $event_size " ;
  } else {
	  $event_selected_query = "Default: ORDER: DESCENDING, TYPE: ID, LIMIT: 3 ";
	  $event_selected = "ID DESC limit 3";
	  $event_order = "DESC";
	  $event_type = "ID";
	  $event_size = "5";
  }
  
  $query = "SELECT events.*, images.* 
  FROM events
  LEFT JOIN images
  on events.event_name=images.event_name
  ORDER BY events.$event_selected";
	   
  $result = mysql_query($query);
  
  if($result !== FALSE) {
  
	?>
	<div class="event">
	  <div class="title2">
	  <h2>Events</h2>
	  <?php
	  echo $event_selected_query;
	  
	  ?>
	  
	  <select name="event_order" size="1">
	  
		<option <?php if($event_order == 'ASC'){echo("event_order");}?>>ASC</option>
		<option <?php if($event_order == 'DESC'){echo("event_order");}?>>DESC</option>
	  
	  </select>
	  
	  <select name="event_type" size="1">
	  
		<option <?php if($event_type == 'ID'){echo("event_type");}?>>ID</option>
		<option <?php if($event_type == 'event_name'){echo("event_type");}?>>event_name</option>
		<option <?php if($event_type == 'location'){echo("event_type");}?>>location</option>
		<option <?php if($event_type == 'reg_date'){echo("event_type");}?>>reg_date</option>
		<option <?php if($event_order == 'time'){echo("event_order");}?>>time</option>
		<option <?php if($event_order == 'date'){echo("event_order");}?>>date</option>
	  
	  </select>
	  
	  <select name="event_size" size="1">
	  
		<option <?php if($event_size == '2'){echo("event_size");}?>>5</option>
		<option <?php if($event_size == '5'){echo("event_size");}?>>10</option>
		<option <?php if($event_size == '15'){echo("event_size");}?>>15</option>
        <option <?php if($event_size == '30'){echo("event_size");}?>>30</option>
        <option <?php if($event_size == '50'){echo("event_size");}?>>50</option>
        <option <?php if($event_size == '100'){echo("event_size");}?>>100</option>
        <option <?php if($event_size == '1000'){echo("event_size");}?>>1000</option>
	  
	  </select>
	  
		
		<button type="submit" class="button2" id="button2">Sort Events</button>
	  </form> 
	  </div>
	<?php
	
	// Print out the contents of each row into a table
	while($row = mysql_fetch_array($result)){
		
		$event_name = $row['event_name'];
		$location = $row['location'];
		$vacancy = $row['vacancy'];
		$time = $row['time'];
		$date = $row['date'];
		$reg_date = $row['reg_date'];
		$image_url = $row['image_url'];
		
		// Function select table, count rows then do ----------------------------------------------------------------//
		$sql="SELECT * FROM ".$event_name." WHERE waiting_list='false'";
		$result2=mysqli_query($conn,$sql);
		// Return the number of rows in result set
		$rowcount=mysqli_num_rows($result2);
		
		// Free result set
		mysqli_free_result($result2);
		//end count function for vacancy------------------------------------------------------------------------------//
		
		// Function select table, count rows then do ----------------------------------------------------------------//
		$sql="SELECT * FROM ".$event_name." WHERE waiting_list='true'";
		$result3=mysqli_query($conn,$sql);
		// Return the number of rows in result set
		$waiting_list=mysqli_num_rows($result3);
		
		// Free result set
		mysqli_free_result($result3);
		//end count function for vacancy------------------------------------------------------------------------------//
		
		
		?>
		
			<?php echo '
			
			<div class="event_content">
	  
			<div class="portfoliobox3">
			
			<img src="'.$image_url.'"   div class="portfolioimg" " />
			
			</div>'
			
			
			 ?>
		  
		
		<div class="event_display">
		  <form id="register-form" action="register.php" method="post">          
			<div>
			  <div class="portfoliotext2"><?php echo "".$event_name; ?></div>
			  
			  <div class="label_box">
			  <label for="attending">Attending Event</label>
			  <div class="text"><?php echo "Attending: ".$rowcount; ?></div>
			  </div>
			  
			  <div class="label_box">
			  <label for="location">Location</label>
			  <div class="text"><?php echo "Held at: ".$location; ?></div>
			  </div>
			  
			  <div class="label_box">
			  <label for="vacancy">vacancy</label>
			  <div class="text"><?php echo "Maximum occupancy: ".$vacancy; ?></div>
			  </div>
			  
			  <div class="label_box">
			  <label for="time">Time</label>
			  <div class="text"><?php echo "Time of event: ".$time; ?></div>
			  </div>
			  
			  <div class="label_box">
			  <label for="date">Date</label>
			  <div class="text"><?php echo "Date held: ".$date; ?></div>
			  </div>
			  
			  <div class="label_box">
			  <label for="Date Created">Date Created</label>
			  <div class="text"><?php echo "Created at: ".$reg_date; ?></div>
			  </div>
			  
			  <div class="text_vacancy">
			  <?php 
			  $vacancy_2 = $vacancy;
			  $vacancy_left = $vacancy_2 - $rowcount;
			  echo "Vacancies left: ".$vacancy_left; 
			  ?>
			  </div>
			  
			  <div class="text_vacancy">
			  <?php 
			  echo "Waiting list: ".$waiting_list; 
			  ?>
			  </div>
			  
			  <input type="hidden" name="event_name" id="event_name" readonly="readonly" hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
			  <input type="hidden" name="event_vacancy" id="event_vacancy" readonly="readonly" hidden="" value="<?php echo $vacancy ?>" placeholder="<?php echo $vacancy ?>"  required/>
				
			</div>
		  
		</div>
	
	  </div>
	  
	  <div class="event_more">
		<div class="portfoliotext2">
		  <div class="button_class">
			<?php
			// Public + User Function IF ELSE STATEMENT
			$dtA = $date;
			$dtB = date("Y-m-d");
			if ( $dtA >= $dtB ) {
			  // echo 'dtA > dtB';
			  ?>
			  <button type="submit" class="button2" id="button2">Register</button>
			  </form>       
			  <?php  
			}
			else {
			  // echo 'dtA <= dtB';
			  ?>
			  </form>
			  <?php
			}
	  
			// Public + User Function IF ELSE STATEMENT
			if (!(isset($_SESSION['username']) && $_SESSION['username'] != "")) {
				if ( $dtA >= $dtB ) {
					  // echo 'dtA > dtB';
	
					}
					else {
					  // echo 'dtA <= dtB';
					  ?> 
					  <button class="button2" id="button2">Event Passed</button>
					  </form>
					  <?php
					}
	
			} else {
				
				// Admin + User Function IF ELSE STATEMENT
				$username_user = $_SESSION["username"];
				// Function select table, count rows then do ----------------------------------------------------------------//
				$sql="SELECT * FROM ".$event_name." WHERE event_username='$username_user'";
				$result4=mysqli_query($conn,$sql);
				// Return the number of rows in result set
				$user_check=mysqli_num_rows($result4);
				
				// Free result set
				mysqli_free_result($result4);
				//end count function for reg user------------------------------------------------------------------------------//
				
				// User FUNCTION to leave FEEDBACK registered (restricted), ADMIN can access all pages (non-restricted)
				if (($user_check == 1) or ($_SESSION['username'] == "admin")) {
					
					if ( $dtA > $dtB ) {
					  // echo 'dtA > dtB';
	
					}
					else {
					  // echo 'dtA <= dtB';
					  ?>
					  <form id="feedback-form" action="leave_feedback.php" method="post"> 
					  <input type="hidden" name="event_name" id="event_name" readonly="readonly" hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
					  <button type="submit" class="button2" id="button2">Leave Feedback</button>
					  </form>
					  <?php
					}
	
				} else {
					?>
					<button class="button2" id="button2">Event Passed</button>
					<?php
	
				}
				
			}
			?>
		  </div>
		</div>
	  </div>
	  
	<?php
	} // ends loop for getting event content from database 
	?>
	</div>
	<?php  
  } // end for check content
  
  //content table = 0 then, START
  else {
	  
	   ?>
		 <div class="sql_error_text">
		   <img name="ERROR_SQL" src="Images/Website/SQL_error/SQL_ERROR.jpg" width="600" height="340" alt="If no content exists then display this" />
		   <div class="sql_error_text"><p>Doesn't Exist</p></div>
		 </div>
	   <?php
	  
  } //content table = 0 then, END

	
} // end display_event function
// -- FUNCTION DISPLAY EVENT end --------------------------------------------------------------------------------------------------------------------------------------------------------------//

// -- FUNCTION PROMO START ------------------------------------------------------------------------------------------------------------------------------------------------------------------//
function promo() {

  include('db.php'); //db connection
  
  if (!(isset($_SESSION['username']) && $_SESSION['username'] == "admin") ) {
	
  
  } // end admin function
  
  else {
	  
	?>
	<div class="event">
	  <div class="search">
		<div class="box2">
	  
		<h1>Promotion Video</h1>
		<hr>
		  <h2>Here you will be able to post youtube vidoes</h2>
		</div>
	  </div>
	  
	  <!--START: Insert message-->
	  <div class="box_comment">
		<div class="search_inner">
		  <div class="search_outer">
			<div class="bs-example">
			  <form id="chat_room" action="promote_admin.php" method="post"> 
				  <input type="text" class="text_comment" id="text_comment" name="text_comment" placeholder="Inser Youtube Embed Code" required="required"> 
				  <button type="submit" id="btn">Post Youtube Video</button>
			  </form>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<div class="padding">
	
	<!--ENDED: End message-->
	<?php
	  
  } // admin end code
  
  ?> 
  
  
  <div class="promote_wrap">
	<div class="sql_error_text">
	<h2>Promotional Videos</h2>
	
  
	<?php
	
	if (isset($_POST['order']) && ($_POST['type']) && ($_POST['size']) ) {
		
		$order = $_POST['order'];
		$type = $_POST['type'];
		$size = $_POST['size'];
		$selected = $type. " ". $order. " ". "limit ". $size;
		echo "Selected Search Query: ORDER: $order, TYPE: $type, LIMIT: $size " ;
	} else {
		echo "Default: ORDER: DESCENDING, TYPE: ID, LIMIT: 2 ";
		$selected = "ID DESC limit 2";
		$order = "DESC";
		$type = "ID";
		$size = "2";
	}
	?>
  
	<?php
  
	$query9 = "SELECT * FROM promote ORDER BY ".$selected." ";
		 
	$result9 = mysql_query($query9);
	
	if($result9 !== FALSE) {
	   ?>
		 <div class="tp"> 
		 <form action="promote.php" method="post">
			<select name="order" size="1">
			  <option <?php if($order == 'ASC'){echo("order");}?>>ASC</option>
			  <option <?php if($order == 'DESC'){echo("order");}?>>DESC</option>
			</select>
			
			<select name="type" size="1">
			  <option <?php if($type == 'ID'){echo("type");}?>>ID</option>
			  <option <?php if($type == 'reg_date'){echo("type");}?>>reg_date</option>
			</select>
			
			<select name="size" size="1"> 
			  <option <?php if($size == '2'){echo("size");}?>>2</option>
			  <option <?php if($size == '5'){echo("size");}?>>5</option>
			  <option <?php if($size == '10'){echo("size");}?>>10</option>
              <option <?php if($size == '15'){echo("size");}?>>15</option>
              <option <?php if($size == '30'){echo("size");}?>>30</option> 
              <option <?php if($size == '50'){echo("size");}?>>50</option>
              <option <?php if($size == '100'){echo("size");}?>>100</option> 
              <option <?php if($size == '1000'){echo("size");}?>>1000</option> 
			</select>
	  
			<button type="submit" class="button2" id="button2">Sort By</button>
		  </form>
		  </div>
		</div>
		<?php 
  
  
	//select data from waiting_list_$event_name & users table -------------------------------------------//
	while($promo = mysql_fetch_array($result9)){
		?>
		<div class="content"> <h1>Promotional Videos</h1>
		  <?php echo $promo['promote']; 
		  $promo['id'];
		  $id = $promo['id'];
		  
		  // admin check for delete button     
		  if (!(isset($_SESSION['username']) && $_SESSION['username'] == "admin") ) { 
		  
		  } else { ?>
			  
			<div class="spacedb">
			<form action="promote_delete.php" method="post" name="delete promo">
			  <input type="hidden" name="id" id="id" class="id" readonly hidden="" value="<?php echo $id ?>" placeholder="<?php echo $id ?>"  required/>
			  <button type="submit" id="btn2" onclick="return confirm('Are you sure?')">Delete Promote Video</button>
			</form>
		   </div> <?php
		   }  ?>
		</div>
		<?php
	} // loop promo content end
	  
  } // content check = >1 END
  
  //content = 0, then, START
  else {
	  
   ?>
	 <div class="sql_error_text">
	   <img name="ERROR_SQL" src="Images/Website/SQL_error/SQL_ERROR.jpg" width="600" height="340" alt="If no content exists then display this" />
	   <div class="sql_error_text"><p>Doesn't Exist</p></div>
	 </div>
     </div>
   <?php
	  
  } //content = 0, then. END
  
  ?>
  </div>
  
  <?php
	
}
// -- FUNCTION PROMO END ------------------------------------------------------------------------------------------------------------------------------------------------------------------//

function lists() {
  include('db.php'); //include db connection
  
  //session, getting variables, check function
  if(!empty($_REQUEST['event_name'])) {
   
	$event_name=$_REQUEST['event_name'];
	$_SESSION["event_name2"] =$event_name;
	 
  } else {
	   $event_name = $_SESSION["event_name2"];
  }
  
  //loop waiting list for $event --------------------------------------------------------------------------------------------//
  $query9 = "SELECT * FROM ".$event_name." WHERE (attending='N/A' AND waiting_list='false')";
	   
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
			  <?php echo $event_username; ?>
			  <?php echo $event_firstname; ?>
			  <?php echo $event_surname; ?>
			  <?php echo $event_gender; ?>
			  <?php echo $event_DOB; ?>
		</div>   
		  
	</div>
	  
  
  <?php
  } // ends loop for registrant details from database ---------------------------------------------------//
  //loop waiting list for $event ended---------------------------------------------------------------------------------------//
  ?>
  
	</div>
	
		<div class="content_inner">
		<div class="content_text">
		  <p>Attended<p>
		</div>
		
		<?php
  
  //loop waiting list for $event --------------------------------------------------------------------------------------------//
  $query9 = "SELECT * FROM ".$event_name." WHERE (attending='true' AND waiting_list='false')";
	   
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
			  <?php echo $event_username; ?>
			  <?php echo $event_firstname; ?>
			  <?php echo $event_surname; ?>
			  <?php echo $event_gender; ?>
			  <?php echo $event_DOB; ?>
		</div>   
		  
	</div>
	  
  
  <?php
  } // ends loop for registrant details from database ---------------------------------------------------//
  //loop waiting list for $event ended---------------------------------------------------------------------------------------//
  ?>
  
	</div>
	
		<div class="content_inner">
		<div class="content_text">
		  <p>Waiting List<p>
		</div>
		
		<?php
  
  
  //loop waiting list for $event --------------------------------------------------------------------------------------------//
  $query9 = "SELECT * FROM ".$event_name." WHERE (attending='N/A' AND waiting_list='true')";
	   
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
			  <?php echo $event_username; ?>
			  <?php echo $event_firstname; ?>
			  <?php echo $event_surname; ?>
			  <?php echo $event_gender; ?>
			  <?php echo $event_DOB; ?>
		</div>   
		  
	</div>
	  
  <?php
  } // ends loop for registrant details from database ---------------------------------------------------//
  //loop waiting list for $event ended---------------------------------------------------------------------------------------//

} // END FUNCTION

function error_style() {
	?>
    <style type="text/css">
	.error {
		margin-top:300px;
		margin-bottom:300px;
		font-size:24px;
		width:95%;
		min-height: 50px;
		padding:2.5%;
		margin:0 auto;
		background-color: #27b8d1;
		text-align:center;
		color:#FFF;
	}
	</style>
    <?php
}
?>