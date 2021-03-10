<html>
<head>
<style>
</style>
<title>Login</title>
<link rel="stylesheet" href="css/nasa_css.css">
</head>
<body>

<?php
  require('functions.php');
  //start session
  session_start();
  //if user is not already logged in connect to database and login
  if (!isset($_SESSION['logged'])){
    echo "<div id='bg'>";
    echo "<div id='content'>";
    //display logo and connect to database
    display_nasa();
    echo "<h1>Near Earth Objects</h1>";
    echo "<h4>Log in to view Asteroid Data</h4>";
    db_connect();
    //intialiaze username
    $username = '';
    //array to display specific errors
    $errors  = array();
    //when sign in button is clicked login user in with given input
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      login();
    }
  }
  //if user is already logged in redirect to landing
  else{
    header('Location: landing.php');
  }
?>
<div>
<form action="login.php" method="post">
<?php echo display_error(); ?>
Username: <input type="text" name="username" value="<?php echo $username; ?>"><br><br>
Password: <input type="password" name="password"><br><br>
<input id="submit" type="submit" value="Sign In">
</form>
<br>Not a member? <a href="register.php">Sign up</a>
</div>

<?php
  echo "</div>";
  include 'footer.php';
  echo "</div>";
?>

</body>
</html>