<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Success</title>
<link href="CSS/account_error.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php  
session_start();

// GO TO PAGE SPECIFIED
header( "refresh:10; url=/Charityfiy/Index.php" );
?>

<div class="frame">
  <div class="logo">
  </div>
  
  <div class="content">
    <img src="Images/Website/User accounts/success.png" alt="" name="error" width="445" id="error" />
    
    <div class="message">
       <p>User: 
	   <?php  
		  echo $_SESSION["username"]."<br>";
		  ?><p>Name: <?php
          echo $_SESSION["firstname"];
		  ?>  <?php
		  echo $_SESSION["surname"];
		  ?><p>Email: <?php
		  echo $_SESSION["email"]."<br>";
		  ?><p>Gender: <?php
		  echo $_SESSION["gender"]."<br>";
		  ?><p>DOB: <?php
		  echo $_SESSION["DOB"]."<br>";
	   ?>
       <p></p>
       <?php
		 echo $_SESSION["username"] ?>
		 has been successfully created/logged in</p>
	  
       
    </div>
    
    <div class="message2">
       <p>You will be re-directed to the main page in 10 seconds
       If not re-directed <a href="Index.php" class="hover">click here</a>
    </div>
    
  </div>
  
</div>


</body>
</html>