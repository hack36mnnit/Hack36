<!DOCTYPE html>
<html lang="en">
<head>
  <title>All info</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
            body, html
            {
                margin: 0; padding: 0; height: 100%; overflow: hidden;
            }

            #content
            {
                position:absolute; left: 0; right: 0; bottom: 0; top: 0px; 
            }
        </style>
        		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Header Script
		=============================================================== -->
			
		<!-- Modernizr JS -->
		<script src="js/jquery.js"></script>

			<script type="text/javascript">

document.addEventListener('contextmenu',function(e){
  e.preventDefault();
});
document.onkeydown = function(e) {
if(event.keyCode == 123) {
return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)){
return false;
}
}
    </script>
</head>
<body>

<div class="container">
<?php

error_reporting(0);
$user = $_POST['user'];
$pass = $_POST['pass'];

if($user == "root"
&& $pass == "renaissance@2k17")
{
	?>
	<div id="content">
 <iframe frameborder="0" src="choosedatatypeadmin.php" width="100%" height="100%" />
 </div>
 <?php
       // include("choosedatatypeadmin.php");
}
else
{
    if(isset($_POST))
    { ?>
	<center>
	<h2>Only private login allowed</h2>
            <form method="POST" action="" style="margin-top: 50px; padding: 10px;">
            Username <input type="text" name="user" autocomplete="off"></input><br>
            <br>
            Password <input type="password" name="pass" autocomplete="off"></input><br><br>
            <input type="submit" name="submit" value="Submit"></input>
            </form>
            </center>
    <?php }
}
?>
</div>

</body>
</html>