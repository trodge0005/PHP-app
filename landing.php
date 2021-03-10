<html>
<head>
<link rel="stylesheet" href="css/nasa_css.css">
<title>My Account</title>
</head>
<body>


<?php

  //require('functions.php');

  //start session
  session_start();
  include 'header.php';
  echo "<div id='bg'>";
  echo "<div id='content'>";
  display_nasa();
  //if user is logged in display welcome banner
  if (isset($_SESSION['logged'])){
    echo "<div>";
    echo "<h4>You are now logged in as: ".$_SESSION['user']."<h4><br><br>";
    echo "Go to the <a href=\"summary.php\">Summary</a> page.";
    echo "</div>";
    echo "</div>";
    include 'footer.php';
    echo "</div>";
  }
  // if session variable logged in is not set, redirect to login page
  else{
  header('Location: login.php');
  }

?>
</body>
</html>
