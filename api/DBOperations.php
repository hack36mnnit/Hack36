<?php
define('DIR','http://register.ecellmnnit.in/');
if (!defined('PASSWORD_BCRYPT')) {
        define('PASSWORD_BCRYPT', 1);
        define('PASSWORD_DEFAULT', PASSWORD_BCRYPT);
}
date_default_timezone_set('Asia/Calcutta');
class DBOperations{

	 private $host = '127.0.0.1';
	 private $user = 'root';
	 private $db = 'renaissance17';
	 private $pass = '';
	 private $conn;

public function __construct() {

	$this -> conn = new PDO("mysql:host=".$this -> host.";dbname=".$this -> db, $this -> user, $this -> pass);

}


 public function insertData($name, $gender, $city, $college, $mobile, $email, $password){

 	//$unique_id = uniqid('', true);
    //$hash = $this->getHash($password);
    $hash = $this->password_hash($password, PASSWORD_BCRYPT);
    //$encrypted_password = $hash["encrypted"];
    $encrypted_password = $hash;
	//$salt = $hash["salt"];
    $activasion = md5(uniqid(rand(),true));
    
    $reg_date = date('Y/m/d H:i:s');
 	$sql = 'INSERT INTO members SET fullname =:name,gender =:gender,city =:city,college =:college,mobile =:mobile,
    email =:email,password =:encrypted_password, active=:active, reg_date = :reg_date';

 	$query = $this ->conn ->prepare($sql);
 	$query->execute(array(':name' => $name, ':gender' => $gender, ':city' => $city,':college' => $college,':mobile' => $mobile,
     ':email' => $email,':encrypted_password' => $encrypted_password,':active' => $activasion,':reg_date'=>$reg_date));

    if ($query) {
                        //send email
        $id = $this->conn->lastInsertId('memberID');

        $verify_link = "".DIR."activate.php?x=$id&y=$activasion";
            $to = $email;
            $subject = "Verify your email to complete your registration.";
            $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
     <td align="center" style="padding: 10px 0 10px 0;">
         Please ignore if this email is not related to you!<br>
         NOTE: In case of any queries please contact our team immediately at <a href="mailto:renaissance@mnnit.ac.in" style="text-decoration:none;color:teal">renaissance@mnnit.ac.in</a>
     </td>
 </tr>
 <tr bgcolor="#c8e0f4">
   <td style="padding: 20px 0 10px 20px;">
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
            $altbody = 'Thank you for registering with us. Click the link to activate your account.';
            
            include("send-mail.php"); 
            //mail script ends here...
            
            
            
        return true;

    } else {

        return false;

    }
 }

 public function sentForgotLink($email){


    //create the activasion code
        $token = md5(uniqid(rand(),true));

        try {

            $stmt = $this->conn->prepare("UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email");
            $stmt->execute(array(
                ':email' => $email,
                ':token' => $token
            ));
            if ($stmt) {
                //send email
                $reset_link = "".DIR."resetPassword.php?key=$token";
                $name = 'Password Reset';
                $to = $email;
                $subject = "Password Reset";
                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Reset your password</title>
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
    Dear participant,
   </td>
  </tr>
  <tr>
   <td style="padding: 20px 0 30px 0;">
    Someone requested that the password be reset.
    If this was a mistake, just ignore this email and nothing will happen.
To reset your password, click the below link:
   </td>
  </tr>
    <tr>
   <td align="center" style="padding: 10px 0 0 0;">
       <a href='.$reset_link.' style="text-decoration:none;padding:10px 20px;background-color:#4b9e60;color:white;border-radius:5px">Click here to reset your password</a>
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
     <td align="center" style="padding: 10px 0 10px 0;">
         Please ignore if this email is not related to you!<br>
         NOTE: In case of any queries please contact our team immediately at <a href="mailto:renaissance@mnnit.ac.in" style="text-decoration:none;color:teal">renaissance@mnnit.ac.in</a>
     </td>
 </tr>
 <tr bgcolor="#c8e0f4">
   <td style="padding: 20px 0 10px 20px;">
    Regards<br>Team
     <a href="http://renaissance.mnnit.ac.in" target="_blank" style="text-decoration:none;color:teal"> Renaissance 2017</a><br>
    MNNIT Allahabad, 211004, UP, India<br>
    <a href="http://renaissance.mnnit.ac.in" target="_blank" style="text-decoration:none;color:teal">www.renaissance.mnnit.ac.in</a>
   </td>
  </tr>
</table>
 </table>
</body>
</html>
            ';
                $altbody = 'Click this link to reset your password.';
                
                include("send-mail.php"); 
                return true;
            }
            else
            {
                return false;
            }
        //else catch the exception and show the error.
        } catch(PDOException $e) {
            $error[] = $e->getMessage();
        }

 }

