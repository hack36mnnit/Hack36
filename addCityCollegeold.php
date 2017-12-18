<?php //require('includes/config.php');
 error_reporting(0);
	

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	/*if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}

	}*/
	if(strlen($_POST['fullname']) < 3){
		$error[] = 'Name is too short.';
	}
	
	if(strlen($_POST['city']) <3){
		$error[] = 'City is too short.';
	}
	if(strlen($_POST['college']) < 3 ){
		$error[] = 'College is too short.';
	}
	if(strlen($_POST['collegedescp']) < 3 ){
		$error[] = 'College description is too short.';
	}
	if(strlen($_POST['mobile']) < 10){
		$error[] = 'Mobile number is incorrect.';
	}
	
	

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	}

	//if no errors have been created carry on
	if(!isset($error)){

		
		try {
			
			
			$name = $_POST['fullname'];
			$city = $_POST['city'];
			$college = $_POST['college'];
			$collegedescp = $_POST['collegedescp'];
			$mobile = $_POST['mobile'];
			$email = $_POST['email'];
			//send email
			$to = "renaissance@mnnit.ac.in";
			$subject = "Adding request for college and city details | Renaissance 2017";
			$body = '<p>To verify and add these details in database.</p>
			<p>User requested details.</p>
			<p>User Name: '.$name.'</p>
			<p>Requested City: '.$city.'</p>
			<p>Requested College: '.$college.'</p>
			<p>College description: '.$collegedescp.'</p>
			<p>User mobile: '.$mobile.'</p>
			<p>User email: '.$email.'</p>

			<p>Regards Site User</p>';
			$altbody = 'Request for adding college and city details.';
			/*$mail = new Mail();
			$mail->setFrom('renaissance@mnnit.ac.in', 'Registration Successfull Renaissance 2016');
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();*/

			include("send-mail.php"); 
			//mail script ends here...
			
			//redirect to index page
			header('Location: addCityCollege.php?action=added');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//define page title
$title = 'Add college details';
include('header.php');
//include header template
//require('layout/header.php');
?>

<head>
	<link rel="stylesheet" type="text/css" href="css/form.css">
</head>
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form id="register" role="form" method="post" action="" autocomplete="off" name="myform" onsubmit="DoSubmit();">
				<h2>Please provide your details here.</h2>
				<p>Go to registration? <a href='./'>Register</a></p>
				
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'added'){
					echo "<h2 class='bg-success'>Thanks for your help! We will review and add these ASAP</h2>";
				}
				?>

				<!-- <div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div> -->
				<div class="form-group">
					<label class="control-label" for="fullname">Full Name<span class="text-danger">*</span></label>
					<input type="text" name="fullname" id="fullname" class="form-control input-lg" placeholder="Full Name" value="<?php if(isset($error)){ echo $_POST['fullname']; } ?>" tabindex="1">
				</div>
				

		        <div class="form-group">
		          <label class="control-label">City<span class="text-danger">*</span></label>
		          <br>
		          <input type="text" name="city" id="city" class="form-control input-lg" placeholder="City name" value="<?php if(isset($error)){ echo $_POST['city']; } ?>" tabindex="2">
		          
		     
		        </div>

		        <div class="form-group">
		          <label class="control-label">College<span class="text-danger">*</span></label>
		          <br>
		          <input type="text" name="college" id="college" class="form-control input-lg" placeholder="College Name" value="<?php if(isset($error)){ echo $_POST['college']; } ?>" tabindex="3">
		         
		          
		        </div>
		        <div class="form-group">
		          <label class="control-label">College Desciption or URL<span class="text-danger">*</span></label>
		          <br>
		          <input type="text" name="collegedescp" id="collegedescp" class="form-control input-lg" placeholder="College url and description" value="<?php if(isset($error)){ echo $_POST['collegedescp']; } ?>" tabindex="4">
		         
		          
		        </div>
		        <div class="form-group">
		          <label class="control-label" for="mobile" style="">Mobile<span class="text-danger">*</span></label>
		          <div class="helper-text"></div>
		          <input class="form-control input-lg" type="text" id="mobile" name="mobile" placeholder="10 Digits Mobile Number" maxlength="10" minlength="10" digits="true"  value="<?php if(isset($error)){ echo $_POST['mobile']; } ?>" tabindex="5">   
		          
		        </div>

				<div class="form-group">
					<label class="control-label" for="email">Email<span class="text-danger">*</span></label>
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="6">
				</div>
				

				<div class="row">
					<div class="col-xs-12 col-md-12"><input type="submit" name="submit" value="Send Details" class="btn btn-success btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
		</div>
	</div>

</div>
<br><br>
<?php 
	include('footer.php');
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>