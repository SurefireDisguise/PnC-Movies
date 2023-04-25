<?php
/*File: display.php
Project: PnC
Author: PnC Development Team
History: Version 3.0 April 22, 2022*/

$user = "root";
$password = "";
$database = "pnc";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connection = mysqli_connect('localhost', $user, $password, $database);

if (!$connection) {
    die('Database Connection Failed' . mysqli_error($connection));
}

$username = $_POST['user'];


//first query retrive recnum from sign in table with username
$first_sql = "SELECT recNum FROM sign_in_table WHERE Username = '$username'";


$recNum_result = mysqli_query($connection, $first_sql);
$recNum_row = mysqli_fetch_assoc($recNum_result);
$recNum = $recNum_row['recNum'];

//Second query retreive movie info with code. 
$sec_sql = "SELECT * FROM past_table WHERE recNum = '$recNum'";
$result = mysqli_query($connection, $sec_sql);

$stack = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($stack, $row);
}

echo json_encode($stack);
?>