<!DOCTYPE html>
<html lang="en">
<head>
  <title>All info</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Header Script
    =============================================================== -->
      
    <!-- Modernizr JS -->
    <script src="js/jquery.js"></script>

      <script type="text/javascript">
/*
document.addEventListener('contextmenu',function(e){
  e.preventDefault();
});
document.onkeydown = function(e) {
if(event.keyCode == 123) {
return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
return false;
}
if(e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)){
return false;
}
}*/    </script>
</head>
<body>

<div class="container">
<?php require('includes/config.php'); 
$adata = "";
if (isset($_GET['college']) AND isset($_GET['city'])  ) {
  $college = mysql_real_escape_string($_GET['college']);
  $city = mysql_real_escape_string($_GET['city']);
  if(empty($city) OR empty($college))
  {
    echo '<h3>All user data report.</h3>';
    $adata = $user->getAllUserDataForAdmin();
  }
  else{
     echo '<h3>All user data report for '.$college.' '.$city.'.</h3>';
     $college_id_data = $user->getCollegeId($college);
    $college_id = $college_id_data['college_id'];
    ?>
    <h4>Campus Ambassador Contact Details.</h4>
    <table class="table">
    <thead>
      <tr>
        <th>SN.</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Reg_count</th>
        <th>Collection</th>
      </tr>
    </thead>
    <tbody>
    <?php

     $adata = $user->getAmbassadorEmails($college_id);
            $sn=0;
            while($row = $adata->fetch())
            {
              $sn++;
              $email = $row['email'];
             $reg_count = $row['total_reg'];
             $amt_collected = $row['amt_collected'];
              $data = $user->getUserData($email);
              //$memberID = $data['memberID'];
              $fullname = $data['fullname'];
              //$gender = $data['gender'];
              //$city = $data['city'];
              //$college = $data['college'];
              $mobile = $data['mobile'];
              $email = $data['email'];

              /*$reg_date = $data['reg_date'];
              $ren_id = $data['ren_id'];
              $status = $data['status'];
              $amount_paid = $data['amount'];
              $txnid = $data['txnid'];*/

              //echo $name;
            
              ?>
         
              <tr>
                <td><?php echo $sn; ?></td>
                <td><?php echo $fullname; ?></td>
                 <td><?php echo $mobile; ?></td>
                  <td><?php echo $email; ?></td>
                <td><?php echo $reg_count; ?></td>
                <td><?php echo "Rs ".$amt_collected; ?></td>
              </tr>

              <?php
            }
            ?>


    </tbody>
  </table>
  <br>
  <?php
    $adata = $user->getAllUserDataForAdminCollegeCityWise($college,$city);
  }
  

}
else
{
  $adata = $user->getAllUserDataForAdminTest();
}


?>

<table class="table table-bordered">
    <thead>
      <tr>
        <!--<th>SN.</th> -->
       <!-- <th>memberID</th>
        <th>ren_id</th>-->
        <th>fullname</th> 
        <!-- <th>gender</th>
        <th>city</th> 
         <th>college</th>
        <th>mobile</th>  -->
        <!--<th>email</th>-->
        <!-- <th>active</th>
        <th>reg_date</th>
        <th>txnid</th>
        <th>status</th>
        <th>amount</th>
        <th>pay_type</th>
        <th>pay_date</th>
        <th>pay_through</th> 
        <th>ambassador_email</th> -->

      </tr>
    </thead>
    <tbody>
    <?php

     //$adata = $user->getAllUserDataForAdmin();
            $sn=0;
            while($row = $adata->fetch())
            {
              
              
				$memberID = $row['memberID'];
				$ren_id = $row['ren_id'];
				$fullname = $row['fullname'];
				$gender = $row['gender'];
				$city = $row['city'];
				$college = $row['college'];
				$mobile = $row['mobile'];
				$email = $row['email'];
				$active = $row['active'];
				
				$reg_date = $row['reg_date'];
				$txnid = $row['txnid'];
				$status = $row['status'];
				$amount = $row['amount'];
				$pay_type = $row['pay_type'];
				$pay_date = $row['pay_date'];
				$pay_through = $row['pay_through'];
				$ambassador_email = $row['ambassador_email'];
          if($college == "MNNIT")
          {
            continue;
          }
          $sn++;
              ?>
         
              <tr>
             
               <!-- <td><?php echo $sn; ?></td> -->
               <!--  <td><?php echo $memberID; ?></td>
                <td><?php echo $ren_id; ?></td>-->
                   <td><?php echo $fullname; ?></td>
                 <!-- <td><?php echo $gender; ?></td>
                <td><?php echo $city; ?></td> 
                  <td><?php echo $college; ?></td>
                  <td><?php echo $mobile; ?></td>  -->
                  <!--<td><?php 
                 
                  echo $email; ?></td>-->
                <!-- <td><?php echo $active; ?></td>
                 <td><?php echo $reg_date; ?></td>
                  <td><?php echo $txnid; ?></td>
                  <td><?php echo $status; ?></td>
                <td><?php echo $amount; ?></td>
                 <td><?php echo $pay_type; ?></td>
                  <td><?php echo $pay_date; ?></td>
                  <td><?php echo $pay_through; ?></td> 
                <td><?php echo $ambassador_email; ?></td> -->
                
                
                
              </tr>

              <?php
          }
            
            ?>


    </tbody>
  </table>

</div>

</body>
</html>