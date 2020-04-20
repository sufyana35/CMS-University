<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Events</title>
<link href="CSS/Events.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
//include files
include('header.php'); //include header section
include('db.php'); //db connection
include('function_login.php'); //include login functions
user_login(); //check user login function

//variable equals sessions
$username = $_SESSION["username"];

//select & join two tables
$query = "SELECT events.*, images.* 
FROM events
LEFT JOIN images
on events.event_name=images.event_name
ORDER BY events.id";
	 
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
	
	$query9 = "SELECT * FROM ".$event_name." WHERE (event_username='$username')";
		 
	$result9 = mysql_query($query9) or die(mysql_error());
	
	//select data from waiting_list_$event_name & users table ----------------------------------------------------------------------------------//
	while($event_reg = mysql_fetch_array($result9)){
		
		$username = $event_reg['event_username'];
		
		?>
	
        <?php echo '
		
		<div class="event_content">
  
		<div class="portfoliobox3">
		
		<img src="'.$image_url.'"   div class="portfolioimg" " />
		
		</div>'
		
		
		 ?>
      
    
        <div class="event_display">
          <form id="delete-reg-user" action="delete_registration.php" method="post">          
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
                
            </div>
        </div>
      </div>
  
      <div class="event_more">
        <div class="portfoliotext2">
          <div class="button_class"> 
            <button type="submit" class="button2" id="button2" onclick="return confirm('Are you sure?')">Delete registration</button>
            </form>   
          </div>
        </div>
      </div>
  
  <?php
		
	} //end loop to check user registration
	
} // ends loop for getting event content from database 
?>

</div>

<!-- include footer -->
<?php include('footer.php'); // include footer section ?>

</body>
</html>