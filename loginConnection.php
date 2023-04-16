<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    //connection to the database
    $mysqli = require __DIR__ . "/database.php";

    //Prepare a statement with a parameter placeholder
    $stmt = $mysqli->prepare("SELECT * FROM sign_in_table WHERE Username = ?");
    
    if (!$stmt) {
        die("Error preparing SQL statement: " . $mysqli->error);
    }

    //Bind the parameter to the statement
    $Username = $_POST["username_Value"];
    $stmt->bind_param("s", $Username);

    //Execute the statement
    if (!$stmt->execute())
    {
        die("Error executing SQL Statement: " . $stmt->error);
    }

    //Fetch the result
    $result = $stmt->get_result();

    if(!$result)
    {
        die("Error getting result set: " . $stmt->error);
    }

    //getting the User
    $user = $result->fetch_assoc();

    //If statement to make sure there is the Username within the system
    if($user)
    {
        $password_hash = password_hash($_POST["password_Value"], PASSWORD_DEFAULT);

        //Making sure the username and password go together
        if(password_verify($_POST["password_Value"], $user["Password"]))
        {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            header("Location: home.html");
            exit;

        }
        else
        {
            echo "Invalid username or password" ;
        }
    }
    else
    {
        echo "Invalid Username or Password";
    }

}

?>
