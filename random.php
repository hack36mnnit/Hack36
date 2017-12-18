
 <?php
error_reporting(0);
$city="";
$clg = "";
$city = $_GET['city'];
libxml_use_internal_errors(true);
$html=file_get_contents('http://www.ges.ecell-iitkgp.org/register/getColleges.php?city='.$city);
$dom = new DOMDocument;
$dom->loadHTML($html);
foreach($dom->getElementsByTagName('option') as $ptag)
{
	$clg = $ptag->nodeValue;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hack36";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO cities_n_colleges (uid, city, college)
VALUES ('', '$city', '$clg')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


	
     //echo "<h6>".$ptag->nodeValue."</h6>";
	


    
}
mysqli_close($conn);
?>