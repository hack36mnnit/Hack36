
<<<<<<< HEAD
=======
		
		<!-- Footer -->
		<footer id="footer" style="background-color:#35414c">
		    <div class="row farea"  style="margin-right:0px;">
		        <div class="col-md-3 col-md-offset-0" style="margin-top:2%;float:left">
		        	<center><img style="padding-top: 5%;width:35%" src="./images/logo.png" hspace="9" ></center>
		        </div>
		    	<div class="col-md-3 col-md-offset-0" style="margin-top:2%">
		    		<center>
		    	  <div>
					<span class="glyphicon glyphicon-earphone" style="color:grey"></span><a href="tel:817-597-1936"><span style="color:white;padding:10px;font-family:Raleway">+91-817-597-1936</span></a><br><br>
		    	  </div>	
		    	  <div>
				  	<span class="glyphicon glyphicon-earphone" style="color:grey"></span><a href="tel:964-803-4543"><span style="color:white;padding:10px;font-family:Raleway">+91-964-803-4543<span></a><br><br>
				  	<!-- <img src="http://renaissance.ecellmnnit.in/images/social/phonecall.png"><span style="padding-left: 10px;">+91-790-580-4733</span>  -->
		    	   </div>
		    	   <div>
				  	<span class="glyphicon glyphicon-envelope" style="color:grey"></span><a href="mailto:hackathon@mnnit.ac.in"><span style="color:white;padding:10px;font-family:Raleway">hackathon@mnnit.ac.in</span></a><br><br>
				  	<!-- <img src="http://renaissance.ecellmnnit.in/images/social/phonecall.png"><span style="padding-left: 10px;">+91-790-580-4733</span>  -->
		    	   </div>	
		    	</center>
		    	</div>
		    	<div class="col-md-3 col-md-offset-0" style="margin-top:2%">
		    	  <div style="padding-left: 25px">
					
					<center>
		    	    <h6 style="color:#fff; font-family:Raleway" >FOLLOW US</h6>
		            <a href="https://www.facebook.com/hack36mnnit" target="_blank"><img src="./images/ecell_facebook_logo.png"></a>
				    </center>
				   </div> 
		    	</div>
		    	<div class="col-md-3 col-md-offset-0" style="margin-top:2%">
		    	  <div style="padding-left: 25px">
					
					<center>
		    	    <h6 style="color:#fff; font-family:Raleway" >MORE</h6>
		            <a href="http://www.mnnit.ac.in" target="_blank" style="color:grey; ">MNNIT Allahabad</a>
				    </center>
				   </div> 
		    	</div>
		    </div>
		    <hr style="width:85%;margin-left:7.5%;color:grey">
		    <div class="footer-area text-center" style="background-color:#35414c">
			    <p>&copy; <a href="https://www.hack36.com" target="_blank"> Hack 36 MNNIT</a> All rights reserved</p>
		    </div>
		</footer>
>>>>>>> b423413c2ac8b11b1f83c4c3be139d509b764bb5

<!-- Footer -->
<footer id="footer">
    <div class="row farea"  style="padding-top:9px;margin-right:0px;background-color:rgb(46,165,72)">
        <div class="col-md-3">
        	<img style="padding-top: 1px;" src="./images/hack36footer.png" hspace="9">
        </div>
    	<div class="col-md-3">
    	  <div style="padding-left: 25px">
    		<h6 style="color:#fff">CALL US</h6>
			<img src="./images/phonecall.png"><span style="padding-left: 10px;">+91-817-597-1936</span><br><br>
			<!-- <img src="http://renaissance.ecellmnnit.in/images/social/phonecall.png"><span style="padding-left: 10px;">+91-964-803-4543</span> -->
    	  </div>	
    	</div>
    	<div class="col-md-3">
    	  <div style="padding-left: 25px">
		  <h6 style="color:#fff"> &nbsp;</h6>
		  	<img src="./images/phonecall.png"><span style="padding-left: 10px;">+91-964-803-4543</span><br><br>
		  	<!-- <img src="http://renaissance.ecellmnnit.in/images/social/phonecall.png"><span style="padding-left: 10px;">+91-790-580-4733</span>  -->
    	   </div>	
    	</div>
    	<div class="col-md-3">
    	  <div style="padding-left: 25px">
		  	<h6 style="color:#fff">MAIL US</h6>
    		<img src="./images/email.png"><span  style="padding-left: 10px;">hackathon@mnnit.ac.in</span>
    	    <h6 style="color:#fff">FOLLOW US ON</h6>
            <a href="https://www.facebook.com/hack36mnnit" target="_blank"><img src="./images/ecell_facebook_logo.png"></a>
		    
		   </div> 
    	</div>
    </div>
    <div class="footer-area text-center">
	    <p>&copy; <a href="#" target="_blank"> Hack 36 MNNIT</a> All rights reserved</p>
    </div>
</footer>

 <!-- 1.12.4-->

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
			// window.alert("ehciidni");
		}
			//$("#college").trigger("change");
	});
});
function downloadURI(uri, name) {
  var link = document.createElement("a");
  link.download = name;
  link.href = uri;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  delete link;
}
function getticket(){
$("#mask").fadeIn();
$.ajax({
url: "create_ticket.php",
type: "GET",
success: function(html){
	$("#mask").fadeOut();//
	console.log(html);
	downloadURI(html,"ticket");
	//location.href = html;
}
});
}

</script>
</body>
</html>
