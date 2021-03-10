<html>
<head>
<link rel="stylesheet" href="css/nasa_css.css">
<title>Search Asteroids</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php

    //import the Asteroid class
    require('Asteroid.php');

    //start a session that way data can be shared between scripts
    session_start();

    //password protect. display info is user is logged in
    if (isset($_SESSION['logged'])){
        //display header
        include 'header.php';
        //access asteroid array
        $all_asteroids = $_SESSION["asteroids"];
        //retrieve search query
        $keyword = $_GET["id"];
        echo "<div id='bg'>";
        echo "<div id='content'>";
        //access logo
        display_nasa();
        echo "<h1>Near Earth Objects</h1>";
        //set date again for search buttons
        set_date();   
        //run query through function
        search_news( $keyword, "id" );
        print_forms(1);
        close_table();
        echo "</div>";
        include 'footer.php';
        echo "<div>";
    }
    else{
        header('Location: login.php');
    }
?>