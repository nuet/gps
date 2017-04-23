<?php 

/**
 * @file math.php
 * @description Various mathematical functions
 * @author Ebo Eppenga
 * @copyright 2013
 */

// Converts DMS ( Degrees / minutes / seconds ) 
// to decimal format longitude / latitude
// Source: http://www.philippinestuffs.com/php-gps-parser-nmea-gprmc/

function DMStoDEC($dms, $hemi, $longlat){

  // Determine latitude
	if($longlat == 'lattitude'){
		$position = explode('.', $dms);
    $llll =  sprintf('%04d', $position[0]);
    $deg = substr($llll, 0, 2);
  	$min = substr($llll, 2, 2) . '.' . $position[1];
    $sec = '0';
    //$sec = substr($position[1], 0, 2) . '.' . substr($position[1], 0, 3);
	}

  // Determine longitude
	if($longlat == 'longitude'){
		$position = explode('.', $dms);
    $yyyy =  sprintf('%05d', $position[0]);
    $deg = substr($yyyy, 0, 3);
    $min = substr($yyyy, 3, 2) . '.' . $position[1];
    $sec = '0';
    //$sec = substr($position[1], 0, 2) . '.' . substr($position[1], 0, 3);
	}  

  $output = $deg + ((($min * 60) + ($sec)) / 3600);
  
  // Correct for hemisphere
  if (($hemi == 'S') || ($hemi == 'W')) {
    $output = -$output;
  }

  return $output;
}

// Calculate the great circle distance between two latitude/longitudes
// Source: http://www.weberdev.com/get_example.php3?count=357&mode=text

function great_circle_distance($lat1, $lon1, $lat2, $lon2) {
	$pi  =  3.1415926; 
	$rad  =  floatval($pi/180.0); 

	$lon1  =  floatval($lon1)*$rad;  $lat1  =  floatval($lat1)*$rad; 
	$lon2  =  floatval($lon2)*$rad;  $lat2  =  floatval($lat2)*$rad; 

	$theta  =  $lon2  -  $lon1; 
	$dist  =  acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($theta)); 
	if ($dist < 0) {
		$dist += $pi;
	} 
	$dist  =  round($dist  *  6371.2, 3) * 1000; // meters
	return $dist;
}

// Convert a value from degrees to radians
// Source: http://fil.ya1.ru/PHP_5_in_Practice/index.htm#page=0768667437/ch02lev1sec6.html

function _deg2rad_multi() {
  $arguments = func_get_args();
  return array_map('deg2rad', $arguments);
}

// This function calculates the initial bearing you need to travel
// from Point A to Point B, along a great arc.  Repeated calls to this
// could calculate the bearing at each step of the way.
// Source: http://fil.ya1.ru/PHP_5_in_Practice/index.htm#page=0768667437/ch02lev1sec6.html

function latlon_bearing_great_circle($lat_a, $lon_a, $lat_b, $lon_b) {
  // Convert our degrees to radians:
  list($lat1, $lon1, $lat2, $lon2) = _deg2rad_multi($lat_a, $lon_a, $lat_b, $lon_b);

  // Run the formula and store the answer (in radians)
  $rads = atan2(sin($lon2 - $lon1) * cos($lat2), (cos($lat1) * sin($lat2)) - (sin($lat1) * cos($lat2) * cos($lon2 - $lon1)));

  // Convert this back to degrees to use with a compass
  $degrees = rad2deg($rads);

  // If negative subtract it from 360 to get the bearing we are used to.
  $degrees = ($degrees < 0) ? 360 + $degrees : $degrees;

  return $degrees;
}

?>