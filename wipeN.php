
<?php
        $user="root";
        $password="";
        $database="pnc";

        
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $connection = mysqli_connect('localhost',$user,$password,$database);
        if ( !$connection ) {
            die( 'Database Connection Failed' . mysqli_error( $connection ) );
        }


        //WIPE TABLE
        $first_sql="DELETE FROM names_table";
        mysqli_query( $connection,$first_sql);
       
       

        $data = "getN wiped";
        

        echo json_encode( $data );
    ?>   

    

