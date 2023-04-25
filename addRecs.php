
<?php
/*File: addRecs.php
Project: PnC
Author: PnC Development Team
History: Version 3.0 April 22, 2022*/
    $user="root";
    $password="";
    $database="pnc";
    

    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = mysqli_connect('localhost',$user,$password,$database);
    if ( !$connection ) {
        die( 'Database Connection Failed' . mysqli_error( $connection ) );
    }

    //Get variables from HTTP request
    $recNum= $_POST['recNum'];
    $ID = $_POST['ID'];


    //QUERY INSERT MOVIE INTO PAST REC TABLE using the recNum code.
    $first_sql= "INSERT INTO past_table (recNum, ID, PrimaryTitle, OriginalTitle, ReleaseYear, runtime, Genres, avgRating, numVotes)
                SELECT '$recNum', ID, PrimaryTitle, OriginalTitle, ReleaseYear, runtime, Genres, avgRating, numVotes
                FROM main_movie_table
                WHERE ID LIKE '$ID'";
    
    // Execute the query and retrieve the results
    mysqli_query( $connection, $first_sql );
    
    //Message returned to the page
    $message= "$ID was stored on the table."; 
    echo json_encode( $message );

?>
