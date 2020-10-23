
<?php
require "header.php";
require "includes/dbh.inc.php";
echo "<div class='container'>";
echo "<a href='index.php'><img src='png/logo.png'></a>";

echo "<form method='post'>";
echo "<label>Search for posts between </label>";
echo "<input type='date' name='date1' id='datefield' min='2020-05-08'>";
echo "<label> and </label>";
echo "<input type='date' name='date2' id='datefield2' min='2020-05-08'>";
echo "<button type='submit' name='search_submit'>Search</button>";
echo "</form>";

//show posts with certain dates
if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ){
    $date1 = $_POST[ 'date1' ];
    $date2 = $_POST[ 'date2' ];

    //check if $date1 or $date2 is empty
    if( $date1 == null || $date2 == null ){
        echo "Please enter both dates";
    }else{ 
        $sql = "SELECT post_title, post_date, post_description FROM Posts WHERE cast( post_date AS date ) BETWEEN ? AND ? ORDER BY post_date DESC";
        $stmt = mysqli_stmt_init( $conn );
        if( !mysqli_stmt_prepare( $stmt, $sql ) ){
            echo "SQL Error";
        }else{
            mysqli_stmt_bind_param( $stmt, "ss", $date1, $date2 );
            mysqli_stmt_execute( $stmt );
            $result = mysqli_stmt_get_result( $stmt );

            $empty = TRUE; 
            
            while( $row = mysqli_fetch_array( $result, MYSQLI_NUM) ){
                echo "<div class='posts'>"; 
                echo "<h2>" . $row[ 0 ] . "</h2>";
                echo "<p>" . $row[ 2 ] . "</p>";
                echo "<h3>Posted: " . $row[ 1 ] . "</h3>";
                echo "</div>";
                $empty = FALSE;
            }            

            if( $empty ){ //if there are no posts within the chosen dates
                echo "<div class='posts'>"; 
                echo "<p>There are no posts for the chosen dates.</p>";
                echo "</div>";
            }
            
            echo "</div>";
            
        }
        mysqli_stmt_close( $stmt );
        mysqli_close( $conn );
    }
}else{ //Show all posts
    $sql = "SELECT post_title, post_date, post_description FROM Posts ORDER BY post_date DESC";
    $stmt = mysqli_stmt_init( $conn );
    if( !mysqli_stmt_prepare( $stmt, $sql ) ){
        header( "Location: ../index.php?error=sqlerror" );
        exit();
    }else{
        mysqli_stmt_execute( $stmt );
        $results = mysqli_stmt_get_result( $stmt );
       
        while( $row = mysqli_fetch_array( $results, MYSQLI_NUM ) ){
            echo "<div class='posts'>";
            echo "<h2>" . $row[ 0 ] . "</h2>";
            echo "<p>" . $row[ 2 ] . "</p>";
            echo "<h3>Posted: " . $row[ 1 ] . "</h3>";
            echo "</div>";
        }
        
        echo "</div>";
    }
    mysqli_stmt_close( $stmt );
    mysqli_close( $conn );
}

echo '<script src="scripts/searchdate.js"></script>';
require "footer.php";
