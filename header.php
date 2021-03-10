
<?php
    require('functions.php');
    //session_start();
    
    //display username welcome  
    echo "<div id='header'>";
    echo "Welcome: ".$_SESSION['user'];
    //link sets the session variable 'logout' to 1 when clicked. otherwise it is not set.
    echo "<br><a href=\"summary.php?logout='1'\" style=\"color: red;\">logout</a>";
    echo "</div>";
    //log link sets the 'logout' session variable to 1
    //if the logout variable is set to 1, the session variables are destroyed 
    //and user returns to login screen
    log_out();

?>
