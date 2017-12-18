<?php
error_reporting(0); 
require('includes/config.php');

//logout
$user->logout(); 

//logged in return to index page
header('Location: login.php');
exit;
?>