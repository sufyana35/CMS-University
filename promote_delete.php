<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Promo</title>
</head>

<body>
<?php
include('db.php'); //db connection
include('header.php'); // include header section
include('function_login.php'); //include login functions
user_admin(); //check admin function
include('functions.php'); //include functions

$id = $_POST["id"];


// sql to delete a record
$sql = "DELETE FROM promote WHERE id='$id'";

if ($conn->query($sql) === TRUE) {

	error_style(); //include style
	?>
	<div class="error">
      <p>Post Promote Deleted</p>
    </div>
    <?php
	header("location:promote.php");

} else {
	
	error_style(); //include style
	?>
	<div class="error">
      <p>Error Deleting Promote Post</p>
    </div>
    <?php
    echo "  " . $conn->error;
	
}

?>

<?php include('footer.php'); //include footer section ?>
</body>
</html>