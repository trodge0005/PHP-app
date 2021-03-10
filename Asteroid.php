<?php

class Asteroid {

    private $name;
    private $id;
    private $date;
    private $velocity;
    private $distance;
    private $nasa_jpl;
    private $link;

    function __construct($name, $id, $date, $velocity, $distance, $nasa_jpl, $link) {
        $this->name = $name;
        $this->id = $id;
        $this->date = $date;
        $this->velocity = $velocity;
        $this->distance= $distance;
        $this->nasa_jpl = $nasa_jpl;
        $this->link = $link;
    }

    //creating a table when user searches by date
    function print_info_date() {
        echo "<tr>
        <td>".$this->name."</td>
        <td>".$this->id."</td>
        <td>". $this->velocity." </td>
        <td>" .$this->distance." </td>
        <td> <a href='".$this->nasa_jpl."'>Nasa JPL</a></td>
        ";
    }       

    
    function get_name() {
        return $this->name;
    }

    function get_id() {
        return $this->id;
    }

    function get_date() {
        return $this->date;
    }

    function get_velocity() {
        return $this->velocity;
    }

    function get_distance() {
        return $this->distance;
    }

    function get_nasajpl() {
        return $this->nasa_jpl;
    }
       

}
?>