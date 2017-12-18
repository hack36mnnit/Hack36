<?php
error_reporting(0);
require('./includes/config.php'); 
 $title = 'Payment Success';
include('./header.php');
if(!$user->is_logged_in()){ header('Location: ./login.php'); } 
//echo $_SESSION['email'] ;
if($user->is_paid($_SESSION['email'])){ 
  header('Location: ./memberpage.php');
   } 
 
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
$name = strtoupper($fullname);
    $ren_id = $data['ren_id'];


$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="pOCLf7ytic";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	   
      date_default_timezone_set('Asia/Calcutta');
      $pay_date = date('Y/m/d H:i:s'); 
      //insert into database with a prepared statement
      $stmt = $db->prepare('UPDATE members SET txnid = :txnid, status = :status, amount = :amount, pay_type = "online",pay_date = :pay_date, pay_through = "self" WHERE email = :email');
      $stmt->execute(array(
        ':txnid' => $txnid,
        ':status' => $status,
        ':amount' => $amount,
        ':pay_date' => $pay_date,
        ':email' => $email
        
      ));
      
      $tkt_data = $user->get_ticket_data($email);
    $tid = $tkt_data['tid'];
    $email = $tkt_data['email'];
    $qr_msg = $tkt_data['qr_msg'];
    $qr_id = $tkt_data['qr_id'];
    $qr_created = $tkt_data['qr_created'];
    $pdf_id = $tkt_data['pdf_id'];
    $pdf_created = $tkt_data['pdf_created'];
    $date_created = $tkt_data['date_created'];
    $attended = $tkt_data['attended'];
      
      $to = $email;
      $status_link="".DIR."memberpage.php";
      $ticket_link="".DIR."memberpage.php";
      if($status=="success")
      {
        $amt_details = "";
        if($user->if_allahabad($college)){ 
              $amt_details = "$amount (renaissance + free workshop business and personality)";
            }else{

               $amt_details = $amount;
            }
                    
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
    You have successfully paid your fees.
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
      }
      
      
      //mail script ends here...
   
          echo "<br><p>Thank You. Your transaction status is ". $status .".</p><br>";
          echo "<p>Your Transaction ID for this transaction is ".$txnid.".</p><br>";
          echo "<p>We have received a payment of Rs. " . $amount . ". Your can now download your ticket from members page.</p><br>";
           
		   }         
?>	
<p><a href="memberpage.php">Go to members page</a></p><br>
<p>You will be redirected to members page in <span id="counter">16</span> second(s).</p><br>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        location.href = 'memberpage.php';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);
</script>

<?php
    include('footer.php');
  ?>
