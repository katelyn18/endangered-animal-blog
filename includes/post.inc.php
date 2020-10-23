<?php

if( isset( $_POST[ 'post_submit' ] ) ){
    require "dbh.inc.php";

    //get post info
    $title = $_POST[ 'ptitle' ];
    $desc = $_POST[ 'pdescription' ];

    if( empty( $title ) || empty( $desc ) ){
        header( "Location: ../admin.php?error=emptyfields" );
        exit();
    }else{
        $sql = "INSERT INTO Posts( post_title, post_description ) VALUES( ?, ? )";
        $stmt = mysqli_stmt_init( $conn );
        if( !mysqli_stmt_prepare( $stmt, $sql ) ){
            header( "Location: ../admin.php?error=sqlerror" );
            exit();
        }else{
            mysqli_stmt_bind_param( $stmt, "ss", $title, $desc );
            mysqli_stmt_execute( $stmt );
            header( "Location: ../admin.php?post=success" );
            exit();
        }
    }
    mysqli_stmt_close( $stmt );
    mysqli_close( $conn );
}else{
    header( "Location: ../admin.php?error=tryagain" );
    exit();
}