<?php
        $user="root";
        $password="";
        $database="pnc";

        
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $connection = mysqli_connect('localhost',$user,$password,$database);
        if ( !$connection ) {
            die( 'Database Connection Failed' . mysqli_error( $connection ) );
        }

        $category= $_POST['category'];

        $first_sql = "SELECT * FROM names_table 
                WHERE nameNumber LIKE 'Name1'
                AND Category LIKE '$category'";


       
    //Pass the results into an array
        $result = mysqli_query( $connection,$first_sql);
        //Array1
        $stack = array();
        while( $row = mysqli_fetch_assoc( $result) ) {
            array_push( $stack, $row );
        }
        /*
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              array_push($stack, $row);
            }
          } else {
            $stack[] = array("message" => "No results for Name1 and $category.");
          }
          */
    // Pass the results into an array


        
        $second_sql= "SELECT * FROM names_table 
        WHERE nameNumber LIKE 'Name2'
        AND Category LIKE '$category'";

        //Pass the results into an array
        $result2 = mysqli_query( $connection,$second_sql);
        
        $stack2 = array();
        while( $row2 = mysqli_fetch_assoc( $result2) ) {
            array_push( $stack2, $row2 );
        }
        /*
        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
              array_push($stack2, $row2);
            }
          } else {
            $stack2[] = array("message" => "No results for Name2 and $category.");
          }
          */
        

        $third_sql= "SELECT * FROM names_table 
        WHERE nameNumber LIKE 'Name3'
        AND Category LIKE '$category'";

        //Pass the results into an array
        $result3 = mysqli_query( $connection,$third_sql);
        //Array1
       
        $stack3 = array();
        while( $row3 = mysqli_fetch_assoc( $result3) ) {
            array_push( $stack3, $row3 );
        }
        /*
        if (mysqli_num_rows($result3) > 0) {
            while ($row3 = mysqli_fetch_assoc($result3)) {
              array_push($stack3, $row3);
            }
          } else {
            $stack3[] = array("message" => "No results for Name3 and $category.");
          }
          */

        $fourth_sql= "SELECT * FROM names_table 
        WHERE nameNumber LIKE 'Name4'
        AND Category LIKE '$category'";


        //Pass the results into an array
        $result4 = mysqli_query( $connection,$fourth_sql);
        
        $stack4 = array();
        while( $row4 = mysqli_fetch_assoc( $result4) ) {
            array_push( $stack4, $row4);
        }
        /*
        if (mysqli_num_rows($result4) > 0) {
            while ($row4 = mysqli_fetch_assoc($result4)) {
              array_push($stack4, $row4);
            }
          } else {
            $stack4[] = array("message" => "No results for Name4 and $category.");
          }
          */
        
        //SAVE ACTOR INFO INTO NEW TABLE, SO WE CAN ACCESS ON THE CONNECTION.6 PHP.
        //NEW TABLE like principals table but extra column for name number. 
        //That way we know what movie it belongs to and we can divide later.
       
       

        $data = array(
            "Name1" => $stack,
            "Name2" => $stack2,
            "Name3" => $stack3,
            "Name4" => $stack4
        );
        

        echo json_encode( $data );
    ?>   

    