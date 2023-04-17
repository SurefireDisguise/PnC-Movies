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
    $ID = $_POST['ID'];


    //MODIFY QUERY SO QUERY IS THROWN INTO MAIN_MOVIE_TABLE AND THEN INSERTED INTO PAST_TABLE 
    /*
    $PrimaryTitle = $_POST['PrimaryTitle'];
    $OriginalTitle = $_POST['OriginalTitle'];
    $ReleaseYear = $_POST['ReleaseYear'];
    $runtime = $_POST['runtime'];
    $Genres= $_POST['Genres'];
    $avgRating= $_POST['avgRating'];
    $numVotes= $_POST['numVotes'];
    */

    //QUERY INSERT MOVIE INTO PAST REC TABLE
    $first_sql= "INSERT INTO past_table (recNum, ID, PrimaryTitle, OriginalTitle, ReleaseYear, runtime, Genres, avgRating, numVotes)
                SELECT '$recNum', ID, PrimaryTitle, OriginalTitle, ReleaseYear, runtime, Genres, avgRating, numVotes
                FROM main_movie_table
                WHERE ID LIKE '$ID'";
    /*
    $first_sql= "INSERT INTO past_table (recNum, ID, PrimaryTitle, OriginalTitle, ReleaseYear, runtime, Genres, avgRating, numVotes)
                VALUES ('$recNum', '$ID ', '$PrimaryTitle', '$OriginalTitle',$ReleaseYear,$runtime, '$Genres', $avgRating, $numVotes)";
    */
    //NEED  TO SAVE THREE MOVIES. Send three requests to the same file. 

    // Execute the query and retrieve the results
    mysqli_query( $connection, $first_sql );
    
    $message= "$ID was stored on the table."; 
    echo json_encode( $message );

?>
