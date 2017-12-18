<option>select a city</option>
<?php
error_reporting(0);

require('connection.php');
$sql = "SELECT DISTINCT city FROM cities_n_colleges ORDER BY city ASC;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<option>". $row["city"]. "</option>";
    }
} else {
    //echo "0 results";
}

?>
