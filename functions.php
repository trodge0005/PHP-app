<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function set_date(){
  global $date;
  //print the table for summary and search
  if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if (empty($_GET['date'])){
        $date = date('Y-m-d');
    } 
    else {
        $date = test_input($_GET['date']);
    }
  }
}

function print_forms($toggle){
  global $date;
  global $counter;
  $value_date = (isset($_GET['date'])) ? htmlspecialchars($_GET['date']) : '';
  $value_id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : '';
  $value_prev = date("Y-m-d", strtotime($date . " -1 day"));
  $value_next = date("Y-m-d", strtotime($date . " +1 day"));
  echo '<div>';
  echo '<div>';
  //echo '<br>';
  echo '<form action="summary.php" method="get">';
  echo 'Search By Date: <input id="search" name="date" type="text" placeholder="YYYY-MM-DD" value="'.$value_date.'"> ';
  echo '<input id="submit" type="submit" value="Sumbit">';
  echo '</form>';
  echo '<br><br>';
  echo '<form action="search.php" method="get">';
  echo 'Search By Asteroid ID: ';
  echo '<input id="search" name="id" type="text" placeholder="xxxxxxx" value="'.$value_id.'"> ';
  echo '<input id="submit" type="submit" value="Submit"><br><br>';
  echo '</form>';
  echo '</div>';
  echo '<div>';
  echo '<div id="left">';
  echo '<form action="summary.php" method="get">';
  echo '<button name="date" value="'.$value_prev.'">Previous Day</button>';
  echo '</form>';
  if($toggle==1){
    echo '<p>Results: '.$counter.' out of '.sizeof($_SESSION['asteroids']).'</p>';
  }
  else{
    echo '<p>Results: '.sizeof($_SESSION['asteroids']).'</p>';
  }
  echo '</div>';
  echo '<div id="right">';
  echo '<form action="summary.php" method="get">';
  echo '<button name="date" value="'.$value_next.'">Next Day</button>';
  echo '</form>';
  echo '<p>Date: ' .$date.'</p>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
}

function print_table(){
  echo "<table>
      <tbody>
      <tr>
      <th>Name</th>
      <th>Asteroid ID</th>
      <th>Relative Velocity (mph)</th>
      <th>Miss Distance (Miles)</th>
      <th>Nasa Link</th>
      <th>Asteroid Info</th>
      ";
}

function close_table(){
  echo "</table></tbody>";
}

function search_news( $keyword, $location ){
  //access asteroids array
  global $all_asteroids;
  //display search query
  echo "<h4>Searching for \"$location\" fields that cointains \"$keyword\"</h4>";
  //write in the table labels
  print_table();
  //create an accumulator to count the number of results are found in the array
  global $counter;
  //initialize
  $counter = 0;
  //print the results into a table
  for( $i=0; $i<sizeof($all_asteroids); $i++ ){
      if( stripos( $all_asteroids[$i]->get_id(), $keyword ) !== false ){
          $counter = $counter+1;
          echo $all_asteroids[$i]->print_info_date();
          echo "<td> <a href=\"dertails.php?id=".$all_asteroids[$i]->get_id()."\">More Info</a></td></tr>";
      }
      
  }
}

function display_nasa() {
  echo "<div>";
  $nasa_logo = "https://www.nasa.gov/sites/default/files/thumbnails/image/nasa-logo-web-rgb.png";
  echo "<img src=\"".$nasa_logo."\" width=\"280\" height=\"125\" title=\"Logo of Nasa\" alt=\"Logo of Nasa\">";
  echo "</div>";
}

