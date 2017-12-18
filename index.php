
							<!--form-->
							<?php 
error_reporting(0);
require('includes/config.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	
	if(strlen($_POST['fullname']) < 3){
		$error[] = 'Name is too short.';
	}
	if(strlen($_POST['gender']) <= 0 OR $_POST['gender']==''){
		$error[] = 'Gender is not selected.';
	}
	if(strlen($_POST['city']) <=0 OR $_POST['city']=='select a city'){
		$error[] = 'City is not selected.';
	}
	if(strlen($_POST['college']) <=0 OR $_POST['college']=='select a city'){
		$error[] = 'College is not selected.';
	}
	if(strlen($_POST['mobile']) < 10){
		$error[] = 'Mobile number is incorrect.';
	}
	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}
	if(strlen($_POST['github']) < 9){
		$error[] = 'Please check GitHub link.';
	}
	if(strlen($_POST['resume']) < 9){
		$error[] = 'Please check Resume/CV link.';
	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}

	}

	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));

		try {
			date_default_timezone_set('Asia/Calcutta');
			$reg_date = date('Y/m/d H:i:s');
			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (fullname,gender,city,college,mobile,password,email,active,reg_date, github, resume) VALUES (:fullname, :gender, :city,:college, :mobile, :password, :email,  :active,:reg_date, :github, :resume)');
			$stmt->execute(array(
				':fullname' => $_POST['fullname'],
				':gender' => $_POST['gender'],
				':city' => $_POST['city'],
				':college' => $_POST['college'],
				':mobile' => $_POST['mobile'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion,
				':reg_date' => $reg_date,
				':github' => $_POST['github'],
				':resume' => $_POST['resume']
			));
			$id = $db->lastInsertId('memberID');
			$name = $_POST['fullname'];
			//send email
			$verify_link = "".DIR."activate.php?x=$id&y=$activasion";
			$to = $_POST['email'];
			$subject = "Verify your email to complete your registration.";
			
			$body ='
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Activate your account</title>
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
 <p style="text-align: center;padding: 0;margin: 0;">27-28 January 2018</p>
</td>
 </tr>
 <tr>
  <td bgcolor="#ededed" style="padding:10px 30px 40px 30px;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-size:16px;border-collapse:collapse">
  <tr>
   <td>
    Dear '.$name.',
   </td>
  </tr>
  <tr>
   <td style="padding: 20px 0 30px 0;">
    Thank you for registering with us. You need to activate your account to complete your registration.
   </td>
  </tr>
    <tr>
   <td align="center" style="padding: 10px 0 0 0;">
       <a href='.$verify_link.' style="text-decoration:none;padding:10px 20px;background-color:#4b9e60;color:white;border-radius:5px">Click here to activate your account</a>
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
               <a href="https://www.facebook.com/hack36mnnit" target="_blank" title="our Facebook page"><img src="./images/facebook.png" alt=""></a>
           </td>
           
       </tr>
   </table>
  </td>
 </tr>
 <tr bgcolor="#ededed">
     <td align="center" style="padding: 10px 0 10px 0;">
         Please ignore if this email is not related to you!<br>
         NOTE: In case of any queries please contact our team immediately at <a href="mailto:hackthon@mnnit.ac.in" style="text-decoration:none;color:teal">hackathon@mnnit.ac.in</a>
     </td>
 </tr>
 <tr bgcolor="#c8e0f4">
   <td style="padding: 20px 0 10px 20px;">
    Regards<br>Team
     <a href="http://#" target="_blank" style="text-decoration:none;color:teal"> Hack 36 MNNIT</a><br>
    MNNIT Allahabad, 211004, UP, India<br>
    <a href="http://www.hack36.com" target="_blank" style="text-decoration:none;color:teal">www.hack36.com</a>
   </td>
  </tr>
</table>
 </table>
</body>
</html>
			';
			$altbody = 'Thank you for registering with us. Click the link to activate your account.';
			include("send-mail.php"); 
			//mail script ends here...
			
			//redirect to index page
			header('Location: index.php?action=joined');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//define page title
$title = 'Registration Portal | Hack 36 MNNIT';

include('header.php')


//include header template
// require('layout/header.php');
?>
		<!-- About -->
		<section class="about-area" id="about">
			<div class="container">
				
				<div class="row">
					<div class="col-md-6">
						<div class="about-dec">

<div class="container">

	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form id="register" role="form" method="post" action="" autocomplete="off" name="myform" onsubmit="DoSubmit();">
				<h2>Signup for Hack 36 MNNIT</h2>
				<p>If you want to associate as a sponsor, drop us a mail at <a href="mailto:hackathon@mnnit.ac.in">hackathon@mnnit.ac.in</a>.</p>
				<p>Already a member? <a href='login.php'>Login</a></p>
				<div class="form-group">
		          <!-- <input type="checkbox" id="tc" name="tc" value="check">  -->
		          <center><label class="control-label font-label" style="font-size:15px">Read the <a style="cursor: pointer;" onclick="javascript:$('#myModal').modal('show')">Registration Information</a> before proceeding.</label>
		        </div>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
				}
				?>

				
				<div class="form-group">
					<label class="control-label">Full Name<span class="text-danger"> *</span></label>
					<input type="text" name="fullname" id="fullname" class="form-control input-lg" placeholder="Full Name" value="<?php if(isset($error)){ echo $_POST['fullname']; } ?>" tabindex="1">
				</div>
				<div class="form-group">
		          <label class="control-label">Gender<span class="text-danger"> *</span></label><br>
		          <input id="male" type="radio" name="gender" value="male" value="<?php if(isset($error)){ echo $_POST['gender']; } ?>" tabindex="2" checked>
		          <label for="male" class="control-label"><span></span>Male</label>
		          <input id="female" type="radio" name="gender" value="female" value="<?php if(isset($error)){ echo $_POST['gender']; } ?>" tabindex="2">
		          <label for="female" class="control-label"><span></span>Female</label>
		        
		        </div>
		       

		        <div class="form-group">
		          <label class="control-label">City<span class="text-danger"> *</span></label>
		          <br>
		          <select class="form-control" id="city" name="city" value="<?php if(isset($error)){ echo $_POST['city']; } ?>" tabindex="3">
		            <option>Select City</option>
		          </select>
		      
		
		         
		        </div>
		        
		        <div class="form-group">
		          <label class="control-label">College<span class="text-danger"> *</span></label>
		          <br>
		          <select id="college" name="college" class="form-control" disabled="disabled"> value="<?php if(isset($error)){ echo $_POST['college']; } ?>" tabindex="3">
		            <option></option>
		          </select>
		          
		        </div>
		         <div class="form-group">
		         <label class="faculty" class="control-label" style="font-size:12px">Couldn't find your college or city?&nbsp;&nbsp;<a href="addCityCollege.php">Request Here</a></label>
		         <br>
		        </div>

		        <div class="form-group">
		          <label class="control-label" for="mobile" style="">Mobile<span class="text-danger">* </span></label>
		          <input class="form-control input-lg" type="number" id="mobile" name="mobile" placeholder="10 Digits Mobile Number" maxlength="10" minlength="10" digits="true"  value="<?php if(isset($error)){ echo $_POST['mobile']; } ?>" tabindex="5">   

		        </div>

				<div class="form-group">
					<label class="control-label" for="email">Email<span class="text-danger">* </span></label>
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="6">
				</div>

				<div class="form-group">
							<label class="control-label" for="password">Password <span class="text-danger">*</span></label>
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="7">
				</div>

				<div class="form-group">
							<label class="control-label" for="passwordConfirm">Confirm Password <span class="text-danger">*</span></label>
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="8">
				</div>

				<div class="form-group">
					<label class="control-label">GitHub Link<span class="text-danger"> *</span></label>
					<input type="text" name="github" id="github" class="form-control input-lg" placeholder="Your GitHub Link" value="<?php if(isset($error)){ echo $_POST['github']; } ?>" tabindex="9">
				</div>

				<div class="form-group">
					<label class="control-label">Resume/CV Link<span class="text-danger"> *</span><br/><span style="font-size:12px; font-weight: normal">Upload your Resume on Google Drive, make it public shareable and paste the link.&nbsp;&nbsp;</label>
					<input type="text" name="resume" id="resume" class="form-control input-lg" placeholder="Your Resume Link" value="<?php if(isset($error)){ echo $_POST['github']; } ?>" tabindex="10">
				</div>

				 
				
				 

				<div class="row">
					<div class="col-xs-12 col-md-12"><input type="submit" name="submit" value="Register" class="btn btn-success btn-block btn-lg" tabindex="11"></div>
				</div>
			</form>
		</div>
	</div>



<!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Hack 36 Registration Information.</h4>
                </div>
                <div class="modal-body">
                     <ol>
					        	<li>Please register as an individual by filing up the form.</li>
					        	
					        	<li>Verify your email and log in to your dashboard.</li>
					        	<li>In the dashboard, create your team with the given instructions and options.</li>
					        	<li>After your team application is reviewed, you will receive an invitation and will be assigned a single point of contact (SPOC) from team Hack36.</li>
					        	<li><strong>Please note</strong> there is no registration charge for Hack 36. You'll be given free accomodation and complete meal for the 36 hours. Additionally, you will receive a Hack 36 T-shirt and merchandise kit. </li>

					        </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php

//require('layout/footer.php');
?> 

						</div>
					</div>
				</div>
			</div>
		</section>		
		
		
	<?php
	  include('footer.php');
	?>