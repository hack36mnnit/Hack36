<?php

require_once 'DBOperations.php';

class Functions{

private $db;

public function __construct() {

      $this -> db = new DBOperations();

}


public function registerUser($name, $gender, $city, $college, $mobile, $email, $password) {

	$db = $this -> db;

	if (!empty($name) && !empty($gender) && !empty($city)&& !empty($college)&& !empty($mobile)&& !empty($email)&& !empty($password)) {

  		if ($db -> checkUserExist($email)) {

  			$response["result"] = "failure";
  			$response["message"] = "User Already Registered !";
  			return json_encode($response);

  		} else {

  			$result = $db -> insertData($name, $gender, $city, $college, $mobile, $email, $password);

  			if ($result) {

				  $response["result"] = "success";
  				$response["message"] = "Check your email to activate your account!";
  				return json_encode($response);
  						
  			} else {

  				$response["result"] = "failure";
  				$response["message"] = "Registration Failure";
  				return json_encode($response);

  			}
  		}					
  	} else {

  		return $this -> getMsgParamNotEmpty();

  	}
}

public function forgotPassword($email) {

  $db = $this -> db;

  if (!empty($email)) {

      if ($db -> checkUserExist($email)) {
        $result = $db -> sentForgotLink($email);
        if ($result) {

          $response["result"] = "success";
          $response["message"] = "Please check your email for a reset link!";
          return json_encode($response);
              
        } else {

          $response["result"] = "failure";
          $response["message"] = "Password reset Failure";
          return json_encode($response);

        }


      } else {

        $response["result"] = "failure";
        $response["message"] = "Email is incorrect !";
        return json_encode($response);
      }         
    } else {

      return $this -> getMsgParamNotEmpty();

    }
}

public function loginUser($email, $password) {

  $db = $this -> db;

  if (!empty($email) && !empty($password)) {

    if ($db -> checkUserExist($email)) {

       $result =  $db -> checkLogin($email, $password);


       if(!$result) {

        $response["result"] = "failure";
        $response["message"] = "Invaild Login Credentials or email not verified yet";
        return json_encode($response);

       } else {

        $response["result"] = "success";
        $response["message"] = "Login Successful";
        $response["user"] = $result;
        return json_encode($response);

       }

    } else {

      $response["result"] = "failure";
      $response["message"] = "Invaild Login Credentials";
      return json_encode($response);

    }
  } else {

      return $this -> getMsgParamNotEmpty();
    }

}
public function userprofile($email) {

  $db = $this -> db;

  if (!empty($email)) {

    if ($db -> checkUserExist($email)) {

       $result =  $db -> fetchuserprofile($email);


       if(!$result) {

        $response["result"] = "failure";
        $response["message"] = "Error in fetching your details";
        return json_encode($response);

       } else {

        $response["result"] = "success";
        $response["message"] = "Profile fetched Successfullly";
        $response["user"] = $result;
        return json_encode($response);

       }

    } else {

      $response["result"] = "failure";
      $response["message"] = "Error in fetching your details";
      return json_encode($response);

    }
  } else {

      return $this -> getMsgParamNotEmpty();
    }

}

public function changePassword($email, $old_password, $new_password) {

  $db = $this -> db;

  if (!empty($email) && !empty($old_password) && !empty($new_password)) {

    if(!$db -> checkLogin($email, $old_password)){

      $response["result"] = "failure";
      $response["message"] = 'Invalid Old Password';
      return json_encode($response);

    } else {


    $result = $db -> changePassword($email, $new_password);

      if($result) {

        $response["result"] = "success";
        $response["message"] = "Password Changed Successfully";
        return json_encode($response);

      } else {

        $response["result"] = "failure";
        $response["message"] = 'Error Updating Password';
        return json_encode($response);

      }

    } 
  } else {

      return $this -> getMsgParamNotEmpty();
  }

}

public function isEmailValid($email){

  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

public function getMsgParamNotEmpty(){


  $response["result"] = "failure";
  $response["message"] = "Parameters should not be empty !";
  return json_encode($response);

}

public function getMsgInvalidParam(){

  $response["result"] = "failure";
  $response["message"] = "Invalid Parameters";
  return json_encode($response);

}

public function getMsgInvalidEmail(){

  $response["result"] = "failure";
  $response["message"] = "Invalid Email";
  return json_encode($response);

}

}
