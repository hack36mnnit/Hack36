<?php
error_reporting(0);
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
?>