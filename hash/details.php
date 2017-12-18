<?php require_once 'config.php';?>
<!DOCTYPE html> 
<html>
<head>
	<title>Encrypt and Decrypt String/text/ids for URL Using PHP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css" >	
	<meta name="description" content="How do you Encrypt and Decrypt a PHP String/text, Simple PHP encrypt and decrypt,Basic encryption and decryption of a string, PHP encrypt and decrypt with certificate, encrypt and decrypt in php with key, php encrypt decrypt with salt, Encrypting and decrypting parameter for URL, Encrypt & decrypt in PHP URL safe ids, How to protect sensitive data in URL's">
	<meta name="keywords" content="How do you Encrypt and Decrypt a PHP String/text, Simple PHP encrypt and decrypt,Basic encryption and decryption of a string, PHP encrypt and decrypt with certificate, encrypt and decrypt in php with key, php encrypt decrypt with salt, Encrypting and decrypting parameter for URL, Encrypt & decrypt in PHP URL safe ids, How to protect sensitive data in URL's">
</head>

<?php 
$infos = array(0=>[1, 'Muni', 'PHP Developer'], 1 => [2, 'Jagan', 'Senior Devloper'],
 2 => [3, 'Lingesh', 'Mainframe Devloper'], 3 => [4, 'Udhai', 'Admin'], 4 => [5, 'Sasi', 'Enterprener'] );
?>
<body>
	<div class="container">
		<h1>Encrypt and Decrypt String/text/ids for URL Using PHP</h1>
		<?php 
			if( isset($_GET['id']) && !empty( $_GET['id'] ) ){
				$id = urldecode($_GET['id']);
				echo $id;
				echo "<br>";
				$id = encryptor('decrypt', $id);
				echo $id;
				if( !empty( $id ) && is_numeric( $id ) ){
					$info = $infos[$id-1];
				}
			}
		?>
		<div class="details">
			<h3>His/Her Details are</h3>
			<p> Name : <?php echo $info[1]; ?> </p>
			<p> Designation: <?php echo $info[2]; ?> </p>
		</div>
		
		<a class="back_btn" href="<?php echo BASE_PATH;?>">Back....</a>
	</div>
</body>
</html>