<?php
//admin user: animals password: @nim@ls
session_start();
if( isset( $_POST[ 'admin_submit' ] ) ){
    //get inputs
    $name = $_POST[ 'name' ];
    $password = $_POST[ 'password' ];

    if( empty( $name ) || empty( $password ) ){
        header( "Location: ../login.php?error=emptyfields" );
        exit();
    }else if( $name == "animals" && $password == "@nim@ls" ){
        $_SESSION[ 'name' ] = "animals";
        header( "Location: ../admin.php");
        exit();
    }else{
        header( "Location: ../login.php?error=wronguserorpass" );
        exit();
    }
}else{
    header( "Location: ../login.php" );
    exit();
}