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
?>

<?php 
 header( "refresh:10; url=http://localhost/Charityfiy/Index.php" );?>

<div class="frame">
  <div class="logo">
  </div>
  
  <div class="content">
    <img src="Images/Website/User accounts/success.png" alt="" name="error" width="445" id="error" />
    
    <div class="message">
       <p>User <?php echo $_SESSION["username"]; ?> has been successfully logged out</p>
       <?php
	   $_SESSION = array();
	   $_SESSION['login'] = "";
	   session_destroy();
	   
	   session_start();
	   $_SESSION['login'] = "0";
	   ?>
    </div>
    
    <div class="message2">
       <p>You will be re-directed to the main page in 10 seconds
       If not re-directed <a href="Index.php" class="hover">click here</a>
    </div>
    
  </div>
  
</div>


</body>
</html>