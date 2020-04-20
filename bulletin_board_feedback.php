<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Chat Room</title>
<link href="CSS/bulletin_board_feedback.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
include('db.php'); //include db connection
include('header.php'); // include header function page
include('function_login.php'); //login functions
user_login(); // check is user is logged in
include('functions.php'); //functions

//session, getting variables, check function
if(!empty($_REQUEST['event_name'])) {
 
  $event_name=$_REQUEST['event_name'];
  $_SESSION["event_name2"] =$event_name;
   
} else {
	 $event_name = $_SESSION["event_name2"];
}

//get username
$_SESSION["username"];
$username_post = $_SESSION["username"];

?>

<div class="search">
    <div class="box2">
  
    <h1>Chat Room Interaction</h1>
    <hr>
      <h2>Event Name: <?php echo "$event_name" ?></h2>
    </div>
  
  
    <!--START: Insert message-->
    <div class="box_comment">
      <div class="search_inner">
        <div class="search_outer">
          <div class="bs-example">
            <form id="chat_room" action="process_chat_room.php" method="post"> 
                <input type="text" class="text_comment" id="text_comment" name="text_comment" placeholder="Type Your Comment">
                <input type="hidden" name="event_name" id="event_name" class="event_name" readonly="readonly" hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
                <input type="hidden" name="username_post" id="username_post" class="username_post" readonly="readonly" hidden="" value="<?php echo $username_post ?>" placeholder="<?php echo $username_post ?>"  required/>
                    <input type="hidden" name="url" id="url" class="url" readonly="url" hidden="" value="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>" placeholder="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>"  required/>
                <button type="submit" id="btn">Post Comment</button>
            </form>
          </div>
        </div>
      </div>
      </div>
    
    </div>
  
  <!--ENDED: End message-->
  
  <!-- PHP Comment loop function-->
  
  <div class="message_wrap">
  
  <?php
    //loop comments --------------------------------------------------------------------------------------------//
  $query_comment = "SELECT * FROM comments WHERE (event_name='$event_name') ORDER BY id DESC";
       
  $result_comment = mysql_query($query_comment) or die(mysql_error());
  
  //select data from comments and loop comments -------------------------------------------//
  while($comments = mysql_fetch_array($result_comment)){
     
	 $id = $comments['id'];
     $user_name_comment = $comments['user_name_comment'];
     $event_name = $comments['event_name'];
	 $comments = $comments['comments'];   
  ?>
  
  <!-- PHP Comment loop function-->
  
  <div class="wrap_inner">
  <div class="message_outer">
    <div class="message">
      <div class="message_details">
        <div class="spaced">
		  <?php echo "User: ", $user_name_comment; ?>
        </div>
		<?php
		
		//if username admin then run code, global delete for all users
		if ($username_post =="admin") {
			?> <div class="spaced">
            <?php $_SESSION["uid"] = $id; ?>
                  <form action="delete_chat_comment.php" method="post" name="delete comment">
                    <input type="hidden" name="event_name" id="event_name" class="event_name" readonly="readonly" hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
                    <input type="hidden" name="uid" id="uid" class="uid" readonly="readonly" hidden="" value="<?php echo $id ?>" placeholder="<?php echo $id ?>"  required/>
                    <button type="submit" id="btn2" onclick="return confirm('Are you sure?')">Delete Comment</button>
            </form>   
               </div> <?php 
			   
		  //if admin not logged in then run this code, user allowed to delete own comment
		} else {
			if ($user_name_comment == $username_post) {
			  ?> <div class="spaced">
              <?php $_SESSION["uid"] = $id; ?>
					<form action="delete_chat_comment.php" method="post" name="delete comment">
					  <input type="hidden" name="event_name" id="event_name" class="event_name" readonly="readonly" hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
					  <input type="hidden" name="uid" id="uid" class="uid" readonly="readonly" hidden="" value="<?php echo $id ?>" placeholder="<?php echo $id ?>"  required/>
					  <button type="submit" id="btn2" onclick="return confirm('Are you sure?')">Delete Comment</button>
			  </form>
			  
				 </div> <?php 
		  } else {
			  //do nothing
		  }
		}// admin function end
		

		?>
        <div class="spaced_right">
		  <?php echo "Post: ",$id; ?>
        </div>
      </div>
      
	  <?php
	  //if admin true then run if code
      if($username_post == "admin") {
              
         ?>
          <form action="table_edit_ajax.php" method="post" name="update comment">
            <input type="hidden" readonly hidden="" name="event_name" id="event_name" class="event_name" readonly  value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
            <input type="hidden" name="id" id="id" class="id" readonly hidden="" value="<?php echo $id ?>" placeholder="<?php echo $id ?>"  required/>
            <input type="text" name="lastname" id="lastname" class="text_comment" placeholder="<?php echo $comments ?>" value="<?php echo $comments ?>"  required/>
            <input type="hidden" name="firstname" id="firstname" placeholder="<?php echo $username_post ?>" value="<?php echo $username_post ?>" class="text" required/>
            <input type="hidden" name="url" id="url" class="url" readonly="url" hidden="" value="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>" placeholder="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>"  required/>
          <button type="submit" id="comment" onclick="return confirm('Are you sure?')">Update Comment</button>
        </form>
      <?php
      
	     //if admin not logged in then run else code
       } else {
        
		    //if user logged in and not equal admin then run if code ($user_name_comment == $username_post)
			if (($user_name_comment == $username_post) 
			&& ($username_post != "admin")) { 
			
			   ?>
				<form action="table_edit_ajax.php" method="post" name="update comment">
				  <input type="hidden" readonly hidden="" name="event_name" id="event_name" class="event_name" readonly  value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
				  <input type="hidden" name="id" id="id" class="id" readonly hidden="" value="<?php echo $id ?>" placeholder="<?php echo $id ?>"  required/>
				  <input type="lastname" name="lastname" id="lastname" class="text_comment" placeholder="<?php echo $comments ?>" value="<?php echo $comments ?>"  required/>
				  <input type="hidden" name="firstname" id="firstname" placeholder="<?php echo $username_post ?>" value="<?php echo $username_post ?>" class="text" required/>
				  <input type="hidden" name="url" id="url" class="url" readonly="url" hidden="" value="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>" placeholder="<?php echo 'bulletin_board_feedback.php?event_name='.$event_name.'' ?>"  required/>
				<button type="submit" id="comment" onclick="return confirm('Are you sure?')">Update Comment</button>
			  </form>
			 <?php
			
			//if admin not logged in & user comments not own then run this code 
		  } else {
			   echo "<div class='text_comment'><p>".$comments."</p></div>";
			   
		  } // global display comment end
	  }//if admin true/false logged code end
	  ?>
      

      </div>
    </div>
  </div>
  

<?php
} // ends loop for registrant details from database ---------------------------------------------------//
//loop waiting list for $event ended---------------------------------------------------------------------------------------//
?>
  </div> 
  
  <div class="content">
    <div class="content_inner">
      <div class="content_text">
        <p>Attending</p>
      </div>

<?php
lists(); // include user detail event
?>

  </div>
  
</div>

<?php include('footer.php'); ?>
</body>
</html>
