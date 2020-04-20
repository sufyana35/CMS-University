<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Register attending</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link href="AJAX/list.css"rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="CSS/register_attendess_process.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="scripts/typeahead.min.js"></script>
<script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search_attending.php?key=%QUERY',
        limit : 10
    });
});
</script>


<script>
$(document).ready(function(){
$("#btn").click(function(){
var event_name = $(".event_name").val();
var typeahead = $(".typeahead").val();
if(event_name=='' && typeahead=='')
{
alert("Please fill out the form");
}

else{
$.post("AJAX/process_attendees.php", //Required URL of the page on server
{ // Data Sending With Request To Server
event_name:event_name,
typeahead:typeahead
},
function(response,status){ // Required Callback Function
alert("*----Received Data----*\n\nResponse : " + response+"\n\nStatus : " + status);//"response" receives - whatever written in echo of above PHP script.
$("#search")[0].reset();
});
}
});
});
</script>

<style type="text/css">
.typeahead, .tt-query, .tt-hint {
	border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 24px;
	height: 80px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 450px;
	color:#000;
}
.typeahead {
	background-color: #FFFFFF;
	color:#000;
}
.typeahead:focus {
	border: 2px solid #0097CF;
	color:#000;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
	color:#000;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
	color:#000;
}
.tt-suggestion {
	font-size: 24px;
	line-height: 24px;
	padding: 3px 20px;
	color:#000;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
	color:#000;
}

.ii {
	color:#FFF;
}
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<body>
<?php
include('db.php'); // db connection
include('header_2.php'); // include header section
include('function_login.php'); //include login functions
user_admin(); //check admin function

// gets values from form Events.php
$event_vacancy=$_POST['event_vacancy'];
$_SESSION["event_vacancy"] = $event_vacancy;

$event_name=$_POST['event_name'];

//removes spaces from variable
$event_name=preg_replace('/\s+/', '', $event_name);
$_SESSION["event_name"];

$_SESSION["username"];
$username = $_SESSION["username"];
$_SESSION["username"] = $username;

$image_url=$_POST['event_image'];
$_SESSION["image_url"] = $image_url;

$event_time=$_POST['event_time'];
$_SESSION["event_time"] = $event_time;

$event_date=$_POST['event_date'];
$_SESSION["event_date"] = $event_date;

$event_location=$_POST['event_location'];
$_SESSION["event_location"] = $event_location;

$reg_date=$_POST['reg_date'];
$_SESSION["reg_date"] = $reg_date;

$event_vacancy=$_POST['event_vacancy'];
$_SESSION["event_vacancy"] = $event_vacancy;
// end getting main values

//removes spaces	
$event_name=preg_replace('/\s+/', '', $event_name);

// Count functions --------------------------------------------------------------------------------------------------------//

// Function select table, count rows then do ----------------------------------------------------------------//
$sql="SELECT * FROM ".$event_name." WHERE (attending='N/A' AND waiting_list='false')";
$result2=mysqli_query($conn,$sql);
// Return the number of rows in result set
$attending_false=mysqli_num_rows($result2);

// Free result set
mysqli_free_result($result2);
//end count function for vacancy------------------------------------------------------------------------------//

// Function select table, count rows then do ----------------------------------------------------------------//
$sql="SELECT * FROM ".$event_name." WHERE (attending='true' AND waiting_list='false')";
$result3=mysqli_query($conn,$sql);
// Return the number of rows in result set
$attending_true=mysqli_num_rows($result3);

// Free result set
mysqli_free_result($result3);
//end count function for vacancy------------------------------------------------------------------------------//

// Function select table, count rows then do ----------------------------------------------------------------//
$sql="SELECT * FROM ".$event_name." WHERE (attending='N/A' AND waiting_list='true')";
$result4=mysqli_query($conn,$sql);
// Return the number of rows in result set
$waiting_list=mysqli_num_rows($result4);

// Free result set
mysqli_free_result($result4);
//end count function for vacancy------------------------------------------------------------------------------//

