
<?php
/*File: getN.php
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

        $category= $_POST['category'];



        //First query, to extract names from Movie1 
        $first_sql = "SELECT * FROM names_table 
                WHERE nameNumber LIKE 'Name1'
                AND Category LIKE '$category'";


        //Pass the results into an array
        $result = mysqli_query( $connection,$first_sql);
        
        $stack = array();
        while( $row = mysqli_fetch_assoc( $result) ) {
            array_push( $stack, $row );
        }
        

        //Second query, to extract names from Movie2 
        $second_sql= "SELECT * FROM names_table 
        WHERE nameNumber LIKE 'Name2'
        AND Category LIKE '$category'";

        //Pass the results into an array
        $result2 = mysqli_query( $connection,$second_sql);
        
        $stack2 = array();
        while( $row2 = mysqli_fetch_assoc( $result2) ) {
            array_push( $stack2, $row2 );
        }
        
        //Third query, to extract names from Movie3
        $third_sql= "SELECT * FROM names_table 
        WHERE nameNumber LIKE 'Name3'
        AND Category LIKE '$category'";

        //Pass the results into an array
        $result3 = mysqli_query( $connection,$third_sql);
        
        $stack3 = array();
        while( $row3 = mysqli_fetch_assoc( $result3) ) {
            array_push( $stack3, $row3 );
        }
       
        //Fourth query, to extract names from Movie4
        $fourth_sql= "SELECT * FROM names_table 
        WHERE nameNumber LIKE 'Name4'
        AND Category LIKE '$category'";


        //Pass the results into an array
        $result4 = mysqli_query( $connection,$fourth_sql);
        
        $stack4 = array();
        while( $row4 = mysqli_fetch_assoc( $result4) ) {
            array_push( $stack4, $row4);
        }
        
        //Results saved into array and passed back to the page. 

        $data = array(
            "Name1" => $stack,
            "Name2" => $stack2,
            "Name3" => $stack3,
            "Name4" => $stack4
        );
        

        echo json_encode( $data );
    ?>   

    