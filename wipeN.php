
<?php

/*File: wipeN.php
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


        //WIPE names_table so its empty. 
        $first_sql="DELETE FROM names_table";
        mysqli_query( $connection,$first_sql);
       
       
        //Return message. 
        $data = "getN wiped";
        

        echo json_encode( $data );
    ?>   

    

