<?php
        $user="root";
        $password="";
        $database="pnc";
        $table="main_movie_table";

        
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $connection = mysqli_connect('localhost',$user,$password,$database);
        if ( !$connection ) {
            die( 'Database Connection Failed' . mysqli_error( $connection ) );
        }

        $genre = $_POST['genre'];
        $genre2 = $_POST['genre2'];
        $rating = $_POST['avgRating'];
        $decade = $_POST['decade'];
        $runtime = $_POST['runtime'];
        $voteCeiling= $_POST['voteCeiling'];
        $voteFloor= $_POST['voteFloor'];

        // Construct the SQL query
        // Create temporary table
        mysqli_query($connection, "CREATE TEMPORARY TABLE temp_movie_table LIKE main_movie_table");

        

        $first_sql = "INSERT INTO temp_movie_table 
                SELECT * FROM main_movie_table
                WHERE (Genres LIKE '%Family%' AND Genres LIKE '%$genre%')
                AND avgRating BETWEEN $rating AND ($rating+2.5) 
                AND ReleaseYear BETWEEN $decade AND ($decade+10) 
                AND runtime BETWEEN $runtime and ($runtime+30) 
                AND numVotes BETWEEN $voteFloor and $voteCeiling";

        // Execute the query and retrieve the results

        //$result0= 
        mysqli_query( $connection, $first_sql );
        // Retrieve results from temporary table
        $sec_sql = "SELECT * FROM temp_movie_table";

        //Pass the results into an array
        $result = mysqli_query( $connection, $sec_sql );
        $stack = array();
        while( $row = mysqli_fetch_assoc( $result) ) {
            array_push( $stack, $row );
        }
        
         //RUN SECOND QUERY WITH 2ND GENRE
        //WHERE (Genres LIKE '%$genre%' AND Genres LIKE '%$genre2%')"  <- How to do query with multiple genres. 
        $third_sql = "SELECT * FROM temp_movie_table 
                        WHERE Genres LIKE '%$genre2%'";
        

        $result2 = mysqli_query( $connection, $third_sql );
        $stack2 = array();
        while( $row2 = mysqli_fetch_assoc( $result2) ) {
            array_push( $stack2, $row2 );
        }
        
        //DELETE 2nd Query items from the temp table.
         mysqli_query($connection, "DELETE FROM temp_movie_table WHERE Genres LIKE '%$genre2%';");
        
         //Sort by ranking so we know which items we take first.
        $del_sql = "SELECT * FROM temp_movie_table ORDER BY avgRating DESC";

        $result3 = mysqli_query( $connection, $del_sql );
        $stack3 = array();
        while( $row3 = mysqli_fetch_assoc( $result3) ) {
            array_push( $stack3, $row3 );
        }
        //RUN ACTOR ACTRESS AND DIRECTOR QUERYS
        
        //PHP RETURNS END OF CODE
        //Return as json array of arrays
        // Combine result arrays
        $data = array(
            "Query1" => $stack,
            "Query2" => $stack2,
            "Query3" => $stack3
        );

        echo json_encode( $data );
    ?>   

    