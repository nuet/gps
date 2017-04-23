<?php

/**
 * @file get.php
 * @description Get location information from database
 * @author Ebo Eppenga
 * @copyright 2013
 */

include "config.php";
include "last_three.php";

// Open debug
if ($debug) {
  echo '<br /><br /><pre>';
}

// Get last known position
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
  echo 'Connection with MySQL database failed!';
  exit();
}

$query  = "SELECT * FROM `location` ORDER BY `log` DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$dbready = mysqli_num_rows($result); 
$loc = mysqli_fetch_array($result, MYSQLI_ASSOC);

$query = "SELECT COUNT(*) as TOTALFOUND FROM `location`";
$result = mysqli_query($conn, $query);
$row_count_array = mysqli_fetch_array($result, MYSQLI_ASSOC);
$row_count = $row_count_array['TOTALFOUND'];

if ($debug) {
  echo "Last known position dataset:\n";
  print_r($loc);
}
mysqli_close($conn);


// Check last three positions known
if ($loc_rows == 0) {
  echo '<br /><br /><br /><br /><br /><center><p><b>No locations in the database, please send a few more updates from your device!</b><br />';
  echo 'If you haven\'t installed an app yet on your device, please try ';
  echo '<a href="https://play.google.com/store/apps/details?id=com.softinnovation.gpstrackerlite" target="_blank">GPSTrackerLite</a> (free) or ';
  echo '<a href="https://play.google.com/store/apps/details?id=com.wiebej.gps2opengtsfree" target="_blank">GPS2OpenGTS</a> (trial and paid).<br />';
  echo 'If you need help with your setup please check <a href="INSTALL.TXT" target="_blank">INSTALL.TXT</a> first.</p></center>';
}

// Debug information
if ($debug) {
  echo "\nLast three locations:\n";
  print_r($pos[0]);
  print_r($pos[1]);
  print_r($pos[2]);
  echo "\nCalculations on last known locations:\n";
  echo "Distance: " . $distance . " meter\n";
  echo "Durance : " . $durance . " second\n";
  echo "Speed   : " . $speed . " meters/second\n";
  echo "Bearing : " . $bearing . " bearing in degrees\n";
}

// Close debug
if ($debug) {
  echo '</pre>';
}

?>