<!DOCTYPE html>
<html lang="en" class="js">
	<head>
		<!-- Meta
		=============================================================== -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="">
		<meta name="description" http-equiv="description" content="Renaissance 2017 | March 4-5, 2017 | Renaissance - An Entrepreneurship Summit is an event by E-Cell MNNIT for aspiring and full time entrepreneurs taking ideation to implementation." />
		<!-- Favicon
		=============================================================== -->
		<link rel="icon" href="http://renaissance.mnnit.ac.in/img/logo2k16.png">

		<!-- Title
		=============================================================== -->
		<title><?php echo $title ?></title>

		<!-- Google Fonts
		=============================================================== -->
		<link href='http://fonts.googleapis.com/css?family=Lato:300italic,400italic,600italic,700italic,800italic,400,800,700,600,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,700,400' rel='stylesheet' type='text/css'>
		
		<!-- CSS
		=============================================================== -->

		<!-- Bootstrap -->
		<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
		
	

		<!-- Custom styles for this template -->
		<link href="css/style.css" rel="stylesheet">
		<link href="css/font.css" rel="stylesheet">
		<link href="css/color.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">
		    <style type="text/css">
  .payuformhead{
        display:none;
      }
  input {
    border: 0;
}
</style>
				<script type="text/javascript">
		

				function DoSubmitPayU(){
			$('#mask').css('display','block');
	
    	// document.getElementById('redirect').innerHTML = '<b>Rediredting to PayUMoney...</b>';
  document.payuForm.submit.value = 'Processing...';
  return true;
}

			var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }


 

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
}  

    </script>	
		<!-- Header Script
		=============================================================== -->
			
		<!-- Modernizr JS -->
		

    <style type="text/css">
    	#mask{
    		position: fixed;
    		top: 0;
    		left: 0;
    		width: 100%;
    		height: 100vh;
    		background-color: rgba(15,15,15,0.5);
    		z-index: 10000;
    		display: none;
    	}
    	#mask h3{
    		position: absolute;
    		top: 50%;
    		left: 50%;
    		transform: translate(-50%,-50%);
    		color: white;
    	}
    </style>

  </head>
	<body onload="submitPayuForm()">
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-91423910-1', 'auto');
  ga('send', 'pageview');

</script>
	<div id="mask">
		<h3>Please wait Redirecting to PayU Money....</h3>
	</div>
		
<?php include('./navbar.php'); ?>