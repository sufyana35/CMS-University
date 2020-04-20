<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Leave Feedback</title>
<link href="CSS/leave_feedback.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 
include('header.php'); //include header section
include('db.php'); //include db connection
include('function_login.php'); //login functions
user_login(); // check user log in

//get variables and check
if(!empty($_POST['event_name'])) {
  $event_name=$_POST['event_name'];
} else {
   $event_name = $_SESSION["event_name"];
}

$_SESSION["username"];
$username_post = $_SESSION["username"];

//join tables
$query = "SELECT events.*, images.* 
FROM events
LEFT JOIN images
on events.event_name=images.event_name
WHERE events.event_name = '$event_name'
ORDER BY events.id";

//query data
$result = mysql_query($query) or die(mysql_error());

?>
<div class="event">
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
	
	$_SESSION['event_name'] = $event_name;
	
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
            
        </div>
      
    </div>

  </div>
  
<?php
} // ends loop for getting event content from database 
?>

</div>

<div class="event_search">
  <div class="search">
      <div class="box2">
    
      <h1>Chat Room Interaction</h1>
      <hr>
        <h2>Event Name: <?php echo "$event_name" ?></h2>
      </div>
    </div>
    
    <!--START: Insert message-->
    <div class="box_comment">
      <div class="search_inner">
        <div class="search_outer">
          <div class="bs-example">
            <form id="chat_room" action="insert_feedback.php" method="post"> 
                
                <input type="text" class="text_comment" id="text_comment" name="text_comment" placeholder="Type Your Comment" required>
                <input type="hidden" name="event_name" id="event_name" class="event_name" readonly hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>    
                <span class="rating">
                      <input type="radio" class="rating-input" required
                              id="rating-input-1-5" name="rating_input" value="5"/>
                      <label for="rating-input-1-5" class="rating-star"></label>
                      <input type="radio" class="rating-input" required
                              id="rating-input-1-4" name="rating_input" value="4"/>
                      <label for="rating-input-1-4" class="rating-star"></label>
                      <input type="radio" class="rating-input" required
                              id="rating-input-1-3" name="rating_input" value="3"/>
                      <label for="rating-input-1-3" class="rating-star"></label>
                      <input type="radio" class="rating-input" required
                              id="rating-input-1-2" name="rating_input" value="2"/>
                      <label for="rating-input-1-2" class="rating-star"></label>
                      <input type="radio" class="rating-input" required
                              id="rating-input-1-1" name="rating_input" value="1"/>
                      <label for="rating-input-1-1" class="rating-star"></label>
                </span>
                
                <input type="hidden" name="username_post" id="username_post" class="username_post" readonly hidden="" value="<?php echo $username_post ?>" placeholder="<?php echo $username_post ?>"  required/>
                <button type="submit" id="btn">Post Comment</button>
            </form>
          </div>
        </div>
      </div>
      </div>
    
    <!--ENDED: End message-->
    
    <!-- PHP Comment loop function-->
    
    <div class="message_wrap">   
    <?php
	//loop waiting list for $event --------------------------------------------------------------------------------------------//
	$query_comment = "SELECT * FROM feedback".$event_name." ORDER BY id DESC";
		 
	$result_comment = mysql_query($query_comment) or die(mysql_error());
	
	//select data from waiting_list_$event_name & users table -------------------------------------------//
	while($comments = mysql_fetch_array($result_comment)){
	   
	   $id = $comments['id'];
	   $user_name_feedback = $comments['user_name_feedback'];
	   $event_name = $comments['event_name'];
	   $rating2 = $comments['rating'];
	   $comments2 = $comments['comments'];
	   ?>
	
      <!-- PHP Comment loop function-->
      
      <div class="wrap_inner">
      <div class="message_outer">
        <div class="message">
          <div class="message_details">
            <div class="spaced">
              <?php echo "User: ", $user_name_feedback; ?>
            </div>
            <div class="spaced">
              <?php echo "Rating: ", $rating2; ?>
            </div>
		  <?php
		  
			if ($username_post == "admin") {
			  ?> <div class="spacedb">
					<form action="delete_feedback_admin.php" method="post" name="delete comment">
					  <input type="hidden" name="event_name" id="event_name" class="event_name" readonly hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
					  <input type="hidden" name="uid" id="uid" class="uid" readonly hidden="" value="<?php echo $uid ?>" placeholder="<?php echo $uid ?>"  required/>
					  <button type="submit" id="btn2" onclick="return confirm('Are you sure?')">Delete Comment</button>
                    </form>
					<?php $_SESSION["uid"] = $id; ?>
				 </div> <?php 
		  } else {
			  
		  }
		  
			if (($user_name_feedback == $username_post) 
			&& ($username_post != "admin")) {
			  ?> <div class="spacedb">
					<form action="delete_feedback.php" method="post" name="delete comment">
					  <input type="hidden" name="event_name" id="event_name" class="event_name" readonly hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
					  <input type="hidden" name="uid" id="uid" class="uid" readonly hidden="" value="<?php echo $uid ?>" placeholder="<?php echo $uid ?>"  required/>
					  <button type="submit" id="btn2" onclick="return confirm('Are you sure?')">Delete Comment</button>
			  </form>
			  
					<?php $_SESSION["uid"] = $id; ?>
				 </div>
                 
                  <?php 
		  } else {
			  
		  }
			?>
            <div class="spaced_right">
			<?php echo "Post: ",$id; ?>
		  </div>
		</div>
		<?php
		if($username_post == "admin") {
	   ?> 
            <form action="table_edit_feedback.php" method="post" name="update feedback">
              <input type="hidden" readonly hidden="" name="event_name" id="event_name" class="event_name" readonly  value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
              <input type="hidden" name="uid" id="uid" class="uid" readonly hidden="" value="<?php echo $id ?>" placeholder="<?php echo $id ?>"  required/>
              <input type="text2" name="comments2" id="comments2" placeholder="<?php echo $comments2 ?>" value="<?php echo $comments2 ?>" class="text2" required/>
              <input type="hidden" name="url" id="url" class="url" readonly hidden="" value="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>" placeholder="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>"  required/>
            <button type="submit" id="comment" onclick="return confirm('Are you sure?')">Update Comment</button>
          </form>

  <?php } else {
      
      if (($user_name_feedback == $username_post) 
      && ($username_post != "admin")) { ?>
           
            <form action="table_edit_feedback.php" method="post" name="update feedback">
              <input type="hidden" readonly hidden="" name="event_name" id="event_name" class="event_name" readonly  value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
              <input type="hidden" name="uid" id="uid" class="uid" readonly hidden="" value="<?php echo $id ?>" placeholder="<?php echo $id ?>"  required/>
              <input type="text2" name="comments2" id="comments2" placeholder="<?php echo $comments2 ?>" value="<?php echo $comments2 ?>" class="text2" required/>
              <input type="hidden" name="url" id="url" class="url" readonly hidden="" value="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>" placeholder="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>"  required/>
            <button type="submit" id="comment" onclick="return confirm('Are you sure?')">Update Comment</button>
          </form>
         <?php
      } else {
		  echo "<div class='over'>".$comments2."</div>";
      }
		
	  } ?>
	</div>
  </div>
  </div>
	
  
  <?php
  } // ends loop for registrant details from database ---------------------------------------------------//
  //loop waiting list for $event ended---------------------------------------------------------------------------------------//
?>
</div>
</div>

<div class="wrp">

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
?>

</div>
</div>

<?php include('footer.php'); //include footer section?>

</body>
</html>