// Count functions ended---------------------------------------------------------------------------------------------------//
?>
<div class="image_register_process">
  <div class="search">
  <div class="box2">

  <h1>Register Users On List</h1>
  <hr>
    <p><?php echo "Total Vacancies:  $event_vacancy" ?></p>
  </div>
    <div class="search_inner">
      <div class="search_outer">
        <div class="bs-example">
          <form id="search" action="AJAX/process_attendees.php" method="post"> 
              <input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Search">
              <input type="hidden" name="event_name" id="event_name" class="event_name" readonly="readonly" hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
              <input type="button" id="btn" value="Register User"/>
              <div class="ii"><p>* Please allow 10 seconds for the page to load</p></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="portfolio_reg">

    <div class="portfoliobox2_reg">
      <div class="portfoliotext_reg">
        <p>Event Name</p>
      </div>
      <div class="portfoliotext_reg2">
        <p><?php echo $event_name?></p>
      </div>
    </div>
    
    <div class="portfoliobox2_reg">
      <div class="portfoliotext_reg">
        <p>Event Date</p>
      </div>
      <div class="portfoliotext_reg2">
        <p><?php echo $event_date?></p>
      </div>
    </div>
    
    <div class="portfoliobox2_reg">
      <div class="portfoliotext_reg">
        <p>Event Time</p>
      </div>
      <div class="portfoliotext_reg2">
        <p><?php echo $event_time?></p>
      </div>
    </div>
    
    <div class="portfoliobox2_reg">
      <div class="portfoliotext_reg">
        <p>Location</p>
      </div>
      <div class="portfoliotext_reg2">
        <p><?php echo $event_location?></p>
      </div>
    </div>
    
    <div class="portfoliobox2_reg">
      <div class="portfoliotext_reg">
        <p>Created</p>
      </div>
      <div class="portfoliotext_reg2">
        <p><?php echo $reg_date?></p>
      </div>
    </div>
    
    <div class="portfoliobox2_reg">
      <div class="portfoliotext_reg">
        <p>Not Attending</p>
      </div>
      <div class="portfoliotext_reg2">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
        libs/jquery/1.3.0/jquery.min.js"></script>
        <script type="text/javascript">
        var auto_refresh = setInterval(
        function ()
        {
        $('#load_tweets').load('AJAX/attending_false.php?q=<?php echo $event_name; ?>').fadeIn("slow");
        }, 10000); // refresh every 10000 milliseconds
        </script>
        <div id="load_tweets"> </div>
        </script>
        
      </div>
    </div>
    
    <div class="portfoliobox2_reg">
      <div class="portfoliotext_reg">
        <p>Attending</p>
      </div>
      <div class="portfoliotext_reg2">
     	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
        libs/jquery/1.3.0/jquery.min.js"></script>
        <script type="text/javascript">
        var auto_refresh = setInterval(
        function ()
        {
        $('#load_tweets2').load('AJAX/attending_true.php?q=<?php echo $event_name; ?>').fadeIn("slow");
        }, 10000); // refresh every 10000 milliseconds
        </script>
        <div id="load_tweets2"> </div>
        </script>
      </div>
    </div>
    
    <div class="portfoliobox2_reg">
      <div class="portfoliotext_reg">
        <p>Waiting List</p>
      </div>
      <div class="portfoliotext_reg2">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/
        libs/jquery/1.3.0/jquery.min.js"></script>
        <script type="text/javascript">
        var auto_refresh = setInterval(
        function ()
        {
        $('#load_tweets3').load('AJAX/waiting_list.php?q=<?php echo $event_name; ?>').fadeIn("slow");
        }, 10000); // refresh every 10000 milliseconds
        </script>
        <div id="load_tweets3"> </div>
        </script>
      </div>
    </div>
    
  </div>
  
  <div class="content">
    <div class="content_inner">
      <div class="content_text">
        <p>Not Attending<p>
      </div>
      
      <div class="wrap">
	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/
      libs/jquery/1.3.0/jquery.min.js"></script>
      <script type="text/javascript">
      var auto_refresh = setInterval(
      function ()
      {
      $('#attending_false').load('AJAX/attending_false_attendees.php?q=<?php echo $event_name; ?>').fadeIn("slow");
      }, 10000); // refresh every 10000 milliseconds
      </script>
      <div id="attending_false"> </div>
      </script>
      </div>
      
    </div>
    
    <div class="content_inner">
      <div class="content_text">
        <p>Attending<p>
      </div>
      
      <div class="wrap">
	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/
      libs/jquery/1.3.0/jquery.min.js"></script>
      <script type="text/javascript">
      var auto_refresh = setInterval(
      function ()
      {
      $('#attending_true').load('AJAX/attending_true_attendees.php?q=<?php echo $event_name; ?>').fadeIn("slow");
      }, 10000); // refresh every 10000 milliseconds
      </script>
      <div id="attending_true"> </div>
      </script>
      </div>
      
    </div>
    
    <div class="content_inner">
      <div class="content_text">
        <p>Waiting List<p>
      </div>
      
      <div class="wrap">
	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/
      libs/jquery/1.3.0/jquery.min.js"></script>
      <script type="text/javascript">
      var auto_refresh = setInterval(
      function ()
      {
      $('#load_waiting_list_reg').load('AJAX/waiting_list_attendees.php?q=<?php echo $event_name; ?>').fadeIn("slow");
      }, 10000); // refresh every 10000 milliseconds
      </script>
      <div id="load_waiting_list_reg"> </div>
      </script>
      </div>
      
    </div>
    
  </div>
  
</div>

<?php include('footer.php'); // include footer section ?>



</body>
</html>