<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Details</title>
<link href="CSS/create_event.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include('header.php'); // db connection
include('function_login.php'); //include login functions
user_login(); //check user login function
 
?>

<div class="event">
  <div class="title2">
    <p>Your Details</p>
  </div>
  <div class="event_content">
    <form id="login-form" action="login.php" method="post">
          
      <div>

        <label for="Firstname">Firstname</label>
        <div class="text"><?php echo $_SESSION["firstname"]; ?></div>
        
        <label for="Surname">Surname</label>
        <div class="text"><?php echo $_SESSION["surname"]; ?></div>
        
        <label for="User Name">User Name</label>
        <div class="text"><?php echo $_SESSION["username"]; ?></div>
        
        <label for="Email">Email</label>
        <div class="text"><?php echo $_SESSION["email"]; ?></div>
        
        <label for="Gender">Gender</label>
        <div class="text"><?php echo $_SESSION["gender"]; ?></div>
        
        <label for="DOB">Date Of Birth (DOB)</label>
        <div class="text"><?php echo $_SESSION["DOB"]; ?></div>
          
      </div>
    </form>
  </div>
  
</div>

<?php include('footer.php'); ?>


</body>
</html>