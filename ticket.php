<?php

/*require('./includes/config.php'); */

//if not logged in redirect to login page
/*if(!$user->is_logged_in()){ header('Location: ./login.php'); } 
if(!$user->is_paid($_SESSION['email'])){ 
  header('Location: ./memberpage.php');
} */

//$email = $_SESSION['email'];
//$data = $user->getUserData($email);
		//$memberID = $data['memberID'];
if(!isset($_GET['ren_id']) || !isset($_GET['fullname']) || !isset($_GET['city']) || !isset($_GET['college'])|| !isset($_GET['amount'])|| !isset($_GET['email'])|| !isset($_GET['qr_id']))
{
	header("Location: error.php");
}
		$ren_id = $_GET['ren_id'];
		$fullname = $_GET['fullname'];
		//$gender = $data['gender'];
		$city = $_GET['city'];
		$college = $_GET['college'];
		$amount = $_GET['amount'];
		//$mobile = $data['mobile'];
		$email = $_GET['email'];
		//$active = $data['active'];
		/*$resetToken = $data['resetToken'];
		$resetComplete = $data['resetComplete'];
		$reg_date = $data['reg_date'];
		$txnid = $data['txnid'];
		$status = $data['status'];
		$amount = $data['amount'];
		$pay_type = $data['pay_type'];
		$pay_date = $data['pay_date'];
		$pay_through = $data['pay_through'];
		$ambassador_email = $data['ambassador_email'];*/
		$name = strtoupper($fullname);

//$tkt_data = $user->get_ticket_data($email);
		/*$tid = $tkt_data['tid'];
		$email = $tkt_data['email'];
		$qr_msg = $tkt_data['qr_msg'];*/
		$qr_id = $_GET['qr_id'];
		/*$qr_created = $tkt_data['qr_created'];
		$pdf_id = $tkt_data['pdf_id'];
		$pdf_created = $tkt_data['pdf_created'];
		$date_created = $tkt_data['date_created'];
		$attended = $tkt_data['attended'];*/

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ticket Generated</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	 <link href="http://allfont.net/allfont.css?fonts=lane-narrow" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="qrmaker/style.css">
</head>
<body>
<div id="container">
	<div id="header">
		<div id="headlogo">
			<img src="images/Hack36.jpg">
		</div>
		<div id="summit">
			<p><b>An Entrepreneurship Summit</b></p>
		</div>
	</div>
	<div id="userinfo">
		<div id="details">
			<ul id="mainul">
				<li><h5>Hack36 ID: <?php echo $ren_id; ?></h5></li>
				<li>
					<div id="photobox">
						<b>Your<br>Photo<br>Here</b>
					</div>
					<div id="names">
						<ul>
							<li><h1><?php echo $name; ?></h1></li>
							<li><h4><?php echo $college; ?></h4></li>
							<li><h4><?php echo $city; ?></h4></li>
						</ul>
					</div>
				</li>
				<br>
				<li><h4><?php echo $email; ?></h4></li>
				<li><h3>Registered for: </h3>
					<ul>
					<?php if($city == "Allahabad"){ 
						if($college == "MNNIT"){

							?>
							<li>Renaissance</li>
						
							<?php
						}else{
							?>
							<li>Renaissance</li>
						<li>Workshops</li>
							<?php

						}
					
						 } else{?>
						<li>Renaissance</li>
						<?php } ?>
					</ul>
				</li>
			</ul>
		</div>
		<div id="qrcode">
			<iframe src="qrmaker/qrcodes/<?php echo $qr_id.'.svg'; ?>" ></iframe>
		</div>
		<p><i>Note: Do not tamper this area.</i></p>
	</div>
	<div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Transaction #
                </td>
            </tr>
            
            <tr class="details">
             <?php if($college == "MNNIT"){?>
                <td>
                    Free of cost
                </td>
                
                <td>
                    NA
                </td>
                <?php }else{ ?>
                <td>
                   
                </td>
                NA
                <td>
                    NA
                </td>
                <?php } ?>
            </tr>
            
            <tr class="heading">
                <td>
                    Registered For
                </td>
                
                <td>
                    Fees
                </td>
            </tr>
            

            <?php if($city == "Allahabad"){ 
						if($college == "MNNIT"){

							?>
							<tr class="item">
                <td>
                    Renaissance
                </td>
                
                <td>
                    <strike>
    	                &#8377; 500
        			</strike>
                </td>
            </tr>
						
							<?php
						}else{
							?>
							<tr class="item">
                <td>
                    Renaissance
                </td>
                
                <td>
                    &#8377; 500
                </td>
            </tr>
            <?php if($amount == 500){?>
            <tr class="item">
                <td>
                    Workshops(Bussiness Development and Personality development)
                </td>
                
                <td>
	            	<strike>
    	                &#8377; 300
        			</strike>
                </td>
            </tr>
            <?php } ?>
            <?php if($amount == 700){?>
            <tr class="item">
                <td>
                    Workshop(Bussiness Development and Personality development)<br>
                    workshop(android and python development)
                </td>
                
                <td>
	            	
    	                &#8377; 200
        			
                </td>
            </tr>
            <?php } ?>
							<?php

						}
					
						 } else{?>
						<tr class="item">
                <td>
                    Renaissance
                </td>
                
                <td>
                    &#8377; 500
                </td>
            </tr>
						<?php } ?>

            
            <tr class="total">
                <td></td>
                <?php if($college == "MNNIT"){?>
                <td>
                   Total: &#8377; 0.0
                </td>
                <?php }else{ ?>
                <?php if($amount == 500){?>
                <td>
                  Total: &#8377; 500
                </td>
                <?php } ?>
                <?php if($amount == 700){?>
                <td>
                  Total: &#8377; 700
                </td>
                <?php } ?>
                <?php } ?>
            </tr>
        </table>
    </div>
	<div id="footer">
		<div id="backgroundimg"></div>
		<p><b>Terms and Conditions: </b>No exchange of tickets will be made under any circumstances and tickets are non-transferable. Tickets are for admission of a single person only. No refunds will be made except in the case of event postponement or cancellation and at organizer's discretion. Entry will be refused if tickets have been found to be tampered, counterfeited; or seem unauthentic in any form. The tickets may be checked at the entrance hall of the venue the date of the event, or as deemed fit by the organizer. The participants are expected to be able to produce a copy of the ticket, either digital or in print, whenever sought by the event management. The resale of tickets is prohibited. Venue Owner reserves the right without refund or compensation to refuse admission to any persons whose conduct is disorderly or unbecoming, or may be derogatory to the decorum of the event. The event management reserves the right to withdraw, substitute and/or vary advertised programmes, event times, seating arrangements and audience capacity without prior notice. The management may postpone, cancel, interrupt or stop the event due to adverse weather, dangerous situations, or any other causes beyond its reasonable control. The Ticket Holder agrees to submit to any search for any prohibited items including but not limited to weapons, controlled, dangerous and illegal substances. </p>
		
	</div>
</div>
</body>
</html>