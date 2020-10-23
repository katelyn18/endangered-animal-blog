<?php
    require "header.php";
?>
    <h2>Admin</h2>
    <form action="includes/login.inc.php" method="post">
        <label>Name</label>
        <input type="text" name="name" placeholder="Name">
        <label>Password</label>
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="admin_submit">Login</button>
    </form>
<?php
    require "footer.php";
?>