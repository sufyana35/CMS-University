<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Comment</title>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');

$("#last_"+ID).hide();

$("#last_input_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var first=$("#first_input_"+ID).val();
var last=$("#last_input_"+ID).val();
var dataString = 'id='+ ID +'&firstname='+first+'&lastname='+last;
$("#first_"+ID).html('<img src="load.gif" />'); // Loading image

if(first.length>0&& last.length>0)
{

$.ajax({
type: "POST",
url: "table_edit_ajax.php",
data: dataString,
cache: false,
success: function(html)
{
$("#first_"+ID).html(first);
$("#last_"+ID).html(last);
}
});
}
else
{
alert('Enter something.');
}

});

// Edit input box click action
$(".editbox").mouseup(function() 
{
return false
});

// Outside click action
$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});
</script>

<script>
var TRange=null;

function findString (str) {
 if (parseInt(navigator.appVersion)<4) return;
 var strFound;
 if (window.find) {

  // CODE FOR BROWSERS THAT SUPPORT window.find

  strFound=self.find(str);
  if (!strFound) {
   strFound=self.find(str,0,1);
   while (self.find(str,0,1)) continue;
  }
 }
 else if (navigator.appName.indexOf("Microsoft")!=-1) {

  // EXPLORER-SPECIFIC CODE

  if (TRange!=null) {
   TRange.collapse(false);
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
  if (TRange==null || strFound==0) {
   TRange=self.document.body.createTextRange();
   strFound=TRange.findText(str);
   if (strFound) TRange.select();
  }
 }
 else if (navigator.appName=="Opera") {
  alert ("Opera browsers not supported, sorry...")
  return;
 }
 if (!strFound) alert ("String '"+str+"' not found!")
 return;
}
</script>

<link href="CSS/delete_event_admin.css" rel="stylesheet" type="text/css" />
</head>
<?php
include('db.php'); //db connection

//Custom connect SQL below

include('header.php'); // include header function
include('function_login.php'); //login functions
user_admin(); // check admin logged in
?>
<body>
<div class="outer2">
<div class="search">
      <div class="box2">
    
      <h1>Chat Room Interaction</h1>
      <hr>
        <h2>Global Comments</h2>
      </div>
    </div>
    
    <!--START: Insert message-->
    <div class="box_comment">
      <div class="search_inner">
        <div class="search_outer">
          <div class="bs-example">
            <form id="f1" name="f1" action="javascript:void()" onsubmit="if(this.t1.value!=null &amp;&amp; this.t1.value!='')
            parent.findString(this.t1.value);return false;">
            <input type="text" id="t1" name="t1" class="text_comment" value="Find Comment" size="20">
            <input type="submit" name="b1" value="Find" id="btn">
            </form>
          </div>
        </div>
      </div>
        <div class="brief">
           <p>*To Edit Feedback Comments Select An Event From The Events Page Then Click Leave Feedback. This Will Show User Comments</p>
        </div>
      </div>
</div>


<div class="outer">
<div class="box3">
    
  <h1>Chat Room Interaction</h1>
  <hr>
    <h2>Bulletin Board Comments</h2>
  </div>
<table>
<?php

//select table
$sql=mysql_query("select * from comments ORDER BY id DESC");
//loop data
while($row=mysql_fetch_array($sql))
{
$id=$row['id'];
$firstname=$row['user_name_comment'];
$lastname=$row['comments'];
$event_name_=$row['event_name'];
?>
  <div id="<?php echo $id; ?>" class="edit_tr">
  
  
    <div class="message_wrap">
      <div class="wrap_inner">
      <div class="message_outer">
        <div class="message">
          <div class="message_details">
            <div class="spaced">
              
              <div class="edit_td">
              <span id="first_<?php echo $id; ?>" class="text"><?php echo $firstname; ?></span>
              <input type="text" value="<?php echo $firstname; ?>" class="editbox" id="first_input_<?php echo $id; ?>" />
              </div>
              
            </div>
            
            <div class="spaced_right">
              <?php echo "Post: ",$id; ?>
            </div>
            
            <div class="spaced">
              <?php $_SESSION["uid"] = $id; ?>
					<form action="delete_chat_comment_admin.php" method="post" name="delete comment">
					  <input type="hidden" name="event_name" id="event_name" class="event_name" readonly="readonly" hidden="" value="<?php echo $event_name ?>" placeholder="<?php echo $event_name ?>"  required/>
					  <input type="hidden" name="uid" id="uid" class="uid" readonly="readonly" hidden="" value="<?php echo $id ?>" placeholder="<?php echo $id ?>"  required/>
					  <button type="submit" id="btn2" onclick="return confirm('Are you sure?')">Delete Comment</button>
			  </form>
			  
            </div>
            
            <div class="spaced_right">
              <?php echo "Event: ",$event_name_; ?>
            </div>
          </div>
           <div class="edit_td">
          <span id="last_<?php echo $id; ?>" class="text"><?php echo $lastname; ?></span> 
          <input type="text" value="<?php echo $lastname; ?>" class="editbox" id="last_input_<?php echo $id; ?>"/>
          </div>
        </div>
      </div>
      </div>
    </div>

  </div>
<?php
} //loop data end 
?>
</table>
</div>

<?php
include('footer.php'); // include footer
?>

</body>
</html>