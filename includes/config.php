<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Asia/Calcutta');

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','hack36');

//application address
define('DIR','http://register.hack36.com/');
define('SITEEMAIL','noreplyhack36@gmail.com');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
/*include('classes/phpmailer/mail.php');*/
$user = new User($db);
?>
