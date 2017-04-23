<?php

/**
 * @file last_three.php
 * @description Create the Google maps message screen 
 * @author Ebo Eppenga
 * @copyright 2013
 */

?>

<?php
include_once "math.php";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
  echo 'Connection with MySQL database failed!';
  exit();
}

// Get the last three locations
$query = "SELECT `log`, `lat`, `lon` FROM `location` ORDER BY `log` DESC LIMIT 3";
$result = mysqli_query($conn, $query);
$loc_rows = mysqli_num_rows($result);

// Fetch last three positions
$pos[0] = mysqli_fetch_array($result, MYSQLI_ASSOC);
$pos[1] = mysqli_fetch_array($result, MYSQLI_ASSOC);
$pos[2] = mysqli_fetch_array($result, MYSQLI_ASSOC);

// Calculate bearing and speed between last and previous location
$distance = great_circle_distance($pos[0]['lat'], $pos[0]['lon'], $pos[1]['lat'], $pos[2]['lon']);
$durance  = (strtotime($pos[0]['log']) - strtotime($pos[1]['log'])); 
if ($durance <> 0) {$speed = $distance / $durance;} else {$speed = 0;}
$bearing  = latlon_bearing_great_circle($pos[0]['lat'], $pos[0]['lon'], $pos[1]['lat'], $pos[2]['lon']);

// Built onscreen message
$c = count($pos) -1;
for ($i = 0; $i <= $c; $i++) {
  $pos[$i]['mes'] = "<p><b>GPS and GSM Tracking</b></p>";
  $pos[$i]['mes'] .= "<p>Date: " . $pos[$i]['log'] . "<br />";
  $pos[$i]['mes'] .= "Location: " . round($pos[$i]['lat'], 6) . " / " . round($pos[$i]['lon'], 6) . "<br />";
  if ($i == 0) {
    $pos[$i]['mes'] .= "Speed: " . round($speed, 0) . " km/h / " . round($bearing, 0) . "&deg; heading</p>";   
  }
  $pos[$i]['mes'] .= "<p><a href=\"index.php\" target=\"_top\">Return to GG-Tracker</a></p>";
}

mysqli_close($conn);

?>