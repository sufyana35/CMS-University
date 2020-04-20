<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Event</title>
<link href="CSS/create_event.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
include('header.php'); //include db login
include('function_login.php'); //include login functions
user_admin(); //check admin function
?>


<div class="event">
  <div class="event_content">
    <form id="login-form" action="process_event.php" method="post" enctype="multipart/form-data">
          
      <div>
        <label for="name">Event Name</label>
        <input type="text" name="event_name" id="event_name" placeholder="Select Event Name" class="text" required/>
        <label for="location">Location</label>
        <input type="text" name="location" id="location" placeholder="Select Location" class="text" required/>
        <label for="vacancy">Vacancy</label>
        <input type="number" name="vacancy" id="vacancy"placeholder="Select Maximum Vacancy" class="text" required/>
        <label for="time">Time</label>
        <input type="time" name="time" id="time"placeholder="Select Time" class="text" required/>
        <label for="date">Date</label>
        <?php echo '<input type="date" name="date" min="'.date("Y-m-d").'" id="date"placeholder="Select Date" class="text" required/>' ?>
        <label for="image">Upload Image</label>
        <input name="myfile" id="myfile" type="file" value="myfile" required="required"/>
        <button type="submit" class="button">Create Event</button>
          
      </div>
    </form>
  </div>
  

</div>

<?php include('footer.php'); ?>

</body>
</html>