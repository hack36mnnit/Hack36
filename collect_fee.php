<?php
error_reporting(0);
require('includes/config.php'); 
 require_once 'hashconfig.php';
 $title = 'Collect Fee Ambassador';

include('header.php');
 if(!$user->is_logged_in()){ 
	header('Location: campus_ambassador.php');
 } 
if(!$user->is_ambassador($_SESSION['email'])){ 
	header('Location: campus_ambassador.php');
 }  

//if form has been submitted process it
if(isset($_POST['submit'])){

if(empty($_POST['txnid'])){
		$error[] = 'Receipt id is empty.';
	}
if(empty($_POST['amount'])){
		$error[] = 'Amount is not selected.';
	}
	$email = $_POST['email'];
	$college = $_POST['college'];
	$txnid = $_POST['txnid'];
	$amount = $_POST['amount'];
	$amb_email = $_POST['amb_email'];
	$fullname = $_POST['fullname'];
	$status = "success";
	if(!isset($error)){
		try {

			date_default_timezone_set('Asia/Calcutta');
      $pay_date = date('Y/m/d H:i:s'); 
      //insert into database with a prepared statement
      $stmt = $db->prepare('UPDATE members SET txnid = :txnid, status = :status, amount = :amount, pay_type = "offline",pay_date = :pay_date, pay_through = "ambassador", ambassador_email = :amb_email WHERE email = :email AND college = :college');
      $stmt->execute(array(
        ':txnid' => $txnid,
        ':status' => $status,
        ':amount' => $amount,
        ':pay_date' => $pay_date,
        ':amb_email' => $amb_email,
        ':email' => $email,
        ':college' => $college
        
        
      ));
      $total_amt=0; $total_reg=0;
$data = $user->getUserCountTotalRegForAmbassador($amb_email,$college);
				   $total_reg=$data->rowCount();
				    while($row = $data->fetch())
				    {
				    	
				    	/*$name = $row['fullname'];
				    	$ren_id = $row['ren_id'];
				    	$email = $row['email'];
				    	$college = $row['college'];
				    	$memberID = $row['memberID'];
				    	$status = $row['status'];*/
				    	$amt = $row['amount'];
				    	$total_amt = $total_amt+$amt;
				    	//echo $name;
				    
				    	}

      $stmtt = $db->prepare('UPDATE campus_ambassador SET amt_collected = :total_amt, total_reg = :total_reg WHERE email = :amb_email');
      $stmtt->execute(array(
        ':total_amt' => $total_amt,
        ':total_reg' => $total_reg,
        ':amb_email' => $amb_email
        
        
      ));
      $amt_details = "";
      if($amount == 500)
      {
        $amt_details = "$amount (renaissance + free workshop business and personality)";
      }
      if($amount == 700)
      {
        $amt_details = "$amount (renaissance + free workshop + python and android workshop)";
      }
			//send email
      $name = $fullname;
      $status_link="".DIR."memberpage.php";
      $ticket_link="".DIR."memberpage.php";
			$name = $fullname;
			$to = $email;
			$subject = "Payment Successfull";
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Activated your account</title>
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

 <img src="https://3.bp.blogspot.com/-2w4ASZKQjS4/WI3_Kqeyr3I/AAAAAAAAF2w/TDuZM56T1SEfWdpSXEp22ykiIVJtFejogCLcB/s1600/email_new.png" alt="Renaissance title logo" width="350" height="100" style="display: block;" />
 <p style="text-align: center;padding: 0;margin: 0;">4th-5th March 2017</p>
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
   <td style="padding: 20px 0 10px 0;">
    You have successfully paid your fees through campus ambassador.
    Campus ambassador contact email '.$amb_email.'
    Are you excited. See you at Renaissance.
   </td>
  </tr>
   
   <tr>
   <td style="padding: 5px 0 5px 0;">
    You can check your status by clicking this <a href="'.$status_link.'">link</a>.
   </td>
  </tr>

  <tr>
   <td style="padding: 5px 0 20px 0;">
    You can download your ticket below.
    This ticket is not transferable. This ticket is necessary to attend the Esummit.
   </td>
  </tr>
    <tr>
   <td align="center" style="padding: 10px 0 0 0;">
       <a href="'.$ticket_link.'" style="text-decoration:none;padding:10px 20px;background-color:#4b9e60;color:white;border-radius:5px">Download Ticket</a>
   </td>
  </tr>
  <tr>
   <td style="padding: 5px 0 5px 0;">
    Transaction id: '.$txnid.' 
   </td>
  </tr>
  <tr>
   <td style="padding: 5px 0 5px 0;">
    Amount paid: Rs '.$amt_details.'
   </td>
  </tr>
  <tr>
   <td style="padding: 5px 0 5px 0;">
    Note: Payment slip amount should be equal to the amount mentioned above. You have to bring payment slip amount during all the events including workshops.
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
               <a href="https://www.facebook.com/mnnitecell" target="_blank" title="our Facebook page"><img src="https://4.bp.blogspot.com/-gDXKOlV0GNE/WI2UTLnZUkI/AAAAAAAABtA/r77ovtSRmkc_3o11_PF7YMj79GGcCBT6gCLcB/s1600/facebook.png" alt=""></a>
           </td>
           <td align="center">
               <a href="https://twitter.com/ECellMNNIT" target="_blank" title="our Twitter page"><img src="https://1.bp.blogspot.com/-7XA0OzO5ijw/WI2UTg0vi8I/AAAAAAAABtI/hYi2M9UgiaMOgCopO2XhkGMLs6sTyCE4wCLcB/s1600/twitter.png" alt=""></a>
           </td>
           <td align="center">
               <a href="https://www.linkedin.com/company/13249340" target="_blank" title="our Linkedin page"><img src="https://4.bp.blogspot.com/-jc9rSHdggDA/WI2UTNIYLvI/AAAAAAAABs8/_Qfpp_VdW4kf19rn-PekNRnmxYQPfbaWgCLcB/s1600/linkedin.png" alt=""></a>
           </td>
           <td align="center">
               <a href="https://www.instagram.com/ecellmnnit/" target="_blank" title="our Instagram page"><img src="https://3.bp.blogspot.com/-NXTO-YSI2c0/WI2USzivNOI/AAAAAAAABtE/hH6QqZ73R90qXFLlBTfMI77O_N18Ard1wCLcB/s1600/instagram.png" alt=""></a>
           </td>
       </tr>
   </table>
  </td>
 </tr>
 <tr bgcolor="#ededed">
     <td align="center" style="padding: 25px 0 15px 0;">
         Please ignore if this email is not related to you!<br>
         NOTE: In case of any queries please contact our team immediately at <a href="mailto:renaissance@mnnit.ac.in" style="text-decoration:none;color:teal">renaissance@mnnit.ac.in</a>
     </td>
 </tr>
 <tr bgcolor="#c8e0f4">
   <td style="padding: 20px 0 30px 30px;" >
    Regards<br>Team
     <a href="http://renaissance.mnnit.ac.in" target="_blank" style="text-decoration:none;color:teal"> Renaissance 2017</a><br>
    MNNIT Allahabad, 211004, UP, India<br>
    <a href="http://renaissance.mnnit.ac.in" target="_blank" style="text-decoration:none;color:teal">www.renaissance.mnnit.ac.in</a>
   </td>
  </tr>
</table>
 </table>
</body>
</html>';
        $altbody = 'We have successfully received your payment for RENAISSANCE 2017. we are pleased to have you at the Summit.';
			
			include("send-mail.php"); 
			//redirect to index page
			header('Location: campus_ambassador_dashboard.php?action=success');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}


$caemail = $_SESSION['email'];
$cadata = $user->getUserData($caemail);
		$camemberID = $cadata['memberID'];
		$cafullname = $cadata['fullname'];
		$cagender = $cadata['gender'];
		$cacity = $cadata['city'];
		$cacollege = $cadata['college'];
		$camobile = $cadata['mobile'];
		$caemail = $cadata['email'];
		$careg_date = $cadata['reg_date'];
		$caren_id = $cadata['ren_id'];
		$castatus = $cadata['status'];

			if( isset($_GET['token']) && !empty( $_GET['token'] ) ){
				$token = urldecode($_GET['token']);
				
				$email = encryptor('decrypt', $token);
				//echo $email;

				$row = $user->getUserToCollectFeeForAmbassador($email,$cacollege);
				$count = $row->rowCount();
				//echo $count;
				//$amount = 500;
				$data = $row->fetch();
				if($count == 1 AND (!$user->is_paid($email)) )
				{

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

					?>


<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				
				<h4><?php echo "Check details and proceed"; ?></h4>
        <b><?php echo "NOTICE: Payment receipt is necessary to attend all the events including workshops."; ?></b>
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				
				?>
				
				
		 <div>
        <table class="table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Details</th>
          
              </tr>
            </thead>
            <tbody>
            <tr>
                <td>Name</td>
                <td><?php echo $fullname; ?></td>
                
              </tr>
              <tr>
                <td>Renaissance ID</td>
                <td><?php echo $ren_id; ?></td>
                
              </tr>
              <tr>
                <td>Email</td>
                <td><?php echo $email; ?></td>
                
              </tr>
              <tr>
                <td>City</td>
                <td><?php echo $city; ?></td>
                
              </tr>
              <tr>
                <td>College</td>
                <td><?php echo $college; ?></td>
                
              </tr>
              <tr>
                <td>Mobile</td>
                <td><?php echo $mobile; ?></td>
                
              </tr>
              <!-- <tr>
                <td>Registration Fees</td>
                 <?php if($user->if_allahabad($college)){ ?>
                <td><?php 

//echo "<b> &#8377 ".$amount."</b> (*including <b>free workshop on business and personality development</b> on 25th Feb tentative)";
                    ?><br>
                    <span style="background-color:#4286f4;color:#fff;border: 2px solid #4286f4; ">NOTE:* Offer valid for successfull payment till 20th Feb</span>
                    <?php
                ?></td>
                <?php } else {?>
                <td><?php echo "&#8377 ".$amount." "; ?></td>
                <?php } ?>
              </tr> -->
            </tbody>
         </table>
    
    <form action="" method="post" name="myform" onsubmit="DoSubmit();" >
      
      <table>
        
        <tr>
          <td >Select Amount:&nbsp;&nbsp; </td>

		        <td>  <select class="form-control" name="amount" required >
                         <?php if($user->if_allahabad($college)){ ?>
                            <option value=500>Rs 500 (Renaissance + free workshop on business and personality)</option>
                          
                            <option value=700>Rs 700 (Renaissance + free Workshop + workshop(android and python))</option>  
                            <?php } else{?>     
                                <option value=500>Rs 500 (Renaissance)</option> 
                                <?php } ?>              
                          </select></td>
          
        </tr>
        <tr>
          <td>Enter Receipt id(slip number):&nbsp;&nbsp; </td>

		        <td>  <input  name="txnid" id="txnid" value="" required/></td>
          
         
        </tr>
       <!--  <tr>
        <td class="collectFeeformhead">Amount: </td>
          <td><input type="hidden" name="amount" id="amount" value="<?php echo $amount; ?>" required readonly/></td>
           </tr>
        <tr> -->
        <td class="collectFeeformhead">Name: </td>
          <td><input type="hidden" name="name" id="name" value="<?php echo $fullname; ?>" required readonly/></td>
           </tr>
           <tr>
          <td class="collectFeeformhead">Email: </td>
          <td><input type="hidden" name="email" id="email" value="<?php echo $email; ?>" required readonly/></td>
          </tr>
          <tr>
          <td class="collectFeeformhead">Ambassador Email: </td>
          <td><input type="hidden" name="amb_email" id="amb_email" value="<?php echo $caemail; ?>" required readonly/></td>
          </tr>
          <tr>
          <td class="collectFeeformhead">College: </td>
          <td><input type="hidden" name="college" id="college" value="<?php echo $college; ?>" required readonly/></td>
        </tr>
       
        <tr>
          
            <td><br><input type="submit" name="submit" value="Pay" class="btn btn-success btn-block btn-lg" /></td>
          
        </tr>

      </table>
      
    </form>
    <br>
    <a href='./campus_ambassador_dashboard.php'><button align="right" type="button" class="btn btn-danger">cancel</button></a>
    <br><br>
      </div>



					<?php




				}
				else
				{
					echo "invalid user";
				}

			
				
			}
			else{
				echo "invalid token";
			}


?>
</div>
</div>
</div>
<br><br>
<?php 
//include header template
//require('layout/footer.php'); 
include('footer.php');
?>
