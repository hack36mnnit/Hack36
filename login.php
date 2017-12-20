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
<div class="top" style="overflow-x:hidden">
<link rel="stylesheet" type="text/css" href="css/form.css">
<section class="about-area" id="about" style="margin-top:5%;">
<div class="container" >

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3" style="border-width: 1px 1px 1px 1px; padding:1%">
			<form id="register" role="form" method="post" action="" autocomplete="off" name="myform" onsubmit="DoSubmit();">
				<center><img src="images/hack36footer.png" style="height:15%; width:35%; margin-top:15px"></img></center>
				
				<center>
				<h3 style="text-align:center ; color:#612d87">LOGIN TO HACK36</h3>
				<p><a href='./'>New? Register Here</a></p>
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
					<input type="email" name="email" id="email" class="form-control" style="width:60%" placeholder="Email" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<label class="control-label" for="password">Password<span class="text-danger">*</span></label>
					<input type="password" name="password" id="password" class="form-control" style="width:60%" placeholder="Password" tabindex="3">
				</div>
				
				<div class="row" style="margin-bottom:5px">
					
						 <a href='reset.php' class="small">Forgot your Password?</a>
					
				</div>
	
				<div class="row">
                              <center><div class="col-xs-12 col-md-12" style="margin-botton:5px;"><input type="submit" name="submit" value="Login" class="btn" style="background-color:#612d87;color:white;widht:15%;border-radius:0px;" tabindex="11"></div><center>
				</div>
			</center>
			</form>
		</div>
	</div>



</div>
</section>

<br><br>


<script>
   
   var func = function(){
      var h = $('#navigation').height();
      //console.log(h,nav);
      var margin = h + (screen.height*3/100) ;
      //console.log(margin);
      document.getElementById('about').style.marginTop = margin + "px" ;
   }

   $(document).ready(func);

   window.resize = func;

</script>
</div>
					

</div>
<?php 
	include('footer.php');
?>