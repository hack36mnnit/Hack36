
<?php
error_reporting(0);
$city="";
$city = mysql_real_escape_string($_GET['city']);
$d = array();
if(isset($city) && !empty($city))
{


require('../connection.php');


$sql = "SELECT college FROM cities_n_colleges WHERE city='$city' ORDER BY college ASC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    	$d[] = $row["college"];
       // echo "<option>". $row["college"]. "</option>";
    }
    $response["result"] = "success";
    $response["message"] = "";
      $response["data"] = $d;
    echo json_encode($response);
} else {
	$response["result"] = "failure";
	$response["message"] = "Error connecting to server";
      $response["data"] = $d;
    echo json_encode($response);
    //echo "0 results";
}
}
else
{
	$response["result"] = "failure";
	$response["message"] = "Error in request to server";
      $response["data"] = $d;
    echo json_encode($response);
}

?>
