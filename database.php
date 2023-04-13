<?php 

$host = "localhost";
$database = "pnc";
$table = "sign_in_table";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno)
{
    die("Connection Error: " . $mysqli->connect_error);
}

return $mysqli;

?>