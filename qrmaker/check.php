<?php

require('../includes/config.php'); 

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: ../login.php'); } 
		$msg = $_GET['msg'];
		$id = $_GET['id'];


		$comm = "python qrmaker/generate.py qrmaker/logo.svg \"".$msg."\" qrcodes/".$id.".svg 2>&1";

		//$comm = "node ../node/converter.js kishanjii $url 2>&1";

		$output = shell_exec($comm);

		print_r($comm);
		print_r($output);
		//echo "<img src=\"qrcodes/$id.svg\" />";

?>