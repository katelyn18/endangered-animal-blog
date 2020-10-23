<?php
require "dbh.inc.php";

$date1 = $_POST[ 'date1' ];
$date2 = $_POST[ 'date2' ];

//function to get separate year, month, and date
function separateDate( $givenDate ){
    $date[ 0 ] = $givenDate[ 0 ] . $givenDate[ 1]  . $givenDate[ 2 ] . $givenDate[ 3 ];
    $date[ 1 ] = $givenDate[ 5 ] . $givenDate[ 6 ];
    $date[ 2 ] = $givenDate[ 8 ] . $givenDate[ 9 ];
    return $date;
}

//check if $date1 or $date2 is empty
if( $date1 == null || $date2 == null ){
    header( "Location: ../index.php?error=emptydate" );
    exit();
}else if( $date1 == $date2 ){ //check if same dates
    $d = separateDate( $date1 );
    $d1 = $d[ 0 ] . "-" . $d[ 1 ] . "-" . $d[ 2 ];
    $d2 = $d[ 0 ] . "-" . $d[ 1 ]++ . "-" . $d[ 2 ];
    $sql = "SELECT * FROM Posts WHERE post_date >= ? AND post_date < ?";
    $stmt = mysqli_stmt_init( $conn );
    if( !mysqli_stmt_prepare( $stmt, $sql ) ){
        header( "Location: ../index.php?error=sqlerror" );
        exit();
    }else{
        mysqli_stmt_bind_param( $stmt, "ss", $d1, $d2 );
        mysqli_stmt_execute( $stmt );
        $result = mysqli_stmt_get_result( $stmt );

        if( $row = mysqli_fetch_assoc( $result ) ){
            echo $row[ "post_title" ] . " " . $row[ "post_date" ];
        }else{
            header( "Location: ../index.php?error=nopost" );
            exit();
        }
    }
    
}

//get year 1

//get month 1

//get date 1

//get month 2

//get date 2

//query
/*
$search = mysql_query("SELECT username FROM oc_calendar WHERE 
start_date between '$from' AND '$to'");
*/

//change div to show those dates