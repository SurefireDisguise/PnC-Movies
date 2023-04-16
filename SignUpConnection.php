<?php

//Making sure the areas are filled in
if(empty($_POST["signup_username_value"]))
{
    die("Username is required");
}

if(!filter_var($_POST["signup_email_value"], FILTER_VALIDATE_EMAIL))
{
    die("Valid Email Is Required");
}

//Password Verfications
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

//hash so we don't know the password of the User
$password_hash = password_hash($_POST["signup_password_value"], PASSWORD_DEFAULT);

//having them equal to a variable
$Username = $_POST["signup_username_value"];
$Password = $password_hash;
$Email = $_POST["signup_email_value"];


//connecting to the database file 
$mysqli = require __DIR__ . "/database.php";

//the table
$sql = "INSERT INTO sign_in_table (Username, Password, Email) VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

//Passing what was in the sign-in page into the table
$stmt->bind_param("sss",
                  $Username,
                  $password_hash,
                  $Email);
                  
if ($stmt->execute()) {

    header("Location: home.html");
    exit;
    
} else {
    
    //looking to see if there is a duplicated of emails
    if ($mysqli->errno === 1062) {
        die("Email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

?>