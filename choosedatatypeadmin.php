<!DOCTYPE html>
<html lang="en">
<head>
  <title>All info</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <style type="text/css">
            body, html
            {
                margin: 0; padding: 0; height: 100%; overflow: hidden;
            }

            #content
            {
                position:absolute; left: 0; right: 0; bottom: 0; top: 0px; 
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Header Script
    =============================================================== -->
      
    <!-- Modernizr JS -->
    <script src="js/jquery.js"></script>

      <script type="text/javascript">

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
</head>
<body>

<div class="container">
<?php

error_reporting(0);
$submit = $_POST['submit'];
$city = $_POST['city'];
$college = $_POST['college'];
if($submit == "proceed")
{
  //echo "hello";
 // echo $city;
  //echo $college;
  ?>
  <div id="content">
 <iframe frameborder="0" src="alluserdataadmin.php?city=<?php echo $city; ?>&college=<?php echo $college; ?>" width="100%" height="100%" />
 </div>
 <?php
       //include('alluserdataadmin.php?city=Allahabad&college=MNNIT');
}
else
{
    if(isset($_POST))
    { 
    ?>
  <center>
  <h2>Filter your choice or leave blank for all data.</h2>
            <form method="POST" action="" style="margin-top: 50px; padding: 10px;">
             
              City
              
              <select class="form-control" id="city" name="city" value="" tabindex="3">
                <option>Select City</option>
              </select>
          
    
          <br>
            

            College
            
              <select id="college" name="college" class="form-control " disabled  value="" tabindex="4">
                <option></option>
              </select>
            <br>
            <input type="submit" name="submit" value="proceed"></input>
            </form>
            </center>
    <?php }
}
?>
</div>
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