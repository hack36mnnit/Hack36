<?php

require_once 'Functions.php';

$fun = new Functions();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));

  if(isset($data -> operation)){

  	$operation = $data -> operation;

  	if(!empty($operation)){

  		if($operation == 'register'){

  			if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> fullname) 
  				&& isset($data -> user -> gender)&& isset($data -> user -> city)&& isset($data -> user -> college)&& isset($data -> user -> mobile)&& isset($data -> user -> email) && isset($data -> user -> password)){

  				$user = $data -> user;
  				$name = $user -> fullname;
  				$gender = $user -> gender;
          $city = $user -> city;
          $college = $user -> college;
          $mobile = $user -> mobile;
          $email = $user -> email;
  				$password = $user -> password;

          if ($fun -> isEmailValid($email)) {
            
            echo $fun -> registerUser($name,$gender,$city,$college,$mobile, $email, $password);

          } else {

            echo $fun -> getMsgInvalidEmail();
          }

  			} else {

  				echo $fun -> getMsgInvalidParam();

  			}

  		}else if($operation == 'forgotpassword'){

        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) 
          ){

          $user = $data -> user;
          $email = $user -> email;
          

          if ($fun -> isEmailValid($email)) {
            
            echo $fun -> forgotPassword($email);

          } else {

            echo $fun -> getMsgInvalidEmail();
          }

        } else {

          echo $fun -> getMsgInvalidParam();

        }

      }
      else if ($operation == 'login') {

        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> password)){

          $user = $data -> user;
          $email = $user -> email;
          $password = $user -> password;

          echo $fun -> loginUser($email, $password);

        } else {

          echo $fun -> getMsgInvalidParam();

        }
      } 
      else if ($operation == 'profiledetails') {

        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) ){

          $user = $data -> user;
          $email = $user -> email;
          

          echo $fun -> userprofile($email);

        } else {

          echo $fun -> getMsgInvalidParam();

        }
      } 
      else if ($operation == 'chgPass') {

        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> old_password) 
          && isset($data -> user -> new_password)){

          $user = $data -> user;
          $email = $user -> email;
          $old_password = $user -> old_password;
          $new_password = $user -> new_password;

          echo $fun -> changePassword($email, $old_password, $new_password);

        } else {

          echo $fun -> getMsgInvalidParam();

        }
      }

  	}else{

  		
  		echo $fun -> getMsgParamNotEmpty();

  	}
  } else {

  		echo $fun -> getMsgInvalidParam();

  }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET'){


  echo "Renaissance 2017 API";

}

