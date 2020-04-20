<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post comment</title>
</head>

<body>
<?php
include('db.php');
include('header.php');
include('function_login.php'); //login functions
user_login(); // check user log in
include('functions.php'); //include functions
$event_name=$_POST['event_name'];
$url = $_POST['url'];

$username_post = $_SESSION["username"];
$_SESSION["username"];

$text_comment=$_POST['text_comment'];
$_SESSION["text_comment"] = $text_comment;

$text_comment = stripslashes($text_comment);
$text_comment = mysql_real_escape_string($text_comment);
$text_comment = strip_tags($text_comment);

$sql = "INSERT INTO comments (user_name_comment, event_name, comments)
	VALUES ('$username_post', '$event_name', '$text_comment')";
	
	if ($conn->query($sql) === TRUE) {
		$_SESSION['event_name2']=$event_name;
		header("location:bulletin_board_feedback.php?event_name=".$event_name."");
		
		
	} else {
		error_style(); //include style
		?>
		<div class="error">
		  <p>Unknown error: could not insert comment. Try to type comment without pasting, or adding any additional material</p>
		</div>
		<?php
		
	}

?>
<?php include('footer.php'); //include footer ?>
</body>
</html>