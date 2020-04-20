<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Account</title>
<link href="CSS/your_account.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 
include('header.php'); // db connection
include('function_login.php'); //include login functions
user_login(); //check user login function
 ?>
<div class="account">
  <div class="account_content">
  <div class="title2">
   <p>User Dashboard</p> 
  </div>
    <div class="socialbox">
    <a href="your_events.php"><img src="Images/Website/Your account/view_events.png" class="socialimage"/>
    </div>
  
    <div class="socialbox">
      <a href="your_details.php"><img src="Images/Website/Your account/your_details.png" class="socialimage"/>
    </div>
    
  </div>
</div>

<?php
if ($_SESSION['username'] == "admin") {
	
  ?>
  <div class="account_admin">
    <div class="account_content">
    
      <div class="socialbox">
        <a href="create_event.php"><img src="Images/Website/Your account/create_event.png" class="socialimage"/></a>
      </div>
      
      <div class="socialbox">
        <a href="edit_event.php"><img src="Images/Website/Your account/edit_events.png" class="socialimage"/></a>
      </div>
    
      <div class="socialbox">
        <a href="delete_event.php"><img src="Images/Website/Your account/delete_event.png" class="socialimage"/></a>
      </div>
      
      <div class="socialbox">
        <a href="registrant_details.php"><img src="Images/Website/Your account/registrant_details.png" class="socialimage"/></a>
      </div>
      
      <div class="socialbox">
       <a href="waiting_list.php"><img src="Images/Website/Your account/waiting_list.png" class="socialimage"/></a>
      </div>
      
      <div class="socialbox">
       <a href="register_attendees.php"><img src="Images/Website/Your account/register_attendees.png" class="socialimage"/></a>
      </div>
      
      <div class="socialbox">
       <a href="edit_comments_admin.php"><img src="Images/Website/Your account/edit_comments.png" class="socialimage"/></a>
      </div>
      
      <div class="socialbox">
       <a href="promote.php"><img src="Images/Website/Your account/promo_v.png" class="socialimage"/></a>
      </div>
      
      <div class="socialbox">
       <a href="update_event_list.php"><img src="Images/Website/Your account/update_list.png" class="socialimage"/></a>
      </div>
      
    </div>
  </div>
  <?php
  
} else {
	
}

include('footer.php'); ?>

</body>
</html>