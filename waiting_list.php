<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Waiting List</title>
<link href="CSS/Events.css" rel="stylesheet" type="text/css" />
</head>

<body>


<?php 
include('header.php'); // include header connection
include('db.php'); // db connection
include('function_login.php'); //include login functions
user_admin(); //check admin function

//join tables
$query = "SELECT events.*, images.* 
FROM events
LEFT JOIN images
on events.event_name=images.event_name
ORDER BY events.id";
	 
$result = mysql_query($query) or die(mysql_error());

?>
<div class="event">
  <div class="title">
    <p>Waiting List Events</p>
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
      <form id="register-form" action="process_waiting_list.php" method="post">          
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
      <button type="submit" class="button">Waiting List</button>
      </form>
    </div>
  </div>
  
<?php
} // ends loop for getting event content from database 
?>

</div>

<?php include('footer.php'); ?>

</body>
</html>