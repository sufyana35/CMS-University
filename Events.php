<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Events</title>
<link href="CSS/Events.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php 
//include db & header connection
include('header.php'); // includer header section
include('functions.php'); //include login functions

//display the available events
display_event(); // event section

include('footer.php'); // include footer setion ?>

</body>
</html>