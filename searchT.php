<?php
        $user="root";
        $password="";
        $database="pnc";
        $table="principals_table";

        
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $connection = mysqli_connect('localhost',$user,$password,$database);
        if ( !$connection ) {
            die( 'Database Connection Failed' . mysqli_error( $connection ) );
        }

       
        //Values are assigned correctly. 
        //movies = $_POST['movieArr'];
        // Get the ID array from the POST data and convert it into a comma-separated string
        //$movie_string = implode(',',$movies);
        $ac1= $_POST['ac1'];
        $ac2= $_POST['ac2'];
        $ac3= $_POST['ac3'];
        $ac4= $_POST['ac4'];
        //var_dump($movie_string);
        $category = $_POST['category'];

        //var_dump($_POST);

        //PROBLEM HERE

        // Build the query using the IN operator
        /*
        $query_sql= "SELECT * FROM principals_table 
                    WHERE ID IN ($movie_string) 
                    AND Category LIKE '$category'";
                    */
         $first_sql= "SELECT * FROM principals_table 
                    WHERE ID LIKE '$ac1'
                    AND Category LIKE '$category'";

        //Pass the results into an array
        $result = mysqli_query( $connection,$first_sql);
        //Array1
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['ID'];
            $n_id = $row['N_ID'];
            $category = $row['Category'];
            $primary_name = $row['primaryName'];
            
            // Insert the row into names_table
            $insert_sql = "INSERT INTO names_table (ID, N_ID, Category, primaryName, nameNumber)
                           VALUES ('$id', '$n_id', '$category', '$primary_name', 'Name1')";
            mysqli_query($connection, $insert_sql);
        }
        /*
        $stack = array();
        while( $row = mysqli_fetch_assoc( $result) ) {
            array_push( $stack, $row );
        }
        */
        
        $second_sql= "SELECT * FROM principals_table 
        WHERE ID LIKE '$ac2'
        AND Category LIKE '$category'";


        //Pass the results into an array
        $result2 = mysqli_query( $connection,$second_sql);
        //Array1
        while ($row = mysqli_fetch_assoc($result2)) {
            $id = $row['ID'];
            $n_id = $row['N_ID'];
            $category = $row['Category'];
            $primary_name = $row['primaryName'];
            
            // Insert the row into names_table
            $insert_sql = "INSERT INTO names_table (ID, N_ID, Category, primaryName, nameNumber)
                           VALUES ('$id', '$n_id', '$category', '$primary_name', 'Name2')";
            mysqli_query($connection, $insert_sql);
        }
        /*
        $stack2 = array();
        while( $row2 = mysqli_fetch_assoc( $result2) ) {
        array_push( $stack2, $row2 );
        }
        */

        $third_sql= "SELECT * FROM principals_table 
        WHERE ID LIKE '$ac3'
        AND Category LIKE '$category'";


        //Pass the results into an array
        $result3 = mysqli_query( $connection,$third_sql);
        //Array1
        while ($row = mysqli_fetch_assoc($result3)) {
            $id = $row['ID'];
            $n_id = $row['N_ID'];
            $category = $row['Category'];
            $primary_name = $row['primaryName'];
            
            // Insert the row into names_table
            $insert_sql = "INSERT INTO names_table (ID, N_ID, Category, primaryName, nameNumber)
                           VALUES ('$id', '$n_id', '$category', '$primary_name', 'Name3')";
            mysqli_query($connection, $insert_sql);
        }
        /*
        $stack3 = array();
        while( $row3 = mysqli_fetch_assoc( $result3) ) {
        array_push( $stack3, $row3 );
        }
        */

        $fourth_sql= "SELECT * FROM principals_table 
        WHERE ID LIKE '$ac4'
        AND Category LIKE '$category'";


        //Pass the results into an array
        $result4 = mysqli_query( $connection,$fourth_sql);
        //Array1
        while ($row = mysqli_fetch_assoc($result4)) {
            $id = $row['ID'];
            $n_id = $row['N_ID'];
            $category = $row['Category'];
            $primary_name = $row['primaryName'];
            
            // Insert the row into names_table
            $insert_sql = "INSERT INTO names_table (ID, N_ID, Category, primaryName, nameNumber)
                           VALUES ('$id', '$n_id', '$category', '$primary_name', 'Name4')";
            mysqli_query($connection, $insert_sql);
        }
        /*
        $stack4 = array();
        while( $row4 = mysqli_fetch_assoc( $result4) ) {
        array_push( $stack4, $row4 );
        }
        */

        //SAVE ACTOR INFO INTO NEW TABLE, SO WE CAN ACCESS ON THE CONNECTION.6 PHP.
        //NEW TABLE like principals table but extra column for name number. 
        //That way we know what movie it belongs to and we can divide later.

        /*
        $data = array(
            "Name1" => $stack,
            "Name2" => $stack2,
            "Name3" => $stack3,
            "Name4" => $stack4
        );
        */
        $data= "Data was passed into Table.";



        echo json_encode( $data );
    ?>   

    