 /*public function checkLogin($email, $password) {

    $sql = 'SELECT * FROM members WHERE email = :email';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array(':email' => $email));
    $data = $query -> fetchObject();
    $salt = $data -> salt;
    $db_encrypted_password = $data -> encrypted_password;

    if ($this -> verifyHash($password.$salt,$db_encrypted_password) ) {


        $user["name"] = $data -> name;
        $user["email"] = $data -> email;
        $user["unique_id"] = $data -> unique_id;
        return $user;

    } else {

        return false;
    }

 }*/

 public function checkLogin($email,$password){

        $row = $this->get_user_hash($email);

        if($this->password_verify($password,$row['password']) == 1){

             $user["memberID"]= $row['memberID'];
        $user["ren_id"] = $row['ren_id'];
        $user["fullname"] = $row['fullname'];
        $user["gender"] = $row['gender'];
        $user["city"] = $row['city'];
        $user["college"] = $row['college'];
        $user["mobile"] = $row['mobile'];
        $user["email"] = $row['email'];
        $user["active"] = $row['active'];
        $user["resetToken"] = $row['resetToken'];
        $user["resetComplete"] = $row['resetComplete'];
        $user["reg_date"] = $row['reg_date'];
        $user["txnid"] = $row['txnid'];
        $user["status"] = $row['status'];
        $user["amount"] = $row['amount'];
        $user["pay_type"] = $row['pay_type'];
        $user["pay_date"]= $row['pay_date'];
        $user["pay_through"] = $row['pay_through'];
        $user["ambassador_email"] = $row['ambassador_email'];
            return $user;

        } else {

            return false;
        }
    }

     public function fetchuserprofile($email){

        $row = $this->get_user_hash($email);


            $user["memberID"]= $row['memberID'];
        $user["ren_id"] = $row['ren_id'];
        $user["fullname"] = $row['fullname'];
        $user["gender"] = $row['gender'];
        $user["city"] = $row['city'];
        $user["college"] = $row['college'];
        $user["mobile"] = $row['mobile'];
        $user["email"] = $row['email'];
        $user["active"] = $row['active'];
        $user["resetToken"] = $row['resetToken'];
        $user["resetComplete"] = $row['resetComplete'];
        $user["reg_date"] = $row['reg_date'];
        $user["txnid"] = $row['txnid'];
        $user["status"] = $row['status'];
        $user["amount"] = $row['amount'];
        $user["pay_type"] = $row['pay_type'];
        $user["pay_date"]= $row['pay_date'];
        $user["pay_through"] = $row['pay_through'];
        $user["ambassador_email"] = $row['ambassador_email'];
            return $user;

        
    }


 public function changePassword($email, $password){


    
    $hash = $this->password_hash($password, PASSWORD_BCRYPT);
    
    $encrypted_password = $hash;
    

    $sql = 'UPDATE members SET password = :encrypted_password WHERE email = :email';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array(':email' => $email, ':encrypted_password' => $encrypted_password));

    if ($query) {
        
        return true;

    } else {

        return false;

    }

 }

 public function checkUserExist($email){

    $sql = 'SELECT COUNT(*) from members WHERE email =:email';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array('email' => $email));

    if($query){

        $row_count = $query -> fetchColumn();

        if ($row_count == 0){

            return false;

        } else {

            return true;

        }
    } else {

        return false;
    }
 }

/* public function getHash($password) {

     $salt = sha1(rand());
     $salt = substr($salt, 0, 10);
     $encrypted = password_hash($password.$salt, PASSWORD_DEFAULT);
     $hash = array("salt" => $salt, "encrypted" => $encrypted);

     return $hash;

}*/




/*
public function verifyHash($password, $hash) {

    return password_verify ($password, $hash);
}*/