function display_error() {
	global $errors;
	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function db_connect(){
  // server IP
  $server = "localhost";
  //database name
  $db = "nasa";
  //connect to mysql server
  global $conn;
  @$conn = new mysqli( $server, 'root', '', $db );
  if( $conn->connect_error ) {
    die("<div>Login failed: " . $conn->connect_error . "</div>");
  }
}

function register() {

  global $conn, $username, $email, $errors;
  $email = test_input($_POST['email']);
  $username = test_input($_POST['username']);
  $password = test_input($_POST['password']);
  $password2 = test_input($_POST['password2']);
  //valid username characters
  $accept_char = array('-', '_');
  //display errors if no data is provided
  if (empty($username)) { 
		array_push($errors, "Username is required"); 
  }
  elseif (strlen($username) < 3) { 
    array_push($errors, "Username must be atleast 3 characters long");
  }
  elseif (strlen($username) >= 20) { 
		array_push($errors, "Username must be less than 20 characters long"); 
  }
  //if there is characters that are not accepted or alpha numerical display an error
  elseif (!ctype_alnum(str_replace($accept_char, '', $username))){
    array_push($errors, "Username must only contain characters or digits");
  }
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
  }
  //display errors if fields are inputted incorrectly
  elseif (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)){
    array_push($errors, "Invalid email");
  }
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
  }
  elseif (strlen($password) >= 50) { 
		array_push($errors, "Password must be less than 50 characters long"); 
  }
  elseif ((strlen($password) <= 5) && (strlen($password) >= 1)) { 
		array_push($errors, "Password must be atleast 6 characters long"); 
  }
  //regex for password validation:
  $pattern2 = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?=.*\d)[a-zA-Z\d\W]{6,}$/';
  //if password isnt 6 char long or doesnt have 1 lower, 1 upper, 1 digit, or 1 special display error
  if (!preg_match($pattern2, $password) && (strlen($password) >= 1)) { 
    array_push($errors, "Password must contain one digit, lowercase, uppercase, and special character");
  }
  if ($password != $password2) {
    array_push($errors, "The two passwords do not match");
  }
  //check to see if username or email is taken already
  if(isset($username) || isset($email)){
    //sql statement to search for the username that was inputed on the form
    $check = "SELECT * FROM users WHERE username = '$username'";
    $check2 = "SELECT * FROM users WHERE email = '$email'";
    //query the database with the search statement
    $dup = $conn->query( $check );
    $dup2 = $conn->query( $check2 );
    //if there is a result, username is already taken
    if( $dup->num_rows >= 1) {
      array_push($errors, "Username taken");
    }
    if( $dup2->num_rows >= 1) {
      array_push($errors, "Email is already in use");
    }
  }  
  // if no errors insert new user into database
  if (count($errors) == 0) {
    //hash the password
    $hash_password = hash('sha1', $password);
    //create an insert statement with new user data
    $sql = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$hash_password')";
    //query database to insert new user
    $conn->query( $sql );
    //set the session variables that way the user stays logged in
    $_SESSION['user'] = $username;
    $_SESSION['logged']  = true;
    //display user details and redirect
    header('location: landing.php');
  }
}

function login(){
  global $conn, $username, $errors;
  $username = test_input($_POST['username']);
  $password = test_input($_POST['password']);
  //if the fields are empty produce an error
  if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($password)) { 
    array_push($errors, "Password is required");
  } 
  //if the username and password contain data proceed to check if it is correct
  if (count($errors) == 0) {
    //search database for rows where the username and password match
    $hash_password = hash('sha1', $password);
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hash_password'";
    //query database
    $result = $conn->query( $sql );
    //if there is a row in the users table that means user entered correct information
    if ( $result->num_rows == 1) {
      //get the information for the user
      $user = $result->fetch_assoc();
      //set the session variables that way the user stays logged in
      $_SESSION['user'] = $username;
      $_SESSION['logged']  = true;
      //fancy up the the logged in screen
      header('location: landing.php');
    }
    else {
      //redirect to login page if user enters incorrect info
      array_push($errors, "Incorrect Password");
    }   
  }
}

function log_out(){
   //logs the user out if they click the log out link
   if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    unset($_SESSION['logged']);
    header("location: login.php");
  }
}

?>