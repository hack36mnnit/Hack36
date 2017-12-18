<?php 
error_reporting(0);
require('includes/config.php'); 
require_once 'hashconfig.php';



//if not logged in redirect to login page
if(!$user->is_logged_in()){ 
	header('Location: campus_ambassador.php');
 } 
if(!$user->is_ambassador($_SESSION['email'])){ 
	header('Location: campus_ambassador.php');
 }  


$email = $_SESSION['email'];
$amb_email = $email;
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
		$status = $data['status'];
$name = strtoupper($fullname);

$adata = $user->getAmbassadorData($email);
		$aid = $adata['aid'];
		$email = $adata['email'];
		$amt_collected = $adata['amt_collected'];
		$total_reg = $adata['total_reg'];
		$college_id = $adata['college_id'];
		$active = $adata['active'];

$total_count = $user->getUserCountForAmbassador($email,$college);
		$total_unreg = $total_count['total_unreg'];
		$total_reg = $total_count['total_reg'];
		$total_signups = $total_count['total_signups'];


//include header template
//require('layout/header.php'); 
$title = "Campus Ambassador Dashboard Area";
include('header.php');

?>


<div class="container">
<div class="row">
<br>
<center>
<p><b style="font-size: 15px;">Note: The payment deadline has been extended till 2nd Mar 6 pm to avail free workshop.<br>
</b></p>
<b style="font-size: 17px; color: blue;">The workshop on Business and Personality Development will now be held on 4-5th March i.e. Saturday-Sunday<br> during the Renaissance event. Kindly spread this news to all your friends</b></center>
  <div class="col-sm-8"><h3 style="text-align:center;padding: 0;margin: 0;">Welcome, <?php echo $name; ?></h3></div>
  <div class="col-sm-4"><p style="padding :5px 0 0 0;"><a href='logout.php'><button type="button" class="btn btn-success">Logout</button></a></p></div>
  
</div>

	    <div class="col-xs-12 col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1">
			<h4 style="text-align:center; margin: 0; padding: 0;"><?php echo $college; ?></h4>	
<?php if(isset($_GET['action']) && $_GET['action'] == 'success'){
					echo "<h2 class='bg-success'>You have successsfully processed a payment.</h2>";
				} ?>
<div class="bs-example">
    <ul  class="nav nav-tabs nav-justified" style="padding: 0;margin: 0;" >
        <li style="padding: 0;margin: 0;"  class="active"><a data-toggle="tab" href="#sectionA">Unregistered Students(<?php echo $total_unreg; ?>)</a></li>
        <li style="padding: 0;margin: 0;" ><a data-toggle="tab" href="#sectionB">Registered by you(<?php echo $total_reg; ?>)</a></li>
        <li style="padding: 0;margin: 0;" ><a data-toggle="tab" href="#sectionC">Your collection</a></li>
        
    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
            <h3>Unregistered Students</h3>
            <div>
            <?php if($total_unreg){?>
				<table class="table">
				    <thead>
				      <tr>
				      <th>S.No.</th>
				      <th>Name</th>
				        <th>Renaissance id</th>
				        <th>Email</th>
				    	<th>Mobile</th>
				  		<th>Collect Fees</th>
				      </tr>
				    </thead>
				    <tbody>
				    <?php
				    $data = $user->getUserCountTotalUnregForAmbassador($college);
				    $sn=0;
				    while($row = $data->fetch())
				    {
				    	$sn++;
				    	$name = $row['fullname'];
				    	$ren_id = $row['ren_id'];
				    	$email = $row['email'];
				    	$mobile = $row['mobile'];
				    	$college = $row['college'];
				    	$memberID = $row['memberID'];
				    	$status = $row['status'];
				    	
				    	//echo $name;
				    
				    	?>
				 
				    	<tr>
				        <td><?php echo $sn; ?></td>
				        <td><?php echo $name; ?></td>
				         <td><?php echo $ren_id; ?></td>
				          <td><?php echo $email; ?></td>
				          <td><?php echo $mobile; ?></td>
				         <?php
				         
	 $token = urlencode(encryptor('encrypt', $email)); 


				         
				         ?>
				           <td><p style=""><a href='<?php echo './collect_fee.php?token='.$token; ?>'><button type="button" class="btn btn-success">collect</button>
				           </a></p></td>
				      </tr>
				    	<?php
				    }
				    ?>
				      
				    </tbody>
				 </table>
				 <?php }else{ if($total_signups == 0)
				 	{ echo "No one has ever signed up on the portal. Try for signups."; }else{ echo "None left unregistered. Try to get more signups to meet your target.";} } ?>
			</div>
        </div>
        <div id="sectionB" class="tab-pane fade">
            <h3>Registered by you</h3>
            <div>
				<table class="table">
				    <thead>
				      <tr>
				      <th>S.No.</th>
				      <th>Name</th>
				        <th>Renaissance id</th>
				        <th>Email</th>
				        <th>Phone</th>
				        <th>Amount</th>
				  		<th>Transaction id</th>
				      </tr>
				    </thead>
				   <?php
				    $data = $user->getUserCountTotalRegForAmbassador($amb_email,$college);
				    $sn=0;
				    while($row = $data->fetch())
				    {
				    	$sn++;
				    	$name = $row['fullname'];
				    	$ren_id = $row['ren_id'];
				    	$email = $row['email'];
				    	$mobile = $row['mobile'];
				    	$college = $row['college'];
				    	$memberID = $row['memberID'];
				    	$status = $row['status'];
				    	$txnid = $row['txnid'];
				    	$amount = $row['amount'];
				    	//echo $name;
				    
				    	?>
				 
				    	<tr>
				        <td><?php echo $sn; ?></td>
				        <td><?php echo $name; ?></td>
				         <td><?php echo $ren_id; ?></td>
				          <td><?php echo $email; ?></td>
				          <td><?php echo $mobile; ?></td>
				        <td><?php echo $amount; ?></td>
				          <td><?php echo $txnid; ?></td>
				          
				      </tr>
				    	<?php
				    }
				    ?>
				    </tbody>
				 </table>
			</div>
        </div>
        <div id="sectionC" class="tab-pane fade">
            <h3>Your Collection</h3>
            <div>
				<h3 style="text-align: center;">Total Amount: <?php echo "&#8377 ".$amt_collected;  ?></h3>
			</div>
           
        </div>
    </div>
</div>


			
				
				<hr>
				<br>
				
				

		</div>
	</div>


</div>

<?php 
//include header template
//require('layout/footer.php'); 
include('footer.php');
?>
