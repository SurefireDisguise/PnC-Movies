<?php
    $user="root";
    $password="";
    $database="pnc";
    $table="past_table";

    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = mysqli_connect('localhost',$user,$password,$database);
    if ( !$connection ) {
        die( 'Database Connection Failed' . mysqli_error( $connection ) );
    }


    $recNum= $_POST['recNum'];
    $username= $_POST['username'];
    /*
    QUERY TO SAVE USERNAME INTO TABLE
    INSERT INTO sign_in_table (Username, Password, Email)
VALUES ('your_username', 'your_password', 'your_email');*/

    //QUERY INSERT PAST REC ID INTO THE SIGN IN TABLE CAN BE ON ANOTHER FILE. 
    $first_sql="UPDATE sign_in_table
                SET recNum = '$recNum'
                WHERE Username = '$username'";
    
    // Execute the query and retrieve the results
    mysqli_query( $connection, $first_sql );
    
    $message= "Value Saved on Sign In Table";
    

    echo json_encode( $message );

?>
