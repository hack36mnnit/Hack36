<?php
// session_start();
error_reporting(0);
require('function.php');
require('includes/config.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$email = $_SESSION['email'];
	$data = $user->getUserData($email);
	$ren_id = $data['ren_id'];
	$memberID = 1013+$data['memberID'];
	$team_name = validate($_POST["teamname"]);
	$member1id = validate($_POST["member1id"]);
	$member2id = validate($_POST["member2id"]);
	$member3id = validate($_POST["member3id"]);                        
	$con = con();
	
	
	$team_id = "HKTM".$memberID;


  if($team_id == 'HKTM1013'){
		?>
		<script>window.location='creation.php';</script>
		<?php 
		die();
	}	if($ren_id == $member1id || $ren_id == $member2id || $ren_id == $member3id ||  $member1id == $member2id){
		?>
		<script>alert('Members you entered cannot be same.');window.location='creation.php';</script>
		<?php die();
	}

	if($member2id!="" && $member2id == $member3id){
		?>
		<script>alert('Members you entered cannot be same.');window.location='creation.php';</script>
		<?php die();
	}

	if($member1id == $member3id){
		?>
		<script>alert('Members you entered cannot be same.');window.location='creation.php';</script>
		<?php die();
	}

	$q1 = "SELECT * FROM members M1 where M1.ren_id='$member1id' ";
	$res1 = $con->query($q1);
	if($res1->num_rows!=1){
		?>
		<script>alert('Member/members you entered has not yet registered.');window.location='creation.php';</script>
		<?php die();
	}
	if($member2id!=""){
	$q2 = "SELECT * FROM members M2 where M2.ren_id='$member2id' ";
	$res2 = $con->query($q2);

	if($res2->num_rows!=1){
		?>
		<script>alert('Member/members you entered has not yet registered.');window.location='creation.php';</script>
		<?php die();
	}
	}
	if($member3id!=""){

	$q3 = "SELECT * FROM members M3 where M3.ren_id='$member3id' ";
	$res3 = $con->query($q3);

	if($res3->num_rows!=1){
		?>
		<script>alert('Member/members you entered has not yet registered.');window.location='creation.php';</script>
		<?php die();
	}
	}

	$query = "SELECT * FROM team T1 where T1.member1id='$member1id' ";
	$result = $con->query($query);

	if($result->num_rows>0){
		?>
		<script>alert('Member/members you entered already exists in some team.');window.location='creation.php';</script>
		<?php die();
	}


	$query1 = "SELECT * FROM team T2 where T2.member2id='$member1id' ";
	$result1 = $con->query($query1);

	if($result1->num_rows>0){
		?>
		<script>alert('Member/members you entered already exists in some team.');window.location='creation.php';</script>
		<?php
		die();
	}

	$query2 = "SELECT * FROM team T3 where T3.member1id='$member2id' ";
	$result2 = $con->query($query2);

	if($result2->num_rows>0){
		?>
		<script>alert('Member/members you entered already exists in some team.');window.location='creation.php';</script>
		<?php die();
	}


	$query3 = "SELECT * FROM team T4 where T4.member2id='$member2id' ";
	$result3 = $con->query($query3);

	if($result3->num_rows>0){
		?>
		<script>alert('Member/members you entered already exists in some team.');window.location='creation.php';</script>
		<?php
		die();
	}
	$query4 = "SELECT * FROM team T5 where T5.member1id='$member3id' ";
	$result4 = $con->query($query4);

	if($result4->num_rows>0){
		?>
		<script>alert('Member/members you entered already exists in some team.');window.location='creation.php';</script>
		<?php die();
	}


	$query5 = "SELECT * FROM team T6 where T6.member2id='$member3id' ";
	$result5 = $con->query($query5);

	if($result5->num_rows>0){
		?>
		<script>alert('Member/members you entered already exists in some team.');window.location='creation.php';</script>
		<?php
		die();
	}		

	else
	{
		$ins_query = "INSERT INTO team (team_id, team_name, member1id, member2id) VALUES ('$team_id','$team_name','$ren_id','$member1id')" ;
		$ins_res = $con->query($ins_query);
		if($member2id != "")
		{
			$ins_query = "INSERT INTO team (team_id, team_name, member1id, member2id) VALUES ('$team_id','$team_name','$ren_id','$member2id')" ;
			$ins_res = $con->query($ins_query);
		}
		if($member3id != "")
		{
			$ins_query = "INSERT INTO team (team_id, team_name, member1id, member2id) VALUES ('$team_id','$team_name','$ren_id','$member3id')" ;
				$ins_res = $con->query($ins_query);
		}
		// $ins_res = $con->query($ins_query);
		$con=con();
		$q1 = "SELECT email, fullname FROM `members` where ren_id='$ren_id' ";
		$resq1 = $con->query($q1);
		$arr1 = $resq1->fetch_array();
		$mem1_name = $arr1['fullname'];
		$mem1_email = $arr1['email'];

		$q2 = "SELECT email, fullname FROM `members` where ren_id='$member1id' ";
		$resq2 = $con->query($q2);
		$arr2 = $resq2->fetch_array();
		$mem2_name = $arr2['fullname'];
		$mem2_email = $arr2['email'];

		$q3 = "SELECT email, fullname FROM `members` where ren_id='$member2id' ";
		$resq3 = $con->query($q3);
		$arr3 = $resq3->fetch_array();
		$mem3_name = $arr3['fullname'];
		$mem3_email = $arr3['email'];

		$q4 = "SELECT email, fullname FROM `members` where ren_id='$member3id' ";
		$resq4 = $con->query($q4);
		$arr4 = $resq4->fetch_array();
		$mem4_name = $arr4['fullname'];
		$mem4_email = $arr4['email'];

		$to = $mem1_email;
		$subject = "Team created | Hack 36 | MNNIT Allahabad";
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Team Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <style>
      @media(max-width:600px){
          .content{
          width:100%;
      }
      }

      #tableb{
        border-collapse: collapse;
      }
      #tableb td, #tabelb th {
    border: 1px solid #000;
    padding: 2px;
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
    Dear <strong>'.$mem1_name.'</strong>,
   </td>
  </tr>
  <tr>
   <td style="padding: 20px 0 10px 0;">
    Your team has been created successfully. Check the following details.
   </td>
  </tr>
   
     <tr>
   <td style="padding: 5px 0 5px 0;">
    <font size="5">Team name: <strong>'.$team_name.'</strong>
   </font></td>
  </tr>
     <tr>
   <td style="padding: 5px 0 5px 0;">
    <font size="4">Team ID: <strong>'.$team_id.'</strong>
   </font></td>
  </tr>
 
 </table>
</td>
 </tr>
 <tr>
<td bgcolor="#ededed">
  <table id="tableb" align="center" border="1px" border-collapse="collapse">
  <tr width="100px" border="1px" border-collapse="collapse"> 
    <th align="left" width="200px" border="1px" border-collapse="collapse">Hack 36 ID</th>
    <th align="left" width="350px" border="1px" border-collapse="collapse">Member Name</th>
    
  </tr>
  <tr>
    <td align="left">'.$ren_id.'</td>
    <td align="left">'.$mem1_name.'</td>
    
  </tr>
  <tr>
    <td align="left">'.$member1id.'</td>
    <td align="left">'.$mem2_name.'</td>
    
  </tr>
  <tr>
    <td align="left">'.$member2id.'</td>
    <td align="left">'.$mem3_name.'</td>
   
  </tr>
  <tr>
    <td align="left">'.$member3id.'</td>
    <td align="left">'.$mem4_name.'</td>
   
  </tr>
  
  
</table>

<br>
</td>
 </tr>


 <tr>
  <td bgcolor="#ededed">
  <p style="text-align: center;">For official updates follow us on:</p>
   <table align="center">
       <tr>
           <td align="center">
               <a href="https://www.facebook.com/hack36mnnit" target="_blank" title="our Facebook page"><img src="https://4.bp.blogspot.com/-gDXKOlV0GNE/WI2UTLnZUkI/AAAAAAAABtA/r77ovtSRmkc_3o11_PF7YMj79GGcCBT6gCLcB/s1600/facebook.png" alt=""></a>
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
$altbody = "Thank you showing interest in Hack 36";
include("send-mail.php"); 

		echo "<script>alert('Team created successfully. Mail has been sent.');window.location='creation.php';</script>";
		die();
	}

}