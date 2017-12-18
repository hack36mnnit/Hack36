<?php
// session_start();
require('function.php');
require('includes/config.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
$team_id = validate($_POST["team_id"]);

}
$con = con();

$query = "DELETE FROM team WHERE team_id = '$team_id' ";
// $result = $con->query($query);


$result = mysqli_query ($con, $query);

?>
<script>alert('Team deletion successful');window.location='creation.php';</script>
<?php

?>