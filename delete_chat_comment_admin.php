<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post comment</title>
</head>

<body>
<?php
include('db.php'); //db connection
include('header.php'); //include header function
include('function_login.php'); //login functions
user_admin(); // check admin logged in
include('functions.php'); //include functions

//get variables
$username_post = $_SESSION["username"];
$_SESSION["username"];

$event_name_post = $_POST["event_name"];
$_SESSION["event_name"] = $event_name_post;

$uid = $_POST["uid"];
$_SESSION["uid"] = $uid;


// sql to delete a record
$sql = "DELETE FROM comments WHERE id='$uid'";

if ($conn->query($sql) === TRUE) {

	error_style(); //include style
	?>
	<div class="error">
      <p>Post Comment Deleted</p>
    </div>
    <?php
	header("location:edit_comments_admin.php");

} else {
	
	error_style(); //include style
	?>
	<style type="text/css">
	<div class="error">
      <p>Error Deleting Record Post</p>
    </div>
    <?php
    echo "  " . $conn->error;
	
}

?>

<?php include('footer.php'); ?>
</body>
</html>