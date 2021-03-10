<html>
<head>
<link rel="stylesheet" href="css/nasa_css.css">
<title>Asteroid Details</title>
</head>
<body>

<?php

    require('Asteroid.php');

    //start a session that way data can be shared between scripts
    session_start();

    if (isset($_SESSION['logged'])) {
        //display header
        include 'header.php';

        //retrieve asteriods from array
        $asteroid = $_SESSION["asteroids"];
        //gets the one asteroid with the ID
        for( $i=0; $i<sizeof($asteroid); $i++ ){
        
            if( $asteroid[$i]->get_id() === $_GET["id"] ){
                //make a second API call to the database for more information on this specific asteroid
                $jsonAsteriods = file_get_contents("https://www.neowsapp.com/rest/v1/neo/". $asteroid[$i]->get_id() ."?api_key=".$_SESSION["api_key"]);
                $data = json_decode($jsonAsteriods, true);
                echo "<div id='bg'>";
                echo "<div id='content'>";
                display_nasa();
                //pull data from asteroid object already instantiated
                echo "<h1>Asteroid: ".$asteroid[$i]->get_name()."</h1>";
                echo "<div><table><tr><p><td><a href=\"".$asteroid[$i]->get_nasajpl()."\">View Nasa JPL page</a></td></p>";
                echo "<p><td><a href=\"summary.php\">Search New Asteroid</a></td></tr></p>";
                echo "<tr><th>ID: </th><td>".$asteroid[$i]->get_id()."</td></tr>";
                echo "<tr><th>Close Approach Date: </th><td>".$asteroid[$i]->get_date()."</td></tr>";
                //start using data from 2nd api call
                //finds the last index of close approach data
                echo "<tr><th>Initial Relative Velocity: </th><td>".number_format(end($data["close_approach_data"])["relative_velocity"]["miles_per_hour"], 0, '.', ',')."</td></tr>";
                echo "<tr><th>Initial Miss Distance: </th><td>".number_format(end($data["close_approach_data"])["miss_distance"]["miles"], 0, '.', ',')."</td></tr>";
                //finds the first index of the close approach data
                echo "<tr><th>Latest Relative Velocity: </th><td>".number_format($data["close_approach_data"][0]["relative_velocity"]["miles_per_hour"], 0, '.', ',')."</td></tr>";
                echo "<tr><th>Latest Miss Distance: </th><td>".number_format($data["close_approach_data"][0]["miss_distance"]["miles"], 0, '.', ',')."</td></tr>";
                //make a third api to the neo database for observation data
                $json_neo = file_get_contents("https://ssd-api.jpl.nasa.gov/sbdb.api?sstr=".$data["neo_reference_id"]);
                $neo_data = json_decode($json_neo, true);
                echo "<tr><th>Frist Observe Date: </th><td>".$neo_data["orbit"]["first_obs"]."</td></tr>";
                echo "<tr><th>Last Observe Date: </th><td>".$neo_data["orbit"]["last_obs"]."</td></tr></table></div>";
            }
        
        }
        echo "</div>";
        include 'footer.php';
        echo "</div>";
    }
    else{
        header('Location: login.php');
    }
?>
