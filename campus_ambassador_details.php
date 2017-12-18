<?php
error_reporting(0);
require('includes/config.php'); 
 require_once 'hashconfig.php';
 $title = 'Campus  Ambassador details';

include('header.php');
 if(!$user->is_logged_in()){ 
	header('Location: memberpage.php');
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
    $ren_id = $data['ren_id'];
    $status = $data['status'];
    $amount_paid = $data['amount'];
    $txnid = $data['txnid'];


    $college_id_data = $user->getCollegeId($college);
    $college_id = $college_id_data['college_id'];
    ?>
    <div class="container">

  <div class="row">
  <center><b style="font-size: 30px;">Campus ambassador contacts</b><br>
   <b style="font-size: 20px;"><?php echo $college;?>&nbsp;&nbsp; &nbsp;<a href='memberpage.php'><button align="right" type="button" class="btn btn-success">Back to dashboard</button></a></b>
   </center>
 <div style="margin-top:5px;">
<b>Read Carefully before proceeding to offline payment: </b>
<ul class="list-group" >
  <li  class=""><b>1.</b> Always take your receipt while making offline payment through ambassador.</li>
  <li class=""><b>2.</b> Ask  campus ambassador to do payment on the portal (i.e. update your data on our website) in front of you and do cross check the amount.</li>
  <li class=""><b>3.</b> After successfull payment through ambassador we will send an email to you which will contain the payment details. Do cross check the amount mention in the email with the receipt amount.</li>
 <li class=""><b>4. Payment receipt is compulsory to attend all the events including the workshops.</b></li>
</ul>

</div>
<br>
      <div class="col-xs-12 col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1 ">
    <center>
     
    
<table class="table">
    <thead>
      <tr>
        <th>SN.</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
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
                
                
              </tr>

              <?php

            }
            ?>

            <?php if($college == "Sam Higginbottom University of Agriculture,Technology and Sciences"){
              ?>
             <tr>
                <td>3</td>
                <td>MERIL JOHN</td>
                 <td>8419057609</td>
                  <td>Meril.john78@gmail.com</td>
                
                
              </tr>
              <?php
            }
            ?>
    </tbody>
  </table>
  <br><br>
       </center> 
       <p><b>we are updating more campus ambassador details soon. To become campus ambassador drop a mail to <a href="mailto:renaissance@mnnit.ac.in">renaissance@mnnit.ac.in</a> with all your details</b></p>
      </div>
      </div>
      </div>
      <br>
<?php 
//include header template
//require('layout/footer.php'); 
include('footer.php');
?>
