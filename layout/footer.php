<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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