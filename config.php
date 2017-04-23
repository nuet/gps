<?php

/**
 * @file config.php
 * @description Configuration for GG-Tracker 
 * @author Ebo Eppenga
 * @copyright 2013
 */

// MySQL information
$dbhost   = "213.171.218.234";
$dbuser   = "theosgus";
$dbpass   = "Vrobe1560";
$dbname   = "mygps";

// Usually this is the Account ID, Vehicle ID or any other ID. If left blank 
// then all connections are allowed (dangerous but easy on first run).
// Please also see the settings/README.txt for more information.  
$secure_key = "";

// $GPRMC Parameter, usually this is gprmc
$gprmc_param = "gprmc";

// Remove old markers, if not they form a trail
$remove = true;

// Show About and Contact menu items (true / false)
$about = true;

// Load Google Analytics (true / false)
$ganalytics = true;

// Server response after successful upload
$response = "OK";

// Show debug information (true / false)
$debug = false;

// Control error level: http://php.net/manual/en/function.error-reporting.php
error_reporting(E_ERROR | E_PARSE);

?>