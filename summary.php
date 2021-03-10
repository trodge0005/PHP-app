<html>
<head>
<link rel="stylesheet" href="css/nasa_css.css">
<title>Near Earth Objects</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>


<?php

    //import the Asteroid class
    require('Asteroid.php');
    //personally generated api key
    session_start();


    //start a session to share data. 
    if (isset($_SESSION['logged'])) {
        //display header
        include 'header.php';
        $_SESSION["api_key"] = "QBZm0Zvbi697BjT3GiHcScgwd7z3lvaMtkbSzyRY";
        //display logo
        echo "<div id='bg'>";
        echo "<div id='content'>";
        display_nasa();
        echo "<h1>Near Earth Objects</h1>";
        echo "<h4>Search by Date or ID to view Asteroids tracked by Nasa</h4>";
        set_date();
        //api call to nasa asteroid data base
        $jsonAsteriods = @file_get_contents("https://api.nasa.gov/neo/rest/v1/feed?start_date=".$date."&end_date=".$date."&api_key=" .$_SESSION["api_key"]);
        //store json data in an array
        $data = json_decode($jsonAsteriods, true);
        //array of asteroid objects
        $all_asteroids = [];

        for($i=0; $i<@sizeof($data["near_earth_objects"][$date]); $i++) {
            $asteroid = new Asteroid(
            $data["near_earth_objects"][$date][$i]["name"],
            $data["near_earth_objects"][$date][$i]["id"],
            $data["near_earth_objects"][$date][$i]["close_approach_data"][0]["close_approach_date"],
            number_format($data["near_earth_objects"][$date][$i]["close_approach_data"][0]["relative_velocity"]["miles_per_hour"], 0, '.', ','),
            number_format($data["near_earth_objects"][$date][$i]["close_approach_data"][0]["miss_distance"]["miles"], 0, '.', ','),
            $data["near_earth_objects"][$date][$i]["nasa_jpl_url"],
            "https://www.neowsapp.com/rest/v1/neo/".$data["near_earth_objects"][$date][$i]["id"]."?api_key=" .$_SESSION["api_key"]);
            array_push($all_asteroids, $asteroid);
        }
        //make the array available to other scripts
        $_SESSION['asteroids'] = $all_asteroids;
        //display labels for asteroid table
        print_table();
        print_forms(0);
        //print all asteroid objects into table
        for($i=0; $i<sizeof($all_asteroids); $i++){
            $all_asteroids[$i]->print_info_date();
            echo "<td> <a href=\"dertails.php?id=".$all_asteroids[$i]->get_id()."\">More Info</a></td></tr>";
        }
        close_table();
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
