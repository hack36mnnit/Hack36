
<?php
error_reporting(0);

require('../connection.php');
$sql = "SELECT DISTINCT city FROM cities_n_colleges ORDER BY city ASC;";
$result = mysqli_query($conn, $sql);
$d = array();
$d[] = "select a city";
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    	$d[] = $row["city"];
        //echo "<option>". $row["city"]. "</option>";

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



?>
