<?php

if(empty($_POST["signup_username_value"]))
{
    die("Username is required");
}

if(!filter_var($_POST["signup_email_value"], FILTER_VALIDATE_EMAIL))
{
    die("Valid Email Is Required");
}

if(strlen($_POST["signup_password_value"]) < 8)
{
    die("Password Must Be At Least 8 Characters");
}

if(! preg_match("/[a-z]/i",$_POST["signup_password_value"]))
{
    die("Password must contain at least one letter");
}

if (! preg_match("/[0-9]/", $_POST["signup_password_value"])) 
{
    die("Password must contain at least one number");
}

if ($_POST["signup_password_value"] !== $_POST["signup_password_confirm_value"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["signup_password_value"], PASSWORD_DEFAULT);

$Username = $_POST["signup_username_value"];
$Password = $password_hash;
$Email = $_POST["signup_email_value"];


//
$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO sign_in_table (Username, Password, Email) VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

/*
$stmt->bind_param("sss",
                  $_POST["Username"],
                  $password_hash,
                  $_POST["Email"}]);
                  */

$stmt->bind_param("sss",
                  $Username,
                  $password_hash,
                  $Email);
                  
if ($stmt->execute()) {

    header("Location: home.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

?>