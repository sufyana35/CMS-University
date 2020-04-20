<?php
//function login check
function user_login() {
  
  //if else statement to check user status, Start
  if (!(isset($_SESSION['login']) && $_SESSION['login'] != 0)) {
  
	  // if not logged in display

	  // GO TO PAGE SPECIFIED
	  header( "refresh:10 url=/Charityfiy/User%20Accounts.php" );?>
	  <link href="CSS/account_error.css" rel="stylesheet" type="text/css">
  
	  <div class="frame">
		<div class="logo">
		</div>
		
		<div class="content">
		  <img src="Images/Website/User accounts/error.png" alt="" name="error" width="445" id="error" />
		  
		  <div class="message">
			 <p>You need to be logged in to display this page. Re-directing you to the login page</p>
		  </div>
		  
		  <div class="message2">
			 <p>You will be re-directed to the login page in 10 seconds.
			 If not re-directed <a href="User Accounts.php" class="hover">click here</a>
		  </div>
		  
		</div>
		
	  </div>
	  <?php
	  include('footer.php'); // include footer
	  exit();
	  
  } else{ 
	  //do nothing
  } //if else statement to check user status, END
  
} // function login end

//function admin check START
function user_admin() {
  //id admin else statement check
  if (!(isset($_SESSION['username']) && $_SESSION['username'] == "admin") ) {
	  
	  // if not logged in display
	  // GO TO PAGE SPECIFIED
	  header( "refresh:10 url=/Charityfiy/User%20Accounts.php" );?>
	  <link href="CSS/account_error.css" rel="stylesheet" type="text/css">
  
	  <div class="frame">
		<div class="logo">
		</div>
		
		<div class="content">
		  <img src="Images/Website/User accounts/error.png" alt="" name="error" width="445" id="error" />
		  
		  <div class="message">
			 <p>Admin user need to be logged in to display this page. Re-directing you to the login page</p>
		  </div>
		  
		  <div class="message2">
			 <p>You will be re-directed to the login page in 10 seconds.
			 If not re-directed <a href="User Accounts.php" class="hover">click here</a>
		  </div>
		  
		</div>
		
	  </div>
	  <?php
	  include('footer.php'); // include footer
	  exit();
	  
  } else {
	  
  } //do nothing

} // function admin. END



?>