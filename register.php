<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
<link href="CSS/account_error.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
include('db.php'); //db connection
include('update_event_list.php'); //update waiting list
include('function_login.php'); //check if user logged in

session_start();

// gets values from form Events.php
$event_vacancy=$_POST['event_vacancy'];
$_SESSION["event_vacancy"];
$_SESSION["event_vacancy"] = $event_vacancy;

$event_name=$_POST['event_name'];

//removes spaces from variable
$event_name=preg_replace('/\s+/', '', $event_name);

$_SESSION["username"];
$username = $_SESSION["username"];
$_SESSION["username"] = $username;
// end getting main values

//removes spaces	
$event_name=preg_replace('/\s+/', '', $event_name);
	
// Function select table, count rows and if else statements
$sql="SELECT * FROM ".$event_name." WHERE waiting_list='false' ";
if ($result=mysqli_query($conn,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);

  // Free result set
  mysqli_free_result($result);
  
	//register guestlist function ---------------------------------------------------------------------------------------------------------------//
	if ($rowcount >= $event_vacancy) {
	  	  
	  //register function ---------------------------------------------------------------------------------------------------------------//
	  if ($_SESSION['login'] != '1') {
		//Re-directs to "account_error_event.php"
		$account_error = "You need to be logged in to register";
		$_SESSION["account_error"] = $account_error; 
		header("location:account_error.php");
	  
	  } else{
		  
		// If registered re-direct to error page and make user log in// 		
		$sql="SELECT * FROM ".$event_name." WHERE event_username='$username'";
		$result=mysql_query($sql);
		
		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		
		// If result = username in database then user cannot register------------//
		if($count==1){
		
		  // checks if user has already registered for current event
		  $_SESSION["username"] = $username;
		  
		  //Re-directs to "account_error_event.php" 
			header("location:account_error_event.php");
			
		// If registered re-direct to error page and make user log in (function ended)-----// 
		  
			
	  } 
		
		else {
		
		  // register user ------------------------------------------------------------------------------------------------------------------//
		  // insert data into the database
		  $sql="INSERT INTO ".$event_name." (event_name,event_username, waiting_list, attending)
			   VALUES ('$event_name','$username', 'true', 'N/A')";
		  $result=mysql_query($sql);	
			
		  // if successfully insert data into database, displays message "Successful".
		  //Re-directs to success page then back to events page
		  ?>
		  
		  <div class="frame">
		  <div class="logo">
		  </div>
		  
		  <div class="content">
			<img src="Images/Website/User accounts/success.png" alt="" name="error" width="445" id="error" />
			
			<div class="message">
			   <?php  
				  echo "Registered For Event: "."<br>";
				?>
		
			</div>
			
			<div class="message2">
				<p>You have been added to the waiting list and will be
				automatically added to the event list when if a vacancy should arise.
				You will be notified by email.</p>
			   <p>You will be re-directed to the events page in 25 seconds
			   If not re-directed <a href="Events.php" class="hover">click here</a>
			</div>
			
		  </div>
		  
		</div>
		
		<?php
		// email function
		include('header.php');
		$email = $_SESSION["email"];
		echo $to = 'admin@charityfiy.com,' . "$email";

		 // subject
		$subject = 'Waiting List Enrolment';
		
		// message
		$message = '
		
		<html>
			<body style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; margin:0; padding:0;">
				<div style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; margin:0; padding:0;">
					<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%">
						<tr>
							<td align="center" valign="top" style="padding:20px 0 20px 0">
								<!-- [ header starts here] -->
								<table bgcolor="FFFFFF" cellspacing="0" cellpadding="10" border="0" width="650" style="border:1px solid #E0E0E0;">
									<!-- [ middle starts here] -->
									<tr>
										<td valign="top">
											<h1 style="font-size:22px; font-weight:normal; line-height:22px; margin:0 0 11px 0;">Dear Charityfiy User</h1>
											<p style="font-size:12px; line-height:16px; margin:0 0 16px 0;">The primary aim of these events is to raise money for the current refugee crisis in Europe. :</p>
											<p style="border:1px solid #E0E0E0; font-size:24px; line-height:16px; margin:0 0 16px 0; padding:13px 18px; background:#f9f9f9;"><strong>Verification Code:</strong> '.$event_name.' <br/></p>
											<p style="font-size:12px; line-height:16px; margin:0 0 16px 0;">If you do not know why you have received this e-mail, please delete it</p>
											<p style="font-size:12px; line-height:16px; margin:0 0 16px 0;">Not enough vacancies are available and you have been added to the waiting list.</p>
		
		
											<p style="font-size:12px; line-height:16px; margin:0 0 16px 0;">If a vacancy should arise you will be automatically added to the event list and a email confirmation will be sent .</p>                                    
											<p style="font-size:12px; line-height:16px; margin:0 0 16px 0;">If you have recieved this email in error then please do not reply and delete this message</p>
										</td>
									</tr>
									<tr>
										<td bgcolor="#EAEAEA" align="center" style="background:#EAEAEA; text-align:center;"><center><p style="font-size:12px; margin:0;"><strong>Charityfiy Human Resource Team</strong></p></center></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			</body>
		</html>
		';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Mail it
		mail($to, $subject, $message, $headers);
		//email function end
		?>
		
		</body>
		</html>
	
	<?php
	  }
	}
	?>
	
	</body>
	</html>
	<?php
  
	//register function ended-----------------------------------------------------------------------------------------------------------//  
	//register guestlist function ---------------------------------------------------------------------------------------------------------------//
	  	 	 
	}
		
	else
	{
	  //register function ---------------------------------------------------------------------------------------------------------------//
	  if ($_SESSION['login'] != '1') {
	  //Re-directs to "account_error_event.php"
	  $account_error = "You need to be logged in to register";
	  $_SESSION["account_error"] = $account_error; 
	  header("location:account_error.php");
	
	} else{
	  
	  // If registered re-direct to error page and make user log in// 		
	  $sql="SELECT * FROM ".$event_name." WHERE event_username='$username'";
	  $result=mysql_query($sql);
	  
	  // Mysql_num_row is counting table row
	  $count=mysql_num_rows($result);
	  
	  // If result = username in database then user cannot register------------//
	  if($count==1){
	  
		// checks if user has already registered for current event
		$_SESSION["username"] = $username;
		
		//Re-directs to "account_error_event.php" 
		header("location:account_error_event.php");
		  
	  // If registered re-direct to error page and make user log in (function ended)-----// 
		
	  } else	
		
		  // register user ------------------------------------------------------------------------------------------------------------------//
		  // insert data into the database
		  $sql="INSERT INTO ".$event_name." (event_name,event_username, waiting_list, attending)
					 VALUES ('$event_name','$username', 'false', 'N/A')";
		  $result=mysql_query($sql);	
			
		  // if successfully insert data into database, displays message "Successful".
		  //Re-directs to success page then back to events page
		  header( "refresh:10; url=/Charityfiy/Events.php" );?>
		  
		  <div class="frame">
		  <div class="logo">
		  </div>
		  
		  <div class="content">
			<img src="Images/Website/User accounts/success.png" alt="" name="error" width="445" id="error" />
			
			<div class="message">
			   <?php  
				  echo "Registered For Event: "."<br>";
				?>
		
			</div>
			
			<div class="message2">
			   <p>You will be re-directed to the events page in 10 seconds
			   If not re-directed <a href="Events.php" class="hover">click here</a>
			</div>
			
		  </div>
		  
		</div>
		
		</body>
		</html>
	
	  <?php
      }
      ?>

    </body>
    </html>
    <?php
	}
	  
  } elseif ($rowcount < $event_vacancy) {
	  
	  //register function ---------------------------------------------------------------------------------------------------------------//
	  if ($_SESSION['login'] != '1') {
	  //Re-directs to "account_error_event.php"
	  $account_error = "You need to be logged in to register";
	  $_SESSION["account_error"] = $account_error; 
	  header("location:account_error.php");
	
	} else{
	  
		// If registered re-direct to error page and make user log in// 		
		$sql="SELECT * FROM ".$event_name." WHERE event_username='$username'";
		$result=mysql_query($sql);
		
		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		
		// If result = username in database then user cannot register------------//
		if($count==1){
		
		  // checks if user has already registered for current event
		  $_SESSION["username"] = $username;
		  
		  //Re-directs to "account_error_event.php" 
			header("location:account_error_event.php");
			
		// If registered re-direct to error page and make user log in (function ended)-----// 
		
	  } else	
		
		  // register user ------------------------------------------------------------------------------------------------------------------//
		  // insert data into the database
		  $sql="INSERT INTO ".$event_name." (event_name,event_username, waiting_list, attending)
					 VALUES ('$event_name','$username', 'false', 'N/A')";
		  $result=mysql_query($sql);	
			
		  // if successfully insert data into database, displays message "Successful".
		  //Re-directs to success page then back to events page
		  header( "refresh:10; url=/Charityfiy/Events.php" );?>
		  
		  <div class="frame">
		  <div class="logo">
		  </div>
		  
		  <div class="content">
			<img src="Images/Website/User accounts/success.png" alt="" name="error" width="445" id="error" />
			
			<div class="message">
			   <?php  
				  echo "Registered For Event: "."<br>";
				?>
		
			</div>
			
			<div class="message2">
			   <p>You will be re-directed to the events page in 10 seconds
			   If not re-directed <a href="Events.php" class="hover">click here</a>
			</div>
			
		  </div>
		  
		</div>
		
		</body>
		</html>
	  
	  <?php
	  }
	  ?>

  </body>
  </html>
  <?php

//register function ended-----------------------------------------------------------------------------------------------------------//  
	  
} else {
	echo "a is smaller than b";
}
  
  

?>
  
  

