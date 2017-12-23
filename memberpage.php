<?php require('includes/config.php'); 


header('X-Frame-Options: SAMEORIGIN');
header("X-XSS-Protection: 1; mode=block");
header('X-Content-Type-Options: nosniff');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 


$email = $_SESSION['email'];
$data = $user->getUserData($email);
		$memberID = $data['memberID'];
		$fullname = $data['fullname'];
		$gender = $data['gender'];
		$city = $data['city'];
		$college = $data['college'];
		$mobile = $data['mobile'];
		$email = $data['email'];
		$reg_date = $data['reg_date'];
		$ren_id = $data['ren_id'];
		// $github = $data['github'];
		// $resume = $data['resume'];
		

$name = strtoupper($fullname);
//include header template
//require('layout/header.php'); 
$title = "Dashboard | Hack 36 | MNNIT Allahabad";
include('header.php');

?>
<script>
   
   var func = function(){
      var h = $('#navigation').height();
      //console.log(h,nav);
      var margin = h + (screen.height*3/100) ;
      //console.log(margin);
      document.getElementById('main').style.marginTop = margin + "px" ;
   }

   $(document).ready(func);

   window.resize = func;

</script>
<style>
	#mask{
		width:100%;
		height:100vh;
		background-color: rgb(44,44,44);
		position:fixed;
		top:0;
		left:0;
		display: none;
		z-index: 1000000;
	}
	#mask #loader{
		width:50%;
		min-height:10px;
		position:relative;
		top:50%;
		left:50%;
		transform:translate(-50%,-50%);
	}
	#mask img{
		width:100%;
		height:auto;
	}
	.videoWrapper {
    position: relative;
    padding-bottom: 140%;
    padding-top: 40px;
    /*padding-left: 0px;
    padding-right: 0px;*/
    height: 0;
}
.videoWrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 455;
}


	<link rel="stylesheet" type="text/css" href="/lib/bootstrap/css/bootstrap.min.css">
</style>
<div id="mask">
	<div id="loader">
		<img src="images/loader.gif"/>
	</div>
</div>

<div class="container" id="main">

	<div class="row">

	    <div class="col-xs-12 col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1 memberDashboard">
				<div class="row memberDetailHeader">
				<div class="col-md-12 col-xs-12 col-sm-12"><center><img height="120px" src="./images/HACK36ill2-min.png"></center></div>
				<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4 col-xs-12 col-sm-12">
				<center><h4>Participant's <b>Dashboard</b></h4></center>
				

				</div>
				<div class="col-md-2"></div>
				<div class="col-md-2 col-sm-12 col-xs-12" style="margin-top:5px;"><center><a href='logout.php'><button align="right" type="button" class="btn btn-danger">Logout</button></a></center></div></div>
				<center><p style="font-size: 14px;"><b></b></p></center>
				<?php if($user->if_allahabad($college) ){ ?>
				<center>
				<p>
				<b style="font-size: 17px; color: blue;">The Hackathon will be held on 27-28 January 2018 i.e. Saturday-Sunday</b>

				<br>
				<p>
				<b>The Hackathon is free of cost and accomodation is provided for the 36 hours of hacking.</b>

				
				<?php } ?>
				</div>
				<!-- <a href='logout.php'><button type="button" class="btn btn-success">Logout</button></a> -->
				

			<div class="">


			<div class="col-md-6 col-xs-12 col-sm-12" style="padding-right: 5px; padding-left: 0px;">
			<div class="memberDetailCard">
			<h3>Welcome, <b><?php echo $name; ?></b></h3>
			<h5>Your Hack 36 ID is: <b><?php echo $ren_id; ?></b></h5>
			
				<center><button type="button" onclick="getticket()" class="btn btn-success" style="width:80%;" disabled="disabled">Download Ticket</button><br>
				<span style="background-color:#4286f4;color:#fff;border: 2px solid #4286f4; font-size: 11px; ">Ticket will be uploaded after your confirmation.</span>
				</center>
				
			 	
			 	<br>
				<table class="table">
				    <thead>
				      <tr>
				        <th colspan="2"><h4>Your profile</h4></th>
				        
				      </tr>
				    </thead>
				    <tbody>
				      
				      
				    
				      <tr>
				        <th>City</th>
				        <td><?php echo $city; ?></td>
				        
				      </tr>
				      <tr>
				        <th>College</th>
				        <td><?php echo $college; ?></td>
				        
				      </tr>

				      <tr>
				        <th>Email</th>
				        <td><?php echo $email; ?></td>
				        
				      </tr>

				      <tr>
				        <th>Contact</th>
				        <td><?php echo $mobile; ?></td>
				        
				      </tr>
				      </tbody>



				        </td>
				        
				      </tr>
				    </tbody>
				 </table>
				 </div>
				 <div  style="padding-right: 0px; padding-left: 0px;">
			<div class="memberDetailCard">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12" style="margin-top: 5px;">
				<table class="table">
				    <thead>
				      <tr>
				        <th colspan="2"><center><h4><strong>Team Details</strong></h4></center></th>
				        
				      </tr>
				    </thead>
				    </table>
				    <div class="videoWrapper">
				    <iframe src="creation.php" height="455px" frameborder="0" allowfullscreen></iframe>
				    <!-- <div class="container">     -->
        <!-- <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                     -->
           </div>

                <!-- Team Creation will be updated soon. Stay tuned! -->
				</div>
				</div>
				</div>
				</div>
			</div>

			<!-- <div class="col-md-1"></div> -->
			<div class="col-md-6 col-xs-12 col-sm-12" style="padding-right: 0px; padding-left: 0px;">
			<div class="memberDetailCard">
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12" style="margin-top: 20px;">
					<center><a target="_blank" href="https://www.google.com/maps/dir/Current+Location/MNNIT-Allahabad"><button class="btn btn-success">Get Route to MNNIT Allahabad</button></a></center>
				</div>
			</div><br>
			<div>
				<h4>How to reach MNNIT</h4>
				<hr>
				If you have reached Allahabad Junction by train, then the best option to reach the college is to take an autorikshaw. It will cost you about 17-20 rupees. The college is in Teliarganj, which is about 7.5 kms from Allahabad junction. The other options available to you are :-
You can take a reserved auto  from the station. It will cost you about 200 rupees.


				<hr>
			</div>
			<br>
			<div>
				<h4>Eateries at MNNIT</h4>
				<hr>Participants will be provided free food for the 36 hours of hacking.
				In MNNIT, we have our college cafeteria near the MP Hall. Another option is to have some snacks at the different canteens.
For Non-vegetarians, food outlets are available outside the campus, like Real Bites, Destination, both near the Saraswati Gate. Other fooding points can be Frendzz Corner near Yamuna Gate.

				<hr>
			</div>
			<br>
			<div>
				<h4>Accomodation at MNNIT</h4>
				<hr>
				Accomodation will be free of cost for the 36 hours of hacking. 
				<!-- <hr> -->

			</div>
			<br>

				</div>

			</div>
			
			</div>
			
				
				<hr>
				<br>
				<br>
				<br>
				
				</div>
		</div>
	</div>
<br>
<br>

</div>



<?php 
//include header template
//require('layout/footer.php'); 
include('footer.php');
?>