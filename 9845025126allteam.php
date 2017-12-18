<!DOCTYPE html>
<html lang="en">
<head>
  <title>All team info</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
    
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 5px;
}

hr {
    border: none;
    height: 2px;
    color: #333; 
    background-color: #333;
}
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<?php require('includes/config.php');
      require('function.php');
      error_reporting(0);
      $con=con();
      $query = "SELECT team_id FROM `team`";
      $result=$con->query($query);
      $array=Array();
      while($row=$result->fetch_assoc())
      {
          $array[]=$row['team_id'];

      }
      $c=1;
      for($i=0; $i < $result->num_rows ;$i++)
      {   

          $f=$i-1;
          if($array[$i]==$array[$f])
          {
              continue;
          }
          $q = "SELECT team_name FROM `team` WHERE team_id='$array[$i]' ";
          $r = $con->query($q);
          $a=Array();
          while($row=$r->fetch_assoc()){
            $a[]=$row['team_name'];
          }
          ?>
          <br>
          <table>
            <tr><th>SN.</th><th width="150px">Team ID</th><th width="200px">Team Name</th></tr>
            <tr><td><?php echo "$c"; $c++ ?></td><td><?php echo "$array[$i]"; ?></td><td><?php echo "$a[0]"; ?></td></tr>
          </table>

          <?php
          $d=1;
          $qq="SELECT member1id FROM team WHERE team_id='$array[$i]' ";
          $rr=$con->query($qq);
          $arr=$rr->fetch_array();
          $an=$arr['member1id'];
          $que="SELECT * FROM members WHERE ren_id='$an' ";
          $rest = $con->query($que);
          $ar = $rest->fetch_array();
          $fullname = $ar['fullname'];
        $gender = $ar['gender'];
        $city = $ar['city'];
        $college = $ar['college'];
        $mobile = $ar['mobile'];
        $email = $ar['email'];
        // $active = $ar['active'];
        
        $reg_date = $ar['reg_date'];
        $github = $ar['github'];
        $resume = $ar['resume'];
        ?>
        <br>
        <table><tr><th>SN.</th>
          <th>Hack ID</th>
          <th>fullname</th>
          <th>gender</th>
          <th>city</th>
          <th>college</th>
          <th>mobile</th>
          <th>email</th>
          <!-- <th>active</th> -->
          <th>reg_date</th>
          <th>github</th>
          <th>resume/CV</th>
        </tr>
      <tr><td><?php echo "$d"; $d++?></td>
          <td><?php echo "$an"; ?></td>
          <td><?php echo "$fullname"; ?></td>
          <td><?php echo "$gender"; ?></td>
          <td><?php echo "$city"; ?></td>
          <td><?php echo "$college"; ?></td>
          <td><?php echo "$mobile"; ?></td>
          <td><?php echo "$email"; ?></td>
          <!-- <th>active</th> -->
          <td><?php echo "$reg_date"; ?></td>
          <td><?php echo "$github"; ?></td>
          <td><?php echo "$resume"; ?></td>
        </tr>
        <?php
        $quer="SELECT member2id FROM team WHERE team_id='$array[$i]' ";
        $resul=$con->query($quer);
        $storeArray = Array();
         while ($row = $resul->fetch_assoc()) {
              $storeArray[]=$row["member2id"];  
         }

         for ($j=0; $j < $resul->num_rows; $j++) 
          { 
             $query_name="SELECT * FROM `members` WHERE ren_id='$storeArray[$j]' ";
             $name_result=$con->query($query_name);
             $arr_name = $name_result->fetch_array();
             $fullname1 = $arr_name['fullname'];
        $gender1 = $arr_name['gender'];
        $city1 = $arr_name['city'];
        $college1 = $arr_name['college'];
        $mobile1 = $arr_name['mobile'];
        $email1 = $arr_name['email'];
        // $active = $ar['active'];
        
        $reg_date1 = $arr_name['reg_date'];
        $github1 = $arr_name['github'];
        $resume1 = $arr_name['resume'];

        ?>
        <tr><td><?php echo "$d"; $d++?></td>
          <td><?php echo "$storeArray[$j]"; ?></td>
          <td><?php echo "$fullname1"; ?></td>
          <td><?php echo "$gender1"; ?></td>
          <td><?php echo "$city1"; ?></td>
          <td><?php echo "$college1"; ?></td>
          <td><?php echo "$mobile1"; ?></td>
          <td><?php echo "$email1"; ?></td>
          <!-- <th>active</th> -->
          <td><?php echo "$reg_date1"; ?></td>
          <td><?php echo "$github1"; ?></td>
          <td><?php echo "$resume1"; ?></td>
        </tr>


        <?php


      }
      ?></table><br><hr/><?php

      }



?>


</div>

</body>
</html>