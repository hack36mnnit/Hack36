
<?php

require('./includes/config.php'); 
if(!$user->is_logged_in()){ header('Location: ./login.php'); } 
if(!$user->is_paid($_SESSION['email'])){ 
  header('Location: ./memberpage.php');
   } 
$email = $_SESSION['email'];
$data = $user->getUserData($email);
		$memberID = $data['memberID'];
		$ren_id = $data['ren_id'];
		$fullname = $data['fullname'];
		$gender = $data['gender'];
		$city = $data['city'];
		$college = $data['college'];
		$mobile = $data['mobile'];
		$email = $data['email'];
		$active = $data['active'];
		$resetToken = $data['resetToken'];
		$resetComplete = $data['resetComplete'];
		$reg_date = $data['reg_date'];
		$txnid = $data['txnid'];
		$status = $data['status'];
		$amount = $data['amount'];
		$pay_type = $data['pay_type'];
		$pay_date = $data['pay_date'];
		$pay_through = $data['pay_through'];
		$ambassador_email = $data['ambassador_email'];
		$name = strtoupper($fullname);

$name = strtoupper($fullname);
if($user->if_ticket_exists($email))
{
	$data = $user->get_ticket_data($email);
	$tid = $data['tid'];
		$email = $data['email'];
		$qr_msg = $data['qr_msg'];
		$qr_id = $data['qr_id'];
		$qr_created = $data['qr_created'];
		$pdf_id = $data['pdf_id'];
		$pdf_created = $data['pdf_created'];
		$date_created = $data['date_created'];
		$attended = $data['attended'];
		$pdf_link = "./node/".$qr_msg.".pdf";
	//header('Location: '.$pdf_link);
	echo $pdf_link;
}
else{

		$unique_tkt_id = md5(time());
		
		$id = $ren_id;


		$comm = "python qrmaker/qrmaker/generate.py qrmaker/qrmaker/logo.svg \"".$unique_tkt_id."\" qrmaker/qrcodes/".$unique_tkt_id.".svg 2>&1";
		$output = shell_exec($comm);

		


		date_default_timezone_set('Asia/Calcutta');
			$date_created = date('Y/m/d H:i:s');
			
			$stmt = $db->prepare('INSERT INTO tickets (email,qr_msg,qr_id,qr_created,pdf_id,pdf_created,date_created) VALUES (:email, :qr_msg, :qr_id,"Yes", :pdf_id, "Yes", :date_created)');
			$stmt->execute(array(
				':email' => $email,
				':qr_msg' => $unique_tkt_id,
				':qr_id' => $unique_tkt_id,
				
				':pdf_id' => $unique_tkt_id,
				
				':date_created' => $date_created
				
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
		$url = "http://register.ecellmnnit.in/ticket.php?ren_id=$ren_id&fullname=$fullname&city=$city&college=$college&amount=$amount&email=$email&qr_id=$qr_id";


		$comm = "node node/converter.js $qr_msg \"$url\"";
		$output = shell_exec($comm);
		
		$pdf_link = "./node/".$qr_msg.".pdf";
		//header('Location: '.$pdf_link);
		echo $pdf_link;
}

?>
