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
                WHERE Genres LIKE '%$genre%' 
                AND avgRating BETWEEN $rating AND ($rating+2.5) 
                AND ReleaseYear BETWEEN $decade AND ($decade+10) 
                AND runtime BETWEEN $runtime and ($runtime+30) 
                AND numVotes BETWEEN $voteFloor and $voteCeiling";

        // Execute the query and retrieve the results

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
        //WHERE (Genres LIKE '%$genre%' AND Genres LIKE '%$genre2%')"  <- How to do query with multiple genres. 
        $third_sql = "SELECT * FROM temp_movie_table 
                    WHERE Genres LIKE '%$genre2%'
                    ORDER BY avgRating DESC";
        

        $result2 = mysqli_query( $connection, $third_sql );
        //Array2
        $stack2 = array();
        while( $row2 = mysqli_fetch_assoc( $result2) ) {
            array_push( $stack2, $row2 );
        }
        
        //DELETE 2nd Query items from the temp table.
         mysqli_query($connection, "DELETE FROM temp_movie_table WHERE Genres LIKE '%$genre2%';");
        
         //Sort by ranking so we know which items we take first.
        $del_sql = "SELECT * FROM temp_movie_table ORDER BY avgRating DESC";

        //Array3
        $result3 = mysqli_query( $connection, $del_sql );
        $stack3 = array();
        while( $row3 = mysqli_fetch_assoc( $result3) ) {
            array_push( $stack3, $row3 );
        }
        //RUN ACTOR ACTRESS AND DIRECTOR QUERYS

        
        /* How to pass multiple Genres in the query  
        $genre = "Comedy Action Adventure"; // a string containing multiple genres IF WE PASS GENRE WITH COMMAS THEN CHANGE EXPLODE TO ','. 
$genreArr = explode(' ', $genre); // split the string into an array of genres
$genreLike = array_map(function($genre) {
    return "Genres LIKE '%$genre%'";
}, $genreArr); // map each genre to a LIKE statement with the wildcard

$genreLikeString = implode(' OR ', $genreLike); // join the LIKE statements with OR
$sql = "SELECT * FROM main_movie_table WHERE ($genreLikeString) AND avgRating BETWEEN $rating AND ($rating+1.0) AND ReleaseYear BETWEEN $decade AND ($decade+10)";
        */
        //mysqli_query($connection, "DROP TEMPORARY TABLE IF EXISTS temp_movie_table");

        
        //PHP RETURNS END OF CODE
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

        echo json_encode( $data );
    ?>   

    