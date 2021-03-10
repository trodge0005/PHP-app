<html>
<head>
<link rel="stylesheet" href="css/nasa_css.css">
<title>Register</title>
</head>
<body>

<?php
  require('functions.php');
  session_start();
  echo "<div id='bg'>";
  echo "<div id='content'>"; 
  //display logo
  display_nasa();
  echo "<h1>Near Earth Objects</h1>";
  echo "<h4>Sign Up to view Asteroid data</h4>";
  // connect to database
  db_connect();
  //intialize username and email
  $username = $email = '';
  //array to display specific errors
  $errors  = array();
  //if register button is pressed, register the user 
  if (isset($_POST['register'])){
    register();
  }
?>
<div>
<form action="register.php" method="post">
<?php echo display_error(); ?>
Email: <input type="email" name="email" value="<?php echo $email; ?>">
<br><br>Username: <input type="text" name="username" value="<?php echo $username;?>">
<br><br>Password: <input type="password" name="password">
<br><br>Confirm Password: <input type="password" name="password2">
<br><br><button type="submit" name="register">Sign Up</button>
</form>
<br>Already a member? <a href="login.php">Sign in</a>
</div>

<?php
  echo "</div>";
  include 'footer.php';
  echo "</div>";
?>

</body>
</html>