
<?php

/*File: search.php
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

        //Receive variable values from HTTP requests
        $genre = $_POST['genre'];
        $genre2 = $_POST['genre2'];
        $rating = $_POST['avgRating'];
        $decade = $_POST['decade'];
        $runtime = $_POST['runtime'];
        $voteCeiling= $_POST['voteCeiling'];
        $voteFloor= $_POST['voteFloor'];

       
        // Create temporary table
        mysqli_query($connection, "CREATE TEMPORARY TABLE temp_movie_table LIKE main_movie_table");

        
        //Query to extract movies. Saved into temp table. 
        $first_sql = "INSERT INTO temp_movie_table 
                SELECT * FROM main_movie_table 
                WHERE Genres LIKE '%$genre%' 
                AND avgRating BETWEEN $rating AND ($rating+5.0) 
                AND ReleaseYear BETWEEN $decade AND ($decade+10) 
                AND runtime BETWEEN $runtime and ($runtime+30) 
                AND numVotes BETWEEN $voteFloor and $voteCeiling";

        // Execute the query and retrieve the result
        mysqli_query( $connection, $first_sql );

        // Retrieve results from temporary table
        $sec_sql = "SELECT * FROM temp_movie_table";

        //Pass the results into an array
        $result = mysqli_query( $connection, $sec_sql );
        //Array1
        $stack = array();
        while( $row = mysqli_fetch_assoc( $result) ) {
            array_push( $stack, $row );
        }
        

        //RUN QUERY WITH 2ND GENRE
        $third_sql = "SELECT * FROM temp_movie_table 
                    WHERE Genres LIKE '%$genre2%'
                    ORDER BY avgRating DESC";
        
        //Pass results into another array. 
        $result2 = mysqli_query( $connection, $third_sql );
        //Array2
        $stack2 = array();
        while( $row2 = mysqli_fetch_assoc( $result2) ) {
            array_push( $stack2, $row2 );
        }
        
        //DELETE 2nd Query items from the temp table.
         mysqli_query($connection, "DELETE FROM temp_movie_table WHERE Genres LIKE '%$genre2%';");
        
         //Extract remaining results. Sorted by ranking so we know which items we take first.
        $del_sql = "SELECT * FROM temp_movie_table ORDER BY avgRating DESC";

        //Array3
        $result3 = mysqli_query( $connection, $del_sql );
        $stack3 = array();
        while( $row3 = mysqli_fetch_assoc( $result3) ) {
            array_push( $stack3, $row3 );
        }
        
        
        //Return as json array of arrays
        // Combine result arrays
        $data = array(
            //Query 1, entire table with results
            "Query1" => $stack,
            //Query 2, results that match genre 2
            "Query2" => $stack2,
            //query 3  remaining results in the table, sorted by rating. 
            "Query3" => $stack3
        );

        //PHP RETURNS END OF CODE
        echo json_encode( $data );
    ?>   

    