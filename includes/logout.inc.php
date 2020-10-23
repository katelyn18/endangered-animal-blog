<?php
session_start();
$_SESSION[ 'name' ] = null;
session_unset();
session_destroy();
header( "Location: ../login.php" );