<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u981190432_databoss');
define('DB_PASSWORD', '@K0Ne5As5nHztz');
define('DB_NAME', 'u981190432_Registration');


/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


// Check connection
if ($conn->connect_error) {
    //die("ERROR: Could not connect. " . mysqli_connect_error());
    die('ERROR: Could not connect. ' . $conn->connect_errno . ' - ' . $conn->connect_error);
}
?>

