
<?php

/*File: ConnectionW2.php
Project: PnC
Author: PnC Development Team
History: Version 3.0 April 22, 2022*/
    $user="root";
    $password="";
    $database="pnc";
    $table="past_table";

    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = mysqli_connect('localhost',$user,$password,$database);
    if ( !$connection ) {
        die( 'Database Connection Failed' . mysqli_error( $connection ) );
    }

    //Past recs
    $recNum= $_POST['recNum'];
    $username= $_POST['username'];
    

    //QUERY INSERT PAST REC ID INTO THE SIGN IN TABLE
    $first_sql="UPDATE sign_in_table
                SET recNum = '$recNum'
                WHERE Username = '$username'";
    
    // Execute the query 
    mysqli_query( $connection, $first_sql );
    
    //Result message is returned. 
    $message= "Value Saved on Sign In Table";
    

    echo json_encode( $message );

?>
