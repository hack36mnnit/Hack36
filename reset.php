<?php 
error_reporting(0);
require('includes/config.php');



//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(empty($row['email'])){
			$error[] = 'Email provided is not on recognised.';
		}

	}

	//if no errors have been created carry on
	if(!isset($error)){

		//create the activasion code
		$token = md5(uniqid(rand(),true));

		try {

			$stmt = $db->prepare("UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email");
			$stmt->execute(array(
				':email' => $row['email'],
				':token' => $token
			));

			//send email
			$reset_link = "".DIR."resetPassword.php?key=$token";
			$name = 'participant';
			$to = $row['email'];
			$subject = "Password Reset";
			$body ='
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Reset your password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <style>
      @media(max-width:600px){
          .content{
          width:100%;
      }
      }
  
  </style>
</head>
<body style="margin: 0; padding: 0;font-family: "Open Sans", sans-serif;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <table class="content" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
 <tr>
  <td align="center" bgcolor="#c8e0f4" style="padding: 15px 0 15px 0;">

 <img src="./images/HACK36ill2-min.png" alt="Hack 36 title logo" width="350" style="display: block;" />
 <p style="text-align: center;padding: 0;margin: 0;">27-28 January, 2018</p>
</td>
 </tr>
 <tr>
  <td bgcolor="#ededed" style="padding:10px 30px 40px 30px;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size:16px;border-collapse:collapse">
  <tr>
   <td>
    Dear participant,
   </td>
  </tr>
  <tr>
   <td style="padding: 20px 0 30px 0;">
    Someone requested that the password be reset.
	If this was a mistake, just ignore this email and nothing will happen.
To reset your password, click the below link:
   </td>
  </tr>
    <tr>
   <td align="center" style="padding: 10px 0 0 0;">
       <a href='.$reset_link.' style="text-decoration:none;padding:10px 20px;background-color:#4b9e60;color:white;border-radius:5px">Click here to reset your password</a>
   </td>
  </tr>
 </table>
</td>
 </tr>
 <tr>
  <td bgcolor="#ededed">
  <p style="text-align: center;">For official updates follow us on:</p>
   <table align="center">
       <tr>
           <td align="center">
               <a href="https://www.facebook.com/mnnitecell" target="_blank" title="our Facebook page"><img src="./images/facebook.png" alt=""></a>
           </td>
           
       </tr>
   </table>
  </td>
 </tr>
 <tr bgcolor="#ededed">
     <td align="center" style="padding: 10px 0 10px 0;">
         Please ignore if this email is not related to you!<br>
         NOTE: In case of any queries please contact our team immediately at <a href="mailto:hackathon@mnnit.ac.in" style="text-decoration:none;color:teal">hackathon@mnnit.ac.in</a>
     </td>
 </tr>
 <tr bgcolor="#c8e0f4">
   <td style="padding: 20px 0 10px 20px;">
    Regards<br>Team
     <a href="http://www.hack36.com" target="_blank" style="text-decoration:none;color:teal"> Hack 36 MNNIT</a><br>
    MNNIT Allahabad, 211004, UP, India<br>
    <a href="http://www.hack36.com" target="_blank" style="text-decoration:none;color:teal">www.hack36.com</a>
   </td>
  </tr>
</table>
 </table>
</body>
</html>
			';
			$altbody = 'Click this link to reset your password.';
			/*$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();*/
			include("send-mail.php"); 
			//redirect to index page
			header('Location: login.php?action=reset');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//define page title
$title = 'Reset Account';
	include('header.php');
//include header template
//require('layout/header.php');
?>
<link rel="stylesheet" type="text/css" href="css/form.css">

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form id="register" role="form" method="post" action="" autocomplete="off" name="myform" onsubmit="DoSubmit();">
				<h2>Reset Password</h2>
				<p><a href='login.php'>Back to login page</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
					}
				}
				?>

				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="" tabindex="1">
				</div>

				<hr>
				<div class="row">
					<div class="col-xs-12 col-md-12"><input type="submit" name="submit" value="Sent Reset Link" class="btn btn-success btn-block btn-lg" tabindex="2"></div>

				</div>
			</form>
		</div>
	</div>


</div>
<style>
	#space{
		width:100%;
		height:50vh;

	}
</style>
<div id="space"></div

<?php
//include header template
//require('layout/footer.php');
	include('footer.php');
?>

