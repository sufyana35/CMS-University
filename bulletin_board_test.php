<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bulletin Board</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="scripts/typeahead.min.js"></script>
<link href="CSS/bulletin_board.css" rel="stylesheet" type="text/css" />
<link href="AJAX/list.css"rel="stylesheet" type="text/css" />
</head>

<body>
<?php

// INCLUDE databse connection % section of header
include('db.php'); // db connection
include('header.php'); // include header section
include('function_login.php'); //login function
user_login(); // check if user logged in


// User identifcation
$username = $_SESSION["username"];

// IF USER ADMIN REDIRECT TO SPECIFIED PAGE
if ($username == "admin") {
  header("location:bulletin_board.php"); //-- re-direct page for admin only, here the admin user will able to see all the bulletin boards that have content on --//
} else {

}

?>
<div class="image_register_process">
    <div class="white">
    <div class="search">
      <div class="box2">
    
      <h1>User Bulletin Board</h1>
      <hr>
        <h2><?php echo "$username" ?></h2>
      </div>
  
    </div>
  </div>
  
    
   <script type="text/javascript">
      function falseAttendeesList<?php echo $username; ?>() {
          $.ajax({
            url: 'AJAX/event_refresh.php?q=<?php echo $username; ?>'
              
          }).done(function(res) {
            $( ".attending_false_<?php echo $username; ?>").empty();
            $( ".attending_false_<?php echo $username; ?>").append(res);
          });
      }
  
      falseAttendeesList<?php echo $username; ?>();
  
      var setRefresh = setInterval(function (){falseAttendeesList<?php echo $username; ?>()}, 10000); // refresh every 10000 milliseconds
  
  </script>
  <div class="attending_false_<?php echo $username; ?>"> </div>


</div>
<?php include('footer.php'); ?>
</body>
</html>