<?php

include('db.php'); // database connection
include('functions.php'); //include functions
session_start(); // starts session

//checks Form Variables
if (!(isset($_POST['gender']) && ($_POST['password']) && ($_POST['age-year']) && ($_POST['age-month']) && ($_POST['age-day']) && ($_POST['email']) && ($_POST['username']) && ($_POST['surname']) && ($_POST['firstname']) )) {
	
  include('header.php'); // include header
  error_style(); //include style
  ?>
  <div class="error">
	<p>Please type in all the form fields and try again..</p>
  </div>
  <?php
  include('footer.php');
}

else {

  //post variables from form and do security/validation check
  $password = stripslashes($_POST['password']);
  $password = mysql_real_escape_string($_POST['password']);
  
  $username = stripslashes($_POST['username']);
  $username = mysql_real_escape_string($_POST['username']);
  $username = strip_tags($username);
  
  $gender = stripslashes($_POST['gender']);
  $gender = mysql_real_escape_string($_POST['gender']);
  $gender = strip_tags($gender);
  
  $firstname = stripslashes($_POST['firstname']);
  $firstname = mysql_real_escape_string($_POST['firstname']);
  $firstname = strip_tags($firstname);
  
  $surname = stripslashes($_POST['surname']);
  $surname = mysql_real_escape_string($_POST['surname']);
  $surname = strip_tags($surname);
  
  $email = stripslashes($_POST['email']);
  $email = mysql_real_escape_string($_POST['email']);
  $email = strip_tags($email);
  
  $day = stripslashes($_POST['age-day']);
  $day = mysql_real_escape_string($_POST['age-day']);
  $day = strip_tags($day);
  
  $month = stripslashes($_POST['age-month']);
  $month = mysql_real_escape_string($_POST['age-month']);
  $month = strip_tags($month);
  
  $year = stripslashes($_POST['age-year']);
  $year = mysql_real_escape_string($_POST['age-year']);
  $year = strip_tags($year);
  
  //DOB add variables together to form one variable
   echo $DOB = $day. "/". $month. "/". $year;

  //select table
  $sql2="SELECT * FROM users WHERE email='$email'";
  $result2=mysql_query($sql2);
  
  //check user table start
  if($result2 !== FALSE) {
	  
  } else {
	  
	// sql to create users if table doesn't exist
	$sql_users = "CREATE TABLE users (
	userID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	firstname VARCHAR(255) NOT NULL,
	surname VARCHAR(255) NOT NULL,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	gender VARCHAR(30) NOT NULL,
	DOB VARCHAR(30) NOT NULL,
	registration_date TIMESTAMP
	)";
	
	if ($conn->query($sql_users) === TRUE) {
		  // echo "Table $event_name created successfully"; 	 	 
	}
	
	else
	{
		  // echo "Table $event_name not created successfully";
	}
	  
  } //check user table END
  
  // Mysql_num_row is counting table row
  echo $count2=mysql_num_rows($result2);

  //FUNCTION EMAIL: count function
  if($count2==1) {
	//account error, parse information to error page. If email exists
	$account_error = "Email Address Already Exists";
	$_SESSION["account_error"] = $account_error;
	header("location:account_error.php");
	
  } else {
	//if email not exist then continue script
	echo "if email not exist";
  
	// To protect MySQL injection (more detail about MySQL injection)
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	$md5_pass = md5($password);
	$sql="SELECT * FROM users WHERE username='$username' and password='$password'";
	$result=mysql_query($sql);
	
	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);
	
	//FUNCTION START: USRNAME AND PASSWORD CHECK
	// If result matched $username and $password, table row must be 1 row
	if($count==1){
	
	  // checks $username, $password and redirect to file "account_error.php" if user exists
	  $_SESSION["firstname"] = $firstname;
	  $_SESSION["surname"] = $surname;
	  $_SESSION["username"] = $username;
	  $_SESSION["email"] = $email;
	  $_SESSION["gender"] = $gender;
	  $_SESSION["DOB"] = $DOB;
	  
	  //account error, parse information to error page if username exists
	  $account_error = "User Already Exists";
	  $_SESSION["account_error"] = $account_error;
	  header("location:account_error.php");
	
	  } else
	  //store variables in session
	  $_SESSION["firstname"] = $firstname;
	  $_SESSION["surname"] = $surname;
	  $_SESSION["username"] = $username;
	  $_SESSION["email"] = $email;
	  $_SESSION["gender"] = $gender;
	  $_SESSION["DOB"] = $DOB;
	  
	  // insert data into the database users
	  $sql="INSERT INTO users (firstname,surname,username,password,email,gender,DOB)
		   VALUES ('$firstname','$surname','$username','$md5_pass','$email','$gender','$DOB')";
	  $result=mysql_query($sql);			
	  
	  // if successfully insert data into database, displays message "Successful". 
	  if($result){
		//store variables in session
		$_SESSION["firstname"] = $firstname;
		$_SESSION["surname"] = $surname;
		$_SESSION["username"] = $username;
		$_SESSION["email"] = $email;
		$_SESSION["gender"] = $gender;
		$_SESSION["DOB"] = $DOB;
		$password = "hidden due to security reasons";
		$_SESSION["password"] = $password;
		
		// Sets login status to on, this determines if the user is logged in or out throughout the website
		$_SESSION['login'] = "1";
		
		//Re-directs to "account_sucess.php"
		header("location:account_success.php");
		
	  } else {
		// if any other error go back to form".
		$password = "hidden due to security reasons";
		$_SESSION["password"] = $password;
		$account_error = "Error Uknown";
		$_SESSION["account_error"] = $account_error;
		
		// Sets login status to off, this determines if the user is logged in or out throughout the website
		$_SESSION['login'] = "0";
		
		//Re-directs to "account_error.php" and parse $_SESSION["account_error"] variable to user
		header("location:account_error.php");
		
	} //FUNCTION END: IF ELSE FUNCTION FOR USERNAME AND PASSWORD
  } //FUNCTION END: IF ELSE FOR EMAIL

  // final resort if all else fails display a link". 
  $password = "hidden due to security reasons";
  $_SESSION["password"] = $password;
  
  //final resort if php error
  echo "<BR>";
  echo "<a href='index.php'>Back to main page</a>";
  
  ?> 
  
  <?php 
  // close connection 
  mysql_close();
 
}
?>

