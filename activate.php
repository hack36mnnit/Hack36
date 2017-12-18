<?php
error_reporting(0);
require('includes/config.php');

//collect values from the url
$memberID = trim($_GET['x']);
$active = trim($_GET['y']);

//if id is number and the active token is not empty carry on
if(is_numeric($memberID) && !empty($active)){
		

	//update users record set the active column to Yes where the memberID and active value match the ones provided in the array
	$stmt = $db->prepare("UPDATE members SET active = 'Yes' WHERE memberID = :memberID AND active = :active");
	$stmt->execute(array(
		':memberID' => $memberID,
		':active' => $active
	));

	//if the row was updated redirect the user
	if($stmt->rowCount() == 1){
		$data = $user->getUserDataUsingID($memberID);
	    $memberID = $data['memberID'];
	    $fullname = $data['fullname'];
	    $gender = $data['gender'];
	    $city = $data['city'];
	    $college = $data['college'];
	    $mobile = $data['mobile'];
	    $email = $data['email'];
	    $reg_date = $data['reg_date']; 
		$name = strtoupper($fullname);
	    $renaissanceid = "HK".strtoupper(substr($fullname, 0,2))."18".$memberID;
	    $stmt = $db->prepare("UPDATE members SET ren_id = :ren_id WHERE memberID = :memberID AND email = :email AND active = 'Yes'");
		$stmt->execute(array(
			':memberID' => $memberID,
			':ren_id' => $renaissanceid,
			':email' => $email
		));
$login_link = "".DIR."login.php";
$pay_link = "".DIR."memberpage.php";
			//send email
			$to = $email;
			$subject = "Account activated | 'Hack 36' | MNNIT Allahabad";
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
   <td style="padding: 20px 0 10px 0;">
    Your account has been activated.
    Thank you for showing up your interest. We will be pleased to have you at Hack 36.
   </td>
  </tr>
   <tr>
   <td style="padding: 5px 0 5px 0;">
    Your Hack 36 ID is: <strong>'.$renaissanceid.'</strong>
   </td>
  </tr>
   <tr>
   <td style="padding: 5px 0 5px 0;">
    You can now login at the portal by clicking this <a href="'.$login_link.'">link</a>.
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
     <td align="center" style="padding: 25px 0 15px 0;">
         Please ignore if this email is not related to you!<br>
         NOTE: In case of any queries please contact our team immediately at <a href="mailto:hackathon@mnnit.ac.in" style="text-decoration:none;color:teal">hackathon@mnnit.ac.in</a>
     </td>
 </tr>
 <tr bgcolor="#c8e0f4">
   <td style="padding: 20px 0 30px 30px;" >
    Regards,<br>Team
     <a href="http://www.hack36.com" target="_blank" style="text-decoration:none;color:teal"> Hack 36 </a><br>
    MNNIT Allahabad, 211004, UP, India<br>
    <a href="http://www.hack36.com" target="_blank" style="text-decoration:none;color:teal">http://www.hack36.com</a>
   </td>
  </tr>
</table>
 </table>
</body>
</html>';
			$altbody = 'Thank you for registering for Hack 36.';
			include("send-mail.php"); 
		//redirect to login page
		header('Location: login.php?action=active');
		exit;

	} else {
		//define page title
$title = 'Activate your Account';

//include header template
require('./header.php'); 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
<br>
<?php 
		echo "Your account is either already activated or the link is not working. Kindly contact us."; 

?>
	</div>
	</div>


</div>

<?php 
//include header template
require('./footer.php'); 

	}
	
}
?>