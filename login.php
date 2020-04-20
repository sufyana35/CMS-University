<?php
include('db.php'); // include db connection

// define variables and set to empty values
$username = $password;

//start session, global
session_start();

// username and password sent from form 
$username=$_POST['username']; 
$password=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$password=md5($password); // Encrypted Password
$sql="SELECT * FROM users WHERE username='$username' and password='$password'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $username and $password, table row must be 1 row
if($count==1){
	
  $sql = "SELECT userID, firstname, surname, username, email, gender, DOB FROM users WHERE username='$username'";
  $result = $conn->query($sql);

  // output data of each row
  while($row = $result->fetch_assoc()) {
  $userID = $row['userID'];
  $firstname = $row['firstname'];
  $surname = $row['surname'];
  $username = $row['username'];
  $email = $row['email'];
  $gender = $row['gender'];
  $DOB = $row['DOB'];
  }

  // Register $username, $password and other details
  $_SESSION["password"] = $password;
  $_SESSION["userID"] = $userID;
  $_SESSION["firstname"] = $firstname;
  $_SESSION["surname"] = $surname;
  $_SESSION["username"] = $username;
  $_SESSION["email"] = $email;
  $_SESSION["gender"] = $gender;
  $_SESSION["DOB"] = $DOB;
  
  // Sets login status, this determines if the user is logged in or out throughout the website
  $_SESSION['login'] = "1";
  
  //redirect to file "login_success.php"
  header("location:account_success.php");
  }

 //if cannot log in then execute code below
 else {
  $username="";
  $password="";
  $_SESSION["username"] = $username;
  $_SESSION["password"] = $password;
  $account_error = "User name or Password is incorrect";
  $_SESSION["account_error"] = $account_error;
  
  //set login to 0 and re-direct to error page. > login page
  $_SESSION['login'] = "0";
  header("location:account_error.php");
}
?>


<?php 
// close connection 
mysql_close();
?>