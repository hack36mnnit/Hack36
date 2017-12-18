<?php
include('password.php');
class User extends Password{

    private $_db;

    function __construct($db){
    	parent::__construct();

    	$this->_db = $db;
    }

private function get_user_verified_data($email){

		try {
			$stmt = $this->_db->prepare('SELECT * FROM members WHERE email = :email');
			$stmt->execute(array('email' => $email));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	private function get_ambassador_hash($email){

		try {
			$stmt = $this->_db->prepare('SELECT * FROM campus_ambassador WHERE email = :email');
			$stmt->execute(array('email' => $email));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	private function get_user_hash($email){

		try {
			$stmt = $this->_db->prepare('SELECT * FROM members WHERE email = :email AND active="Yes" ');
			$stmt->execute(array('email' => $email));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}
	private function get_user_hash_using_ID($memberID){

		try {
			$stmt = $this->_db->prepare('SELECT * FROM members WHERE memberID = :memberID AND active="Yes" ');
			$stmt->execute(array('memberID' => $memberID));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	public function login($email,$password){

		$row = $this->get_user_hash($email);

		if($this->password_verify($password,$row['password']) == 1){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['email'] = $row['email'];
		    $_SESSION['memberID'] = $row['memberID'];
		    return true;
		}
	}
	public function getUserData($email)
	{
		$row = $this->get_user_hash($email);
		$memberID = $row['memberID'];
		$ren_id = $row['ren_id'];
		$fullname = $row['fullname'];
		$gender = $row['gender'];
		$city = $row['city'];
		$college = $row['college'];
		$mobile = $row['mobile'];
		$email = $row['email'];
		$active = $row['active'];
		$resetToken = $row['resetToken'];
		$resetComplete = $row['resetComplete'];
		$reg_date = $row['reg_date'];
		// $txnid = $row['txnid'];
		// $status = $row['status'];
		// $amount = $row['amount'];
		// $pay_type = $row['pay_type'];
		// $pay_date = $row['pay_date'];
		// $pay_through = $row['pay_through'];
		// $ambassador_email = $row['ambassador_email'];

		return array("memberID" => "$memberID", 
			"ren_id" => "$ren_id", 
			"fullname" => "$fullname",
			"gender" => "$gender",
			 "city" => "$city",
			 "college" => "$college", 
			 "mobile" => "$mobile",
			 "email" => "$email",
			 "active" => "$active",
			 "resetToken" => "$resetToken",
			 "resetComplete" => "$resetComplete",
			 "reg_date" => "$reg_date");	
			 // "txnid" => "$txnid",
			 // "status" => "$status",
			 // "amount" => "$amount",
			 // "pay_type" => "$pay_type",
			 // "pay_date" => "$pay_date",
			 // "pay_through" => "$pay_through",
			 // "ambassador_email" => "$ambassador_email");

	}
	public function getUserDataUsingID($memberID)
	{
		$row = $this->get_user_hash_using_ID($memberID);
		$memberID = $row['memberID'];
		$fullname = $row['fullname'];
		$gender = $row['gender'];
		$city = $row['city'];
		$college = $row['college'];
		$mobile = $row['mobile'];
		$email = $row['email'];
		$reg_date = $row['reg_date'];

		return array("memberID" => "$memberID", "fullname" => "$fullname","gender" => "$gender", "city" => "$city","college" => "$college", "mobile" => "$mobile","email" => "$email","reg_date" => "$reg_date");

	}
		public function getAmbassadorData($email)
	{
		$row = $this->get_ambassador_hash($email);
		$aid = $row['aid'];
		$email = $row['email'];
		$amt_collected = $row['amt_collected'];
		$total_reg = $row['total_reg'];
		$college_id = $row['college_id'];
		$active = $row['active'];
		

		return array("aid" => "$aid", "email" => "$email","amt_collected" => "$amt_collected", "total_reg" => "$total_reg","college_id" => "$college_id", "active" => "$active");

	}
	public function getUserCountForAmbassador($email,$college)
	{
		$stmtr = $this->_db->prepare('SELECT * FROM members WHERE  college = :college AND active = "Yes" ');
		$stmtr->execute(array(
			':college' => $college
			));

		$stmtr->fetch();
		//$stmt->store_result();
        $total_signups=$stmtr->rowCount();

		$stmt = $this->_db->prepare('SELECT * FROM members WHERE status = "success" AND college = :college AND  ambassador_email=:email AND pay_type="offline" AND pay_through = "ambassador" AND active = "Yes" ');
		$stmt->execute(array(
			':email' => $email,
			':college' => $college
			));

		$stmt->fetch();
		//$stmt->store_result();
        $total_reg=$stmt->rowCount();
        
        $stmtt = $this->_db->prepare('SELECT * FROM members WHERE college = :college AND ambassador_email IS NULL AND (status IS NULL OR status = "failure") AND active = "Yes" ');
		$stmtt->execute(array(':college' => $college));

		$stmtt->fetch();
		//$stmtt->store_result();
        $total_unreg=$stmtt->rowCount();

		return array("total_signups" => "$total_signups", "total_reg" => "$total_reg", "total_unreg" => "$total_unreg");

	}
	public function getUserCountTotalRegForAmbassador($email,$college)
	{
		$stmt = $this->_db->prepare('SELECT * FROM members WHERE status = "success" AND college = :college AND  ambassador_email=:email AND pay_type="offline" AND pay_through = "ambassador" AND active = "Yes" ');
		$stmt->execute(array(
			':email' => $email,
			':college' => $college
			));
		return $stmt;
	}
	public function getUserCountTotalUnregForAmbassador($college)
	{
		$stmtt = $this->_db->prepare('SELECT * FROM members WHERE college = :college AND ambassador_email IS NULL AND (status IS NULL OR status = "failure") AND active = "Yes" ');
		$stmtt->execute(array(':college' => $college));

		return $stmtt;
	}
	public function check_user_verification($email)
	{
		$row = $this->get_user_verified_data($email);
		
		if(isset($row['active']))
		{
			$active = $row['active'];
			if($active == "Yes")
			{
				return array("reg_status"=>"active");
			}
			
			else
			{
				return array("reg_status"=>"inactive");
			}
		}
		else
		{
			return array("reg_status"=>"doesnotexist");
		}
	}

		public function getUserToCollectFeeForAmbassador($email,$college)
		{
			$stmtt = $this->_db->prepare('SELECT * FROM members WHERE email = :email AND college = :college AND (status IS NULL OR status = "failure") AND active = "Yes" ');
		$stmtt->execute(array(
			':college' => $college,
			':email' => $email
			));

		return $stmtt;
		
}

		public function is_ambassador($email)
	{
		$row = $this->get_ambassador_hash($email);
		$aid = $row['aid'];
		$email = $row['email'];
		$amt_collected = $row['amt_collected'];
		$total_reg = $row['total_reg'];
		$college_id = $row['college_id'];
		$active = $row['active'];
		if(isset($row['active']) AND $active == "Yes")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function logout(){
		session_destroy();
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}
	public function is_paid($email){
		$row = $this->get_user_hash($email);
		//$status = $row['status'];
		$college = $row['college'];
		// if($status == "success" OR $college == "MNNIT")
		// {
		// 	return true;
		// }else
		// {
		// 	return false;
		// }
	}

	public function if_allahabad($college)
	{
		$stmtt = $this->_db->prepare('SELECT * FROM cities_n_colleges WHERE college = :college AND city = "Allahabad" ');
		$stmtt->execute(array(':college' => $college));

		$stmtt->fetch();
		//$stmtt->store_result();
        $total_rows=$stmtt->rowCount();

        if($total_rows >= 1)
        {
        	return true;
        }
        else{
        	return false;
        }
	}

	public function get_ticket_data($email)
	{

		$stmtt = $this->_db->prepare('SELECT * FROM tickets WHERE email = :email');
		$stmtt->execute(array(':email' => $email));

		$row = $stmtt->fetch();
		//$stmtt->store_result();
        $row_count=$stmtt->rowCount();

        $tid = $row['tid'];
		$email = $row['email'];
		$qr_msg = $row['qr_msg'];
		$qr_id = $row['qr_id'];
		$qr_created = $row['qr_created'];
		$pdf_id = $row['pdf_id'];
		$pdf_created = $row['pdf_created'];
		$date_created = $row['date_created'];
		$attended = $row['attended'];

		return array("row_count" => "$row_count","tid" => "$tid", "email" => "$email","qr_msg" => "$qr_msg", "qr_id" => "$qr_id","qr_created" => "$qr_created", "pdf_id" => "$pdf_id", "pdf_created" => "$pdf_created", "date_created" => "$date_created", "attended" => "$attended");

	}

	public function if_ticket_exists($email)
	{
		$stmtt = $this->_db->prepare('SELECT * FROM tickets WHERE email = :email ');
		$stmtt->execute(array(':email' => $email));

		$row = $stmtt->fetch();
		//$stmtt->store_result();
        $total_rows=$stmtt->rowCount();

        if($row['pdf_created']=="Yes")
        {
        	return true;
        }
        else{
        	return false;
        }
	}

public function getCollegeId($college)
	{
		$stmtt = $this->_db->prepare('SELECT * FROM cities_n_colleges WHERE college = :college');
		$stmtt->execute(array(':college' => $college));
		$row = $stmtt->fetch();
		

        $college_id = $row['uid'];
		return array("college_id" => "$college_id");
	}

public function getAmbassadorEmails($college_id)
	{
		$stmtt = $this->_db->prepare('SELECT * FROM campus_ambassador WHERE college_id = :college_id AND active = "Yes" ');
		$stmtt->execute(array(':college_id' => $college_id));

		return $stmtt;
	}

	public function getAllUserDataForAdmin()
	{
		$stmtt = $this->_db->prepare('SELECT * FROM members');
		$stmtt->execute();

		return $stmtt;
	}
	public function getAllUserDataForAdminTest()
	{
		$stmtt = $this->_db->prepare('SELECT * FROM members WHERE college = "GLA University Mathura" AND status = "success"');
		$stmtt->execute();

		return $stmtt;
	}
public function getAllUserDataForAdminCollegeCityWise($college,$city)
	{
		$stmtt = $this->_db->prepare('SELECT * FROM members WHERE college = :college AND city = :city');
		$stmtt->execute(array(
			':college' => $college,
			':city' => $city
			));

		return $stmtt;
	}


}


?>
