<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Event</title>
<link href="CSS/Events.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php 
include('header.php'); //includer header connection
include('db.php'); //db connection
include('function_login.php'); //login functions
user_admin(); // check admin logged in

//select table, join tables code
$query = "SELECT events.*, images.* 
FROM events
LEFT JOIN images
on events.event_name=images.event_name
ORDER BY events.id";

//query
$result = mysql_query($query) or die(mysql_error());

?>
<div class="event">
  <div class="title">
    <p>Edit Events</p>
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
	
	
	// date function
	$dtA = $date;
	$dtB = date("Y-m-d");
	if ( $dtA > $dtB ) {
		
	
			?>
	
	<?php echo '
    
    <div class="edit">

    <div class="portfoliobox3">
    
    <img src="'.$image_url.'"   div class="portfolioimg" " />
    
    </div>'
    
     ?>
      
    
    <div class="event_display">
      <form id="edit-event" action="edit_event_process.php" method="post">          
        <div>
        <div class="portfoliotext2"><?php echo "".$event_name; ?></div>
          <label for="name">Event Name</label>
          <input type="text" name="event_name_new" id="event_name_new" placeholder="<?php echo "".$event_name; ?>" class="text" required/>
          <label for="location">Location</label>
          <input type="text" name="location" id="location" placeholder="<?php echo "".$location; ?>" class="text" required/>
          <label for="time">Time</label>
          <input type="time" name="time" id="time" placeholder="<?php echo "".$time; ?>" class="text" required/>
          <label for="time">Date</label>
          <?php echo '<input type="date" name="date" min="'.date("Y-m-d").'" id="date"placeholder="Select Date" class="text" required/>' ?>
          <label for="image">Upload Image</label>
          <?php echo "".$image_url; ?>
          <input name="myfile" id="myfile" type="file" value="myfile" required="required"/>        
          
          <div class="label_box">
          <label for="Date Created">Date Created</label>
          <div class="text"><?php echo "Created at: ".$reg_date; ?></div>
          
          <label for="vacancy">vacancy</label>
		  <div class="text"><?php echo "Maximum occupancy: ".$vacancy; ?></div>

          
          <input type="hidden" name="event_name" id="event_name" readonly="readonly" hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
          <input type="hidden" name="vacancy" id="vacancy" readonly="readonly" hidden="" value="<?php echo $vacancy ?>" placeholder="<?php echo $vacnacy ?>"  required/>
          
          
          </div>
       
            
        </div>
      
    </div>

  </div>
  
  <div class="event_more">
    <div class="portfoliotext2">
      <button type="submit" class="button" onclick="return confirm('Are you sure?')">Edit Event!</button>
      </form>
    </div>
  </div>
  
<?php
  } else {
	  
  }
} // if end
 


?>



</div>

<?php include('footer.php'); 

$conn->close();
?>

</body>
</html>