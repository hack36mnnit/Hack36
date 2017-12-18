<?php
header('X-Frame-Options: SAMEORIGIN');
header("X-XSS-Protection: 1; mode=block");
header('X-Content-Type-Options: nosniff');
error_reporting(0);
//include config
require_once('includes/config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	$email = $_POST['email'];
	$password = $_POST['password'];
	
	if($user->login($email,$password)){ 
		$_SESSION['email'] = $email;
		header('Location: memberpage.php');
		exit;
	
	} else {
		$data = $user->check_user_verification($_POST['email']);
		$reg_status = $data['reg_status'];
		if( $reg_status == "active" ){ 

			$error[] = 'Wrong email and password combination.';
		 } else if( $reg_status == "inactive"){
		 	$error[] = 'Your account has not been activated. Check your email for activation link.';
		
	}else if( $reg_status == "doesnotexist"){
		 	$error[] = 'Wrong email and password combination.';
		
	}
	else
	{
		$error[] = 'Wrong email and password combination.';
	}
	}

}//end if submit

//define page title
$title = 'Login Page';

//include header template
//require('layout/header.php'); 
include('header.php');
?>

<link rel="stylesheet" type="text/css" href="css/form.css">
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form id="register" role="form" method="post" action="" autocomplete="off" name="myform" onsubmit="DoSubmit();">
				<h2 style="text-align:center">Login to Hack 36 MNNIT</h2>
				<p><a href='./'>Back to home page</a></p>
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
						case 'resetAccount':
							echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
							break;
					}

				}

				
				?>

				<div class="form-group">
					<label class="control-label" for="email">Email<span class="text-danger">*</span></label>
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="User Email" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<label class="control-label" for="password">Password<span class="text-danger">*</span></label>
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				</div>
				
				<div class="row" style="margin-bottom:5px">
					<div class="col-xs-9 col-sm-9 col-md-9">
						 <a href='reset.php' class="small">Forgot your Password?</a>
					</div>
				</div>
	
				<div class="row">
					<div class="col-xs-12 col-md-12"><input type="submit" name="submit" value="Login" class="btn btn-success btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>



</div>


<br><br>
</div>
					


<?php 
	include('footer.php');
?>