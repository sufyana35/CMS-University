<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Process Event</title>
<link href="CSS/create_event.css" rel="stylesheet" type="text/css" />
<link href="CSS/account_error.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
include('db.php'); // include db connection
include('header.php'); // include header
include('function_login.php'); //login functions
user_admin(); // check admin logged in
include('functions.php'); //include functions

//check post variable
if (!(isset($_POST['event_name']) && ($_POST['location']) && ($_POST['vacancy']) && ($_POST['time']) && ($_POST['date']) )) {

  error_style(); //include style
  ?>	
  <div class="error">
	<p>Error: Please type all the fields</p>
  </div>
  <?php
  include('footer.php'); // include footer section
	
} // end variable check. if variables exists then execute code below
else 
{

  $event_name=$_POST['event_name'];
  $location=$_POST['location'];
  $vacancy=$_POST['vacancy'];
  $time=$_POST['time'];
  $date=$_POST['date'];
  
  // sql to create table comments
  $sql = "CREATE TABLE comments (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  user_name_comment VARCHAR(50) NOT NULL,
  event_name VARCHAR(50) NOT NULL,
  comments VARCHAR(2500) NOT NULL,
  reg_date TIMESTAMP
  )";
  
  //table creation check
  if ($conn->query($sql) === TRUE) {
		// echo "Table $event_name created successfully";
			 
  }
  
  else
  {
		// echo "Table $event_name not created successfully";
  }
  
  // sql to create table Events
  $sql = "CREATE TABLE events (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  event_name VARCHAR(50) NOT NULL,
  location VARCHAR(100) NOT NULL,
  vacancy INT(6) NOT NULL,
  time VARCHAR(12) NOT NULL,
  date VARCHAR(12) NOT NULL,
  reg_date TIMESTAMP
  )";
  
  //query check
  if ($conn->query($sql) === TRUE) {
	  // echo "Table $event_name created successfully"; 
	  
	  //removes spaces from variable
	  $event_name=preg_replace('/\s+/', '', $event_name);

	  $sql = "INSERT INTO events (event_name, location, vacancy, time, date)
	  VALUES ('$event_name', '$location', '$vacancy', '$time', '$date')";
	  
	  //query check
	  if ($conn->query($sql) === TRUE) {
			// echo "Table $event_name created successfully"; 	 	 
	  }
	  
	  else
	  {
			// echo "Table $event_name not created successfully";
	  }
	  
	  // sql to create table event feedback
	  $sql = "CREATE TABLE feedback".$event_name." (
	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	  user_name_feedback VARCHAR(50) NOT NULL,
	  event_name VARCHAR(50) NOT NULL,
	  comments VARCHAR(2500) NOT NULL,
	  rating VARCHAR(255) NOT NULL,
	  reg_date TIMESTAMP
	  )";
	  
	  //query check
	  if ($conn->query($sql) === TRUE) {
		  
		  if($FILES["myfile"]["error"] > 0) {
			
		  }
		  else
		  {
			// Do nothing
		  }
		  
		  // sql to create table Images -----------------------------------------------------------------------------------------------------------//
		  $sql = "CREATE TABLE images (
		  image_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  image_url VARCHAR(255) NOT NULL,
		  image_title VARCHAR(255) NOT NULL,
		  event_name VARCHAR(255) NOT NULL
		  )";
		  
		  //query check
		  if ($conn->query($sql) === TRUE) {
			   // echo "Table $event_name created successfully";
			   
			   $upload_url = "uploads/" .$_FILES["myfile"]["name"];
			   $filename = $_FILES["myfile"]["type"];
			   move_uploaded_file($_FILES["myfile"]["tmp_name"], $upload_url);
			   
			   $sql = "INSERT INTO images (image_url, image_title, event_name)
			   VALUES ('$upload_url', '$filename', '$event_name')";
			   
			   $imageresults = mysqli_query ($conn, $sql);	 
		  }
		  
		  else
		  {
			   // echo "Table $event_name  not created successfully";
			   
			   $upload_url = "uploads/" .$_FILES["myfile"]["name"];
			   $filename = $_FILES["myfile"]["type"];
			   move_uploaded_file($_FILES["myfile"]["tmp_name"], $upload_url);
			   
			   $sql = "INSERT INTO images (image_url, image_title, event_name)
			   VALUES ('$upload_url', '$filename', '$event_name')";
			   
			   $imageresults = mysqli_query ($conn, $sql);
		  }
		  //--------------------------------------------------------------------------------------------------------------------------------//
		  
		  // sql to create events user ------------------------------------------------------------------------------------------------------//
		  

		  
		  $sql = "CREATE TABLE ".$event_name." (
		  event_user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  event_name VARCHAR(50) NOT NULL,
		  event_username VARCHAR(50) NOT NULL,
		  waiting_list VARCHAR(50) NOT NULL,
		  attending VARCHAR(50) NOT NULL,
		  reg_date TIMESTAMP
		  )";
		  
		  //query check
		  if ($conn->query($sql) === TRUE) {
				// echo "Table $event_name created successfully"; 	 	 
		  }
		  
		  else
		  {
				echo "Table $event_name not created successfully";
		  }
		  //---------------------------------------------------------------------------------------------------------------------------------//
		  
		  // Inserts main header page IE link

		  $_SESSION["event_name"] = $event_name;
		  $_SESSION["location"] = $location;
		  $_SESSION["vacancy"] = $vacancy;
		  $_SESSION["time"] = $time;
		  $_SESSION["date"] = $date; 
		  ?>
		  
		  <div class="event">
			<div class="content_title">
			<p>Event Created</p>
			</div>
			<div class="event_inner">
			  <div class="event_content">
				<form id="login-form" action="login.php" method="post">    
				  <div>
					<label for="event_name">Event Name</label>
					<div class="text"><?php echo $_SESSION["event_name"]; ?></div>
					
					<label for="location">Location</label>
					<div class="text"><?php echo $_SESSION["location"]; ?></div>
					
					<label for="vacancy">vacancy</label>
					<div class="text"><?php echo $_SESSION["vacancy"]; ?></div>
					
					<label for="time">Time</label>
					<div class="text"><?php echo $_SESSION["time"]; ?></div>
					
					<label for="date">Date</label>
					<div class="text"><?php echo $_SESSION["date"]; ?></div>
					  
				  </div>
				</form>
			  </div>
			  
			  <div class="event_content">
				<form id="login-form" action="login.php" method="post">          
					<div>
					  <label for="event_name">File</label>
					  <div class="text"><?php echo "Upload:".$_FILES["myfile"]["name"]; ?></div>
					  
					  <label for="location">Image</label>
					  <div class="text"><?php echo "Type:".$_FILES["myfile"]["type"]; ?></div>
					  
					  <label for="vacancy">Size</label>
					  <div class="text"><?php echo "Size:".($_FILES["myfile"]["size"]/1024); ?></div>
					  
					  <label for="time">Location</label>
					  <div class="text"><?php echo "Stored in:".$_FILES["myfile"]["tmp_name"]; ?></div>
						
					</div>
				  </form>
			  </div>   
			</div> 
		  </div>
		  
		  <?php
		  // Inserts footer page IE link
		  include('footer.php'); // include footer section	
		  
	  } else {
		  echo "Error: " . $sql . "<br>" . $conn->error; // error display if error
	  }
	  	 	 
  }
  
  else // if table events table exists then execute this code below
  {
  // echo "Table $event_name not created successfully";
	  
  $sql = mysql_query("SELECT * FROM events WHERE event_name='$event_name'");
  $count = mysql_num_rows($sql);
  
  // If result = 1 then do not create the same event------------//
  if($count!=1){

	  //removes spaces from variable
	  $event_name=preg_replace('/\s+/', '', $event_name);

	  $sql = "INSERT INTO events (event_name, location, vacancy, time, date)
	  VALUES ('$event_name', '$location', '$vacancy', '$time', '$date')";
	  
	  //query check
	  if ($conn->query($sql) === TRUE) {
			// echo "Table $event_name created successfully"; 	 	 
	  }
	  
	  else
	  {
			// echo "Table $event_name not created successfully";
	  }
	  
	  // sql to create table event feedback
	  $sql = "CREATE TABLE feedback".$event_name." (
	  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	  user_name_feedback VARCHAR(50) NOT NULL,
	  event_name VARCHAR(50) NOT NULL,
	  comments VARCHAR(2500) NOT NULL,
	  rating VARCHAR(255) NOT NULL,
	  reg_date TIMESTAMP
	  )";
	  
	  //query check
	  if ($conn->query($sql) === TRUE) {
		  
		  if($FILES["myfile"]["error"] > 0) {
			
		  }
		  else
		  {
			// Do nothing
		  }
		  
		  // sql to create table Images -----------------------------------------------------------------------------------------------------------//
		  $sql = "CREATE TABLE images (
		  image_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  image_url VARCHAR(255) NOT NULL,
		  image_title VARCHAR(255) NOT NULL,
		  event_name VARCHAR(255) NOT NULL
		  )";
		  
		  //query check
		  if ($conn->query($sql) === TRUE) {
			   // echo "Table $event_name created successfully";
			   
			   $upload_url = "uploads/" .$_FILES["myfile"]["name"];
			   $filename = $_FILES["myfile"]["type"];
			   move_uploaded_file($_FILES["myfile"]["tmp_name"], $upload_url);
			   
			   $sql = "INSERT INTO images (image_url, image_title, event_name)
			   VALUES ('$upload_url', '$filename', '$event_name')";
			   
			   $imageresults = mysqli_query ($conn, $sql);	 
		  }
		  
		  else
		  {
			   // echo "Table $event_name  not created successfully";
			   
			   $upload_url = "uploads/" .$_FILES["myfile"]["name"];
			   $filename = $_FILES["myfile"]["type"];
			   move_uploaded_file($_FILES["myfile"]["tmp_name"], $upload_url);
			   
			   $sql = "INSERT INTO images (image_url, image_title, event_name)
			   VALUES ('$upload_url', '$filename', '$event_name')";
			   
			   $imageresults = mysqli_query ($conn, $sql);
		  }
		  //--------------------------------------------------------------------------------------------------------------------------------//
		  
		  // sql to create events user ------------------------------------------------------------------------------------------------------//
		  
		  $sql = "CREATE TABLE ".$event_name." (
		  event_user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  event_name VARCHAR(50) NOT NULL,
		  event_username VARCHAR(50) NOT NULL,
		  waiting_list VARCHAR(50) NOT NULL,
		  attending VARCHAR(50) NOT NULL,
		  reg_date TIMESTAMP
		  )";
		  
		  //query check
		  if ($conn->query($sql) === TRUE) {
				// echo "Table $event_name created successfully"; 	 	 
		  }
		  
		  else
		  {
				echo "Table $event_name not created successfully";
		  }
		  //---------------------------------------------------------------------------------------------------------------------------------//
		  
		  // Inserts main header page IE link

		  $_SESSION["event_name"] = $event_name;
		  $_SESSION["location"] = $location;
		  $_SESSION["vacancy"] = $vacancy;
		  $_SESSION["time"] = $time;
		  $_SESSION["date"] = $date; 
		  ?>
		  
		  <div class="event">
			<div class="content_title">
			<p>Event Created</p>
			</div>
			<div class="event_inner">
			  <div class="event_content">
				<form id="login-form" action="login.php" method="post">    
				  <div>
					<label for="event_name">Event Name</label>
					<div class="text"><?php echo $_SESSION["event_name"]; ?></div>
					
					<label for="location">Location</label>
					<div class="text"><?php echo $_SESSION["location"]; ?></div>
					
					<label for="vacancy">vacancy</label>
					<div class="text"><?php echo $_SESSION["vacancy"]; ?></div>
					
					<label for="time">Time</label>
					<div class="text"><?php echo $_SESSION["time"]; ?></div>
					
					<label for="date">Date</label>
					<div class="text"><?php echo $_SESSION["date"]; ?></div>
					  
				  </div>
				</form>
			  </div>
			  
			  <div class="event_content">
				<form id="login-form" action="login.php" method="post">          
					<div>
					  <label for="event_name">File</label>
					  <div class="text"><?php echo "Upload:".$_FILES["myfile"]["name"]; ?></div>
					  
					  <label for="location">Image</label>
					  <div class="text"><?php echo "Type:".$_FILES["myfile"]["type"]; ?></div>
					  
					  <label for="vacancy">Size</label>
					  <div class="text"><?php echo "Size:".($_FILES["myfile"]["size"]/1024); ?></div>
					  
					  <label for="time">Location</label>
					  <div class="text"><?php echo "Stored in:".$_FILES["myfile"]["tmp_name"]; ?></div>
						
					</div>
				  </form>
			  </div>   
			</div> 
		  </div>
		  
		  <?php
		  // Inserts footer page IE link
		  include('footer.php'); // include footer section	
		  
	  } else {
		  echo "Error: " . $sql . "<br>" . $conn->error; // error display. fatal
	  }
		
		
  } // end code for table events exist
  
  //if event already exists, $count == 0 then execute code below
  else {
	
	//re-direct error page to create event and format html page  
	header( "refresh:10; url=create_event.php" );
	?>
	
	<div class="frame">
	<div class="logo">
	</div>
	
	<div class="content">
	  <img src="Images/Website/User accounts/error.png" alt="" name="error" width="445" id="error" />
	  
	  <div class="message">
		 <?php  
			echo "Error: Event Already Exists With The Same Name "."<br>";
		  ?>
	
	  </div>
	  
	  <div class="message2">
		  <p>Please Amend, Delete Or Type Another Event Name.</p>
		 If not re-directed <a href="create_event.php" class="hover">click here</a>
	  </div>
	  
	</div>
	
	</div>
	
	</body>
	</html>
	
	<?php
	  
	} //count if else event row end. IF ELSE END
  }// check table events exist end. IF ELSE END  
} // end post variable check. IF ELSE END

$conn->close(); // close db connection
?>

</body>
</html>