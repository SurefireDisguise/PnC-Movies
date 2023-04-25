
<?php
/*File: searchT.php
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

       
        //Get values from HTTP request
        $ac1= $_POST['ac1'];
        $ac2= $_POST['ac2'];
        $ac3= $_POST['ac3'];
        $ac4= $_POST['ac4'];
        
        $category = $_POST['category'];
        
        //First Query to extract names from movie1.  
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
       
        //Second query to extract names from movie2. 
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
        

        //Third query to extract names from movie3
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
        
        //Fourth query to extract names from movie4
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
       
        //We return a message after all queries run and names are in the names_table. 
        //This so it can be extracted from the next webpage. 
        $data= "Data was passed into Table.";

        echo json_encode( $data );
    ?>   

    