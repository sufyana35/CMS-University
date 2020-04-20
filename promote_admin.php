<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Promote Admin</title>
</head>

<body>
<?php
include('db.php'); // db connection
include('header.php'); // include header section
include('function_login.php'); //include login functions
user_admin(); //check admin function
include('functions.php'); //include functions

if (!(isset($_POST['text_comment']) && ($_POST['text_comment']) )) {
	
  error_style(); //include style
  ?>	
  <div class="error">
	<p>Error: Please type a valid comment in.</p>
  </div>
  <?php
  include('footer.php'); // include footer section
}

else {

  //post variables from form
  $text_comment=$_POST['text_comment'];
  $_SESSION["text_comment"] = $text_comment;
  
  // sql to create table promote
  $sql = "CREATE TABLE promote (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  promote VARCHAR(2500) NOT NULL,
  reg_date TIMESTAMP
  )";
  
  if ($conn->query($sql) === TRUE) {
		// echo created successfully"; 	 	 
  }
  
  else
  {
		// echo "Table not created successfully";
  }
  
  $sql = "INSERT INTO promote (promote)
	  VALUES ('$text_comment')";
	  
	  if ($conn->query($sql) === TRUE) {
		  
		  header("location:promote.php");
		  
	  } else {
		  
		  error_style(); //include style
		  ?>
		  <div class="error">
			<p>Unknown error: could not insert promote. Try to type text without pasting, or adding any additional material</p>
		  </div>
		  <?php
		  
	  }
  
  include('footer.php'); //include footer section
  }
?>

</body>
</html>