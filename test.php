<!-- <p>You will be redirected in <span id="counter">10</span> second(s).</p>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        location.href = 'login.php';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);
</script> -->
<?php

$amt = 500;
$am = "$amt rahul";
echo $am;
?>