<?php

/**
 * @file put.php
 * @description Store location information in database
 * @author Ebo Eppenga
 * @copyright 2013
 */

// Load configuration and Google Earth
include "config.php";
include "math.php";
include "gearth.php";

// Use timestamp of webserver, device is not very thrustworthy
$log = date("Y-m-d H:i:s");

// Show what is received from device in debug mode
if ($debug) {
  echo '<pre>';
  echo "Log: " . $log . "\n\n";
  echo "Parameters: \n";
  print_r($_GET);
  echo "\n";
}

// Get variables from URI
$did = $_GET[$check_param];    // Secret key
$gprmc = $_GET[$gprmc_param];  // Valid position (true/false)

// Parse $GPRMC
$gprmc_data = explode(',',$gprmc);
$val = $gprmc[2];
$lat = DMStoDEC($gprmc_data[3], $gprmc_data[4], 'lattitude');
$lon = DMStoDEC($gprmc_data[5], $gprmc_data[6], 'longitude');

// Define IP address of device
$ipa = $_SERVER["REMOTE_ADDR"];

// Sanitize variables
if (!isset($did)) {$did = '#N/A';}
if (!isset($val) || (!is_numeric($val))) {$val = 0;}
if (!isset($lat) || (!is_numeric($lat))) {$lat = 0;}
if (!isset($lon) || (!is_numeric($lon))) {$lon = 0;}
if (!isset($ipa)) {$ipa = "0.0.0.0";}
if ($val == 'A')  {$val = 1;} else {$val = 0;}

// Show if everything is parsed ok in debug mode
if ($debug) {
  echo "\n" . 'After parsing' . "\n";
  echo 'Check: ' . $did . "\n";
  echo 'Valid: ' . $val . "\n";
  echo 'Latitude: ' . $lat . "\n";
  echo 'Longitude: ' . $lon . "\n\n";
}

// Is device allowed to store data?
if ($secure_key) {
  if (!strpos($_SERVER['QUERY_STRING'], $secure_key)) {
    echo 'Fatal error: your device is not allowed to store data!';
    exit();
  }
}

// Store data in MySQL
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
  echo 'Connection with MySQL database failed!';
  exit();
}
$query  = "INSERT INTO location (log, val, lat, lon, ipa) ";
$query .= "VALUES ('". $log ."', '". $val ."', '". $lat ."', '". $lon ."', '". $ipa ."')";

if ($debug) {
  echo "Query: \n" . $query . "\n";
}
mysqli_query($conn, $query);
mysqli_close($conn); 

// Create JSON file
include "last_three.php";
$positions = array(
  'loc1' => array('info' => $pos[0]['mes'], 'lat' => $pos[0]['lat'], 'lng' => $pos[0]['lon'], 'color' => 'images/car.png'),
);
file_put_contents('data.json', json_encode($positions));


// Google Earth archives
file_put_contents('gearth_1.kml', google_earth(1));
file_put_contents('gearth_7.kml', google_earth(7));
file_put_contents('gearth_30.kml', google_earth(30));

// Google Earth current location
include "gearth_now.php";

// Close debug info
if ($debug) {
  echo '</pre>';
}

// Show server response
echo $response;

?>