function password_hash($password, $algo, array $options = array()) {
        if (!function_exists('crypt')) {
            trigger_error("Crypt must be loaded for password_hash to function", E_USER_WARNING);
            return null;
        }
        if (!is_string($password)) {
            trigger_error("password_hash(): Password must be a string", E_USER_WARNING);
            return null;
        }
        if (!is_int($algo)) {
            trigger_error("password_hash() expects parameter 2 to be long, " . gettype($algo) . " given", E_USER_WARNING);
            return null;
        }
        switch ($algo) {
            case PASSWORD_BCRYPT :
                // Note that this is a C constant, but not exposed to PHP, so we don't define it here.
                $cost = 10;
                if (isset($options['cost'])) {
                    $cost = $options['cost'];
                    if ($cost < 4 || $cost > 31) {
                        trigger_error(sprintf("password_hash(): Invalid bcrypt cost parameter specified: %d", $cost), E_USER_WARNING);
                        return null;
                    }
                }
                // The length of salt to generate
                $raw_salt_len = 16;
                // The length required in the final serialization
                $required_salt_len = 22;
                $hash_format = sprintf("$2y$%02d$", $cost);
                break;
            default :
                trigger_error(sprintf("password_hash(): Unknown password hashing algorithm: %s", $algo), E_USER_WARNING);
                return null;
        }
        if (isset($options['salt'])) {
            switch (gettype($options['salt'])) {
                case 'NULL' :
                case 'boolean' :
                case 'integer' :
                case 'double' :
                case 'string' :
                    $salt = (string)$options['salt'];
                    break;
                case 'object' :
                    if (method_exists($options['salt'], '__tostring')) {
                        $salt = (string)$options['salt'];
                        break;
                    }
                case 'array' :
                case 'resource' :
                default :
                    trigger_error('password_hash(): Non-string salt parameter supplied', E_USER_WARNING);
                    return null;
            }
            if (strlen($salt) < $required_salt_len) {
                trigger_error(sprintf("password_hash(): Provided salt is too short: %d expecting %d", strlen($salt), $required_salt_len), E_USER_WARNING);
                return null;
            } elseif (0 == preg_match('#^[a-zA-Z0-9./]+$#D', $salt)) {
                $salt = str_replace('+', '.', base64_encode($salt));
            }
        } else {
            $buffer = '';
            $buffer_valid = false;
            if (function_exists('mcrypt_create_iv') && !defined('PHALANGER')) {
                $buffer = mcrypt_create_iv($raw_salt_len, MCRYPT_DEV_URANDOM);
                if ($buffer) {
                    $buffer_valid = true;
                }
            }
            if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {
                $buffer = openssl_random_pseudo_bytes($raw_salt_len);
                if ($buffer) {
                    $buffer_valid = true;
                }
            }
            if (!$buffer_valid && is_readable('/dev/urandom')) {
                $f = fopen('/dev/urandom', 'r');
                $read = strlen($buffer);
                while ($read < $raw_salt_len) {
                    $buffer .= fread($f, $raw_salt_len - $read);
                    $read = strlen($buffer);
                }
                fclose($f);
                if ($read >= $raw_salt_len) {
                    $buffer_valid = true;
                }
            }
            if (!$buffer_valid || strlen($buffer) < $raw_salt_len) {
                $bl = strlen($buffer);
                for ($i = 0; $i < $raw_salt_len; $i++) {
                    if ($i < $bl) {
                        $buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
                    } else {
                        $buffer .= chr(mt_rand(0, 255));
                    }
                }
            }
            $salt = str_replace('+', '.', base64_encode($buffer));
        }
        $salt = substr($salt, 0, $required_salt_len);

        $hash = $hash_format . $salt;

        $ret = crypt($password, $hash);

        if (!is_string($ret) || strlen($ret) <= 13) {
            return false;
        }

        return $ret;
    }


    

    private function get_user_hash($email){

        try {
            $stmt = $this->conn->prepare('SELECT * FROM members WHERE email = :email AND active="Yes" ');
            $stmt->execute(array('email' => $email));

            return $stmt->fetch();

        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage().'</p>';
        }
    }


    public function password_verify($password, $hash) {
        if (!function_exists('crypt')) {
            trigger_error("Crypt must be loaded for password_verify to function", E_USER_WARNING);
            return false;
        }
        $ret = crypt($password, $hash);
        if (!is_string($ret) || strlen($ret) != strlen($hash) || strlen($ret) <= 13) {
            return false;
        }

        $status = 0;
        for ($i = 0; $i < strlen($ret); $i++) {
            $status |= (ord($ret[$i]) ^ ord($hash[$i]));
        }

        return $status === 0;
    }


    function password_needs_rehash($hash, $algo, array $options = array()) {
        $info = password_get_info($hash);
        if ($info['algo'] != $algo) {
            return true;
        }
        switch ($algo) {
            case PASSWORD_BCRYPT :
                $cost = isset($options['cost']) ? $options['cost'] : 10;
                if ($cost != $info['options']['cost']) {
                    return true;
                }
                break;
        }
        return false;
    }

    function password_get_info($hash) {
        $return = array('algo' => 0, 'algoName' => 'unknown', 'options' => array(), );
        if (substr($hash, 0, 4) == '$2y$' && strlen($hash) == 60) {
            $return['algo'] = PASSWORD_BCRYPT;
            $return['algoName'] = 'bcrypt';
            list($cost) = sscanf($hash, "$2y$%d$");
            $return['options']['cost'] = $cost;
        }
        return $return;
    }

}




