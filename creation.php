<?php
header('X-Frame-Options: SAMEORIGIN');
header("X-XSS-Protection: 1; mode=block");
header('X-Content-Type-Options: nosniff');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="stylesheet" href="./lib/bootstrap/css/bootstrap.min.css">
  <script src="./js/jquery.js"></script>
</head>

  <!-- <div class="container"> -->   
     <!--   <div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">  -->                  
           

                <div style="padding-top:15px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                            <?php
                        require('function.php');
                        require('includes/config.php');
                        $email = $_SESSION['email'];
                        $data = $user->getUserData($email);
                        $ren_id = $data['ren_id'];
                        $myname = $data['fullname'];
                        $con = con();
                        $query = "SELECT * FROM team T1 where T1.member1id='$ren_id' ";
                        $result = $con->query($query);

                        if($result->num_rows>0){
                            // echo "You are already in a team";
                            $tea="SELECT team_id,team_name FROM team where member1id='$ren_id' ";
                            $tea_result = $con->query($tea);
                            $arr = $tea_result->fetch_array();
                            $teamm=$arr["team_id"];
                            $teamnamee=$arr["team_name"];
                            ?>
                            <!-- 
                            echo "<h3><u>Team name</u>: <strong>$teamnamee</strong></h3>";
                            echo "<h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Team ID </u>: <strong>$teamm</strong></h4><hr>";
 -->
                            <table class="table">
                                <tbody> 
                                    <th>Team name</th>
                        <td><?php echo $teamnamee; ?></td>
                        
                      </tr>
                      <tr>
                        <th>Team ID</th>
                        <td><?php echo $teamm; ?></td>
                        
                      </tr>                        
                      </tr>
                            </tbody>
                                <?php
                            $team_query = "SELECT `member2id` FROM `team` WHERE team_id='$teamm'";
                            $all_result = $con->query($team_query);
                            ?>
                            <!-- echo "<h4><u>Member 1</u> : $myname</h4>";
                                echo "<h5>&nbsp&nbsp&nbsp<u>Hack 36 ID </u>: <strong>$ren_id</strong></h5>&nbsp";
                                echo "\r\n"; -->
                                <tr>
                        <th>Member 1</th>
                        <td><?php echo $myname; ?></td>
                        
                      </tr>
                      <tr>
                        <th>Hack ID</th>
                        <td><?php echo $ren_id; ?></td>
                        
                      </tr>
                            <?php    
                            $storeArray = Array();
                            while ($row = $all_result->fetch_assoc()) {
                                        $storeArray[]=$row["member2id"];  
                                }
                            for ($i=0; $i < $all_result->num_rows; $i++) 
                            { 
                                $query_name="SELECT `fullname` FROM `members` WHERE ren_id='$storeArray[$i]' ";
                                $name_result=$con->query($query_name);
                                $arr_name = $name_result->fetch_array();
                                $namee=$arr_name["fullname"];
                                $c=$i+2;
                                ?>

                                <!-- echo "<h4><u>Member $c</u> : $namee</h4>";
                                echo "<h5>&nbsp&nbsp&nbsp<u>Hack 36 ID </u>: <strong>$storeArray[$i]</strong></h5>&nbsp";
                                echo "\r\n"; -->
                                <tr>
                        <th>Member <?php echo $c; ?></th>
                        <td><?php echo $namee; ?></td>
                        
                      </tr>
                      <tr>
                        <th>Hack ID</th>
                        <td><?php echo $storeArray[$i]; ?></td>
                        
                      </tr>
                            <?php
                            }          
                            ?>
                        </table>
                            <form id="deletion" onsubmit="return confirm('Do you really want to delete the team?');" class="form-horizontal" role="form" action="delete_team.php" method="post">
                                <div class="col-sm-12 controls">
                                    <!-- <input type="hidden" name="team_id" value="<?php $teamm; ?>"> -->
                                    <input id="team_id" type="hidden" class="form-control" name="team_id" value="<?php echo "$teamm"; ?>">
                               <center>
                            
                     <button type="submit" class="btn btn-danger btn" onclick="getConfirmation();">Delete team</button>
                               </center>
                        </div>

                            </form>

                            <?php


                            die();
                        }

                        $query1 = "SELECT * FROM team T2 where T2.member2id='$ren_id' ";
                        $result1 = $con->query($query1);

                        if($result1->num_rows>0){
                            // echo "You are already in a team";
                            $tea="SELECT team_id, team_name FROM team where member2id='$ren_id' ";
                            $tea_result = $con->query($tea);
                            $arr = $tea_result->fetch_array();
                            $teamm=$arr["team_id"];
                            $teamnamee=$arr["team_name"];?>

                            <table class="table">
                                <tbody> 
                                    <th>Team name</th>
                        <td><?php echo $teamnamee; ?></td>
                        
                      </tr>
                      <tr>
                        <th>Team ID</th>
                        <td><?php echo $teamm; ?></td>
                        
                      </tr>        
                      </tr>
                     </tbody>
                            <?php
                            $team_quer = "SELECT `member1id` FROM `team` WHERE team_id='$teamm'";
                            $res = $con->query($team_quer);
                            $arr = $res->fetch_array();
                            $abc = $arr["member1id"];
                            $que = "SELECT `fullname` FROM `members` WHERE ren_id='$abc' ";
                            $nam_result=$con->query($que);
                                $arr_nam = $nam_result->fetch_array();
                                $nam=$arr_nam["fullname"];
                                ?>
                                 </tr>
                      <tr>
                        <th>Member 1</th>
                        <td><?php echo $nam; ?></td>
                        
                      </tr> </tr>
                      <tr>
                        <th>Hack ID</th>
                        <td><?php echo $abc; ?></td>
                        
                      </tr>
                                
                                <?php
                                $team_query = "SELECT `member2id` FROM `team` WHERE team_id='$teamm'";
                            $all_result = $con->query($team_query);

                            $storeArray = Array();
                            while ($row = $all_result->fetch_assoc()) {
                                        $storeArray[]=$row["member2id"];  
                                }
                            for ($i=0; $i < $all_result->num_rows; $i++) 
                            { 
                                $query_name="SELECT `fullname` FROM `members` WHERE ren_id='$storeArray[$i]' ";
                                $name_result=$con->query($query_name);
                                $arr_name = $name_result->fetch_array();
                                $namee=$arr_name["fullname"];
                                $c=$i+2;
                                ?>
                                 </tr>
                      <tr>
                        <th>Member <?php echo $c; ?></th>
                        <td><?php echo $namee; ?></td>
                        
                      </tr> </tr>
                      <tr>
                        <th>Hack ID</th>
                        <td><?php echo $storeArray[$i]; ?></td>
                        
                      </tr>
                                <?php
                            }           

                            ?>
                        </table>
                            <form id="deletion" onsubmit="return confirm('Do you really want to delete the team?');" class="form-horizontal" role="form" action="delete_team.php" method="post">
                                <div class="col-sm-12 controls">
                                    <!-- <input type="hidden" name="team_id" value="<?php $teamm; ?>"> -->
                                    <input id="team_id" type="hidden" class="form-control" name="team_id" value="<?php echo "$teamm"; ?>">
                               <center>
                            
                     <button type="submit" class="btn btn-danger btn" onclick="getConfirmation();">Delete team</button>
                               </center>
                        </div>

                            </form>

                            <?php



                            die();
                        }
                        else
                        {
                        ?>
                    <form id="creation" class="form-horizontal" role="form" action="creation_backend.php" method="post" autocomplete="off">
                        <!-- <div align="left"><h4>Team Name:</h4></div> -->
                        <div style="margin-bottom: 45px" class="input-group">
                            <span class="input-group-addon"><img src="./fonts/team.png" height="28" width="28"></span>
                            <font size="5"><input id="teamname" type="text" class="form-control" name="teamname" value="" placeholder="Team Name" style=" height: 45px;" required>  </font>                                      
                        </div>
                        <!-- <div align="left"><h4>Member-1 Hack 36 ID:</h4></div> -->
                        <div style="margin-bottom: 45px" class="input-group">
                            <span class="input-group-addon"><img src="./fonts/1.png" height="28" width="28"></span>
                            <font size="5"><input id="member1id" type="text" class="form-control" name="member1id" value="" placeholder="Member-1 Hack36 ID" style=" height: 45px;" required>  </font>                                      
                        </div>
                        <!-- <div align="left"><h4>Member-2 Hack 36 ID:</h4></div> -->
                        <div style="margin-bottom: 45px" class="input-group">
                            <span class="input-group-addon"><img src="./fonts/2.png" height="28" width="28"></span>
                            <font size="5"><input id="member2id" type="text" class="form-control" name="member2id" value="" placeholder="Member-2 Hack36 ID" style=" height: 45px;">  </font>                                      
                        </div>
                        <!-- <div align="left"><h4>Member-3 Hack 36 ID:</h4></div> -->
                        <div style="margin-bottom: 45px" class="input-group">
                            <span class="input-group-addon"><img src="./fonts/3.png" height="28" width="28"></span>
                            <font size="5"><input id="member3id" type="text" class="form-control" name="member3id" value="" placeholder="Member-3 Hack36 ID" style=" height: 45px;">  </font>                                      
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            

                            <div class="col-sm-12 controls">
                               <center>
                            
                     <button type="submit" class="btn btn-success btn-lg">Submit</button>
                               </center>
                   <!--     </div>
 -->            <!--   </div>   -->               
            </div>  
</form>
</body>
</html>  
<?php  
} 
?>