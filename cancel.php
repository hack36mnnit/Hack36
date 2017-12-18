<?php
error_reporting(0);
require('./includes/config.php'); 
$title = 'Payment Cancelled';
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


 echo "<br><p>It seems that your transaction was cancelled.</p><br>";
 //echo "<h4>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</h4>";
          

?>
<!--Please enter your website homepagge URL -->
<p><a href="payment.php"> Try Again</a></p><br>
<p><a href="memberpage.php">Go to members page</a></p><br>
<p>You will be redirected to members page in <span id="counter">30</span> second(s).</p><br>
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
    
