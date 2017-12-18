		
		<!-- Footer -->
		<footer id="footer">
		    <div class="row farea"  style="padding-top:10px;margin-right:0px;background-color:rgb(46,165,72)">
		        <div class="col-md-3">
		        	<img style="padding-top: 10px;" src="http://renaissance.ecellmnnit.in/images/renaissance_logo.png">
		        </div>
		    	<div class="col-md-3">
		    	  <div style="padding-left: 25px">
		    		<h6 style="color:#fff">CALL US</h6>
					<img src="http://renaissance.ecellmnnit.in/images/social/phonecall.png"><span style="padding-left: 10px;">+91-770-606-7073</span><br><br>
					<img src="http://renaissance.ecellmnnit.in/images/social/phonecall.png"><span style="padding-left: 10px;">+91-895-354-6269</span>
		    	  </div>	
		    	</div>
		    	<div class="col-md-3">
		    	  <div style="padding-left: 25px">
				  <h6 style="color:#fff"> &nbsp;</h6>
				  	<img src="http://renaissance.ecellmnnit.in/images/social/phonecall.png"><span style="padding-left: 10px;">+91-917-090-1053</span><br><br>
				  	<img src="http://renaissance.ecellmnnit.in/images/social/phonecall.png"><span style="padding-left: 10px;">+91-790-580-4733</span> 
		    	   </div>	
		    	</div>
		    	<div class="col-md-3">
		    	  <div style="padding-left: 25px">
				  	<h6 style="color:#fff">MAIL US</h6>
		    		<img src="http://renaissance.ecellmnnit.in/images/social/email.png"><span  style="padding-left: 10px;">renaissance@mnnit.ac.in</span>
		    	    <h6 style="color:#fff">FOLLOW US ON</h6>
		            <a href="https://www.facebook.com/mnnitecell" target="_blank"><img src="http://renaissance.ecellmnnit.in/images/social/ecell_facebook_logo.png"></a>
				    <a href="https://www.linkedin.com/in/e-cell-mnnit-210878b4/" target="_blank"><img  src="http://renaissance.ecellmnnit.in/images/social/ecell_linkedin_logo.png"></a>
				    <a href="https://twitter.com/ecellmnnit" target="_blank"><img src="http://renaissance.ecellmnnit.in/images/social/ecell_twitter_logo.png"></a>
				    <a href="https://www.instagram.com/ecellmnnit/" target="_blank"><img src="http://renaissance.ecellmnnit.in/images/social/ecell_instagram_logo.png"></a>
				   </div> 
		    	</div>
		    </div>
		    <div class="footer-area text-center">
			    <p>&copy; <a href="#" target="_blank"> RENAISSANCE</a> 2017 All rights reserved</p>
		    </div>
		</footer>
		
		<script src="js/jquery.js"></script>
		<!-- Bootstrap -->
		
		


        <!-- Custom -->
		<!-- <script src="js/script.js"></script>
		<script src="js/custom.js"></script> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script type="text/javascript">
	var co;
	
$(document).ready(function(){
			$("#city").load('getCities.php');
		});
		$("#city").change(function(){
			$("#college").load('getColleges.php?city='+encodeURI($("#city").val()),function(data){
				if (data.trim()=="") {
					$("#college").attr("disabled","disabled");
				}
				else {
					$("#college").removeAttr("disabled");
				}
					//$("#college").trigger("change");
			});
		});
		


	</script>
	</body>
</html>
