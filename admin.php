<?php
    session_start();
    if( $_SESSION['name'] == null ){
        header( "Location: ../Blog/login.php?error=pleaselogin");
        exit();
    }
    
    require "header.php";
?>
    <form action="includes/logout.inc.php" method="post">
        <button type="submit" name="logout_submit">Logout</button>
    </form>
    <form action="includes/post.inc.php" method="post">
        <label>Post Title</label>
        <input type="text" name="ptitle" placeholder="Title">
        <br>
        <textarea rows="30" name="pdescription" cols='100'>Enter text here</textarea>
        <br>
        <button type="submit" name="post_submit">Post</button>
    </form>
<?php
    require "footer.php";
?>