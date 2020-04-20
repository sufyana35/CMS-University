<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrant Details</title>
<link href="CSS/registrant_details.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php 
include('db.php'); // include db connection
include('header.php'); // include header section
include('function_login.php'); //include login functions
user_admin(); //check admin function

//select table
$query = "SELECT * FROM users";	 
$result = mysql_query($query) or die(mysql_error());
?>
<div class="registrant_outer">
  <div class="title2">
    <p>User Details</p>
  </div>
  <div class="label_box">
  
    <div class="label_text">User ID
    </div>
    
    <div class="label_text">Firstname
    </div>
    
    <div class="label_text">Surname
    </div>
    
    <div class="label_text_email">Email
    </div>
    
    <div class="label_text">Gender
    </div>
    
    <div class="label_text">DOB
    </div>
    
  </div>
  <?php
  
  // Print out the contents of each row from users into a table
  while($row = mysql_fetch_array($result)){
      
      $userID = $row['userID'];
      $firstname = $row['firstname'];
      $surname = $row['surname'];
      $email = $row['email'];
      $gender = $row['gender'];
      $DOB = $row['DOB'];
      
      ?>
  
      <div class="registrant_details">
    
        <div class="registrant_column"><?php echo $userID; ?></div>
       
        <div class="registrant_column"><?php echo $firstname; ?></div>
        
        <div class="registrant_column"><?php echo $surname; ?></div>
        
        <div class="registrant_column_email"><?php echo $email; ?></div>
        
        <div class="registrant_column"><?php echo $gender; ?></div>
        
        <div class="registrant_column"><?php echo $DOB; ?></div>
        
      </div>
      
  
  <?php
  } // ends loop for registrant details from database 
  ?>
  </div>
</div>

<?php include('footer.php'); // include footer section ?>


</body>
</html>