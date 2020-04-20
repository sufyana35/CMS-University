<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="CSS/Index.css" rel="stylesheet" type="text/css" />
<link href="CSS/Events.css" rel="stylesheet" type="text/css" />
</head>

<body
<?php 
include('header.php'); // header connection
include('db.php'); // db connection
include('functions.php'); //include login functions

?>
<div class="promo_main">
  <div class="iconwrap">
    <h1>Welcome To Charityfiy</h1>
    <div class="icon_outer">
      <div class="icon">
        <p>Register</p>
      </div>
    </div>
    
    <div class="icon_outer">
      <div class="icon">
       <p>Event</p>
      </div>
    </div>
    
    <div class="icon_outer">
      <div class="icon">
       <p>Attend</p>
      </div>
    </div>
    
    <div class="icon_outer">
      <div class="icon">
       <p>Feedback</p>
      </div>
    </div>
  
  </div>
</div>

<?php
promo(); // view promo content
?>

<!-- More info------------------------------------------------------------------------------------- -->
<div class="events">
  <div class="more_wrap_left">
    <form action="promote.php" method="post">
    <button type="submit" id="btn_wrap" style="width:100% !important;" >More Videos</button>
    </form>
    <hr />
    <form action="Events.php" method="post">
    <button type="submit" id="btn_wrap" style="width:100% !important;">View More Events</button>
    </form>
  </div>
  
  <div class="more_wrap_right">
    <div class="portfoliobox9">

    <div class="portfoliotext9">
      <p>Updated Regularly</p>
    </div>
  </div>
  </div>
</div>

<?php
//display the available events
display_event(); // event section
?>
</div>

<?php  ?>
<!-- End Display Event--------------------------------------------------------------------------------- -->

<?php include('footer.php'); ?>
</body>
</html>