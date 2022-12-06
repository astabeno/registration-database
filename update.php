<?php
// Initialize the session
require 'assets/php/session.php';

require 'assets/php/config.php';

$cid = $_REQUEST['cid'];
$name = $_REQUEST['name'];
$gender = $_REQUEST['gender'];
$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$number = $_REQUEST['number'];
$country = $_REQUEST['country'];
$nationality = $_REQUEST['nationality'];
$adgroup = $_REQUEST['adgroup'];

if (isset($_REQUEST['christian']) && $_REQUEST['christian'] == "christian") { //where "Value" is the
    //same string given in the HTML form, as value attribute the the checkbox input
    $christian = 1;
}
else {
    $christian = 0;
}
if (isset($_REQUEST['called']) && $_REQUEST['called'] == "called") { //where "Value" is the
    //same string given in the HTML form, as value attribute the the checkbox input
    $called = 1;
}
else {
    $called = 0;
}
if (isset($_REQUEST['passed-off']) && $_REQUEST['passed-off'] == "passedOff") { //where "Value" is the
    //same string given in the HTML form, as value attribute the the checkbox input
    $passed = 1;
}
else {
    $passed = 0;
}
$attitude = $_REQUEST['attitude'];
$notes = $_REQUEST['notes'];

$userid = $_SESSION['id'];

// Performing insert query execution
// here our table name is college
$sqlUpdateContact =
    "UPDATE contacts 
            SET 
                name = '$name',
                gender = '$gender',
                cdate = '$date',
                ctime = '$time',
                wanumber = '$number',
                country = '$country',
                nationality = '$nationality',
                adgroup = '$adgroup',
                cbb ='$christian',
                called = '$called',
                passed = '$passed',
                attitude = '$attitude',
                notes = '$notes'
            WHERE
                cid = " . $cid . "
            ;";

if (mysqli_query($conn, $sqlUpdateContact)) {
    //echo "<h3>data stored in a database successfully."
    //	. " Please browse your localhost php my admin"
    //	. " to view the updated data</h3>";
    header('Location: contactlist.php?search=all');

// echo nl2br("\n$name\n $number\n "
//	 . "$userid\n");
}
else {
    echo "ERROR: Hush! Sorry $sqlAddContact. "
        . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
//echo "connection closed."
?>