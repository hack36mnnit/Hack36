<?php
error_reporting(0);
require('connection.php');
$city="";
$city = mysqli_real_escape_string($conn, $_GET['city']);

if($city != '')
{



$sql = "SELECT college FROM cities_n_colleges WHERE city='$city' ORDER BY college ASC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<option>". $row["college"]. "</option>";
    }
    ?>
    
    <?php
} else {
    //echo "0 results";
}
}

?>
