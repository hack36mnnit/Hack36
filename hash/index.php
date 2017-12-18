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
		<table>
			<tr>
				<th>S.No</th>
				<th>Name</th>
				<th>Designation</th>
				<th>Action</th>
			</tr>
			<?php if( !empty($infos)) { ?>
				<?php foreach ( $infos as $info) { ?>
					<tr>
						<td> <?php echo $info[0]; ?> </td>
						<td> <?php echo $info[1]; ?> </td>
						<td> <?php echo $info[2]; ?> </td>
						<?php $id = urlencode(encryptor('encrypt', $info[0])); ?>
						<td> <a href="<?php echo BASE_PATH.'details.php?id='.$id; ?>"> Click here to know more.. </a> </td>
					</tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>
</body>
</html>