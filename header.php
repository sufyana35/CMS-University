<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Header</title>
<link href="CSS/header.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/png" href="http://www.favicon.cc/logo3d/242527.png"/>
</head>

<body>
<div class="main">

  <div class="navigation">
  <div class="logo">
  </div>
  
   <?php
  session_start(); //stores, retrieves sessions across website
  if (!(isset($_SESSION['login']) && $_SESSION['login'] != 0)) {
  
	// if not logged in display
	?>
	<a class="menu2" href="User Accounts.php" tabindex="2" target="_parent">log in</a>  
	<?php
  
  } else{
	
	//if logged in store session global
	$_SESSION["username"];
	$_SESSION["firstname"];
	$_SESSION["surname"];
	$_SESSION["email"];
	$_SESSION["gender"];
	$_SESSION["DOB"];
  
	?>
	<a class="menu2" href="log_out.php" tabindex="2" target="_parent">Log Out</a>
	<a class="menu2" href="your_account.php" tabindex="2" target="_parent">Your Account</a>
	<a class="menu2" href="bulletin_board_test.php" tabindex="2" target="_parent">Bulletin Board</a> 
	
	<?php
  
  }
	
  //Display global, public, admin, logged in
  ?>   
  <a class="menu2" href="Events.php" tabindex="2" target="_parent">Events</a>   
  <a class="menu2" href="promote.php" tabindex="1" target="_parent">Promote</a> 
  <a class="menu2" href="Index.php" tabindex="1" target="_parent">Home</a>
               
  </div> 
  
  <div class="banner">
  </div>
  
  <div class="bannercontent">
  </div>
</div>
</body>
</html>