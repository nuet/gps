<?php

/**
 * @file fullscreen_trail.php
 * @description Displays only the map with location in Google Maps in fullscreen with a trail
 * @author Ebo Eppenga
 * @copyright 2013
 */

include "get.php";

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta name="author" content="Ebo Eppenga" />
    <link rel="shortcut icon" href="favicon.png" />
    <title>GG-Tracker - GPS and GSM Tracking - Fullscreen Basic Map</title>
    
    <link href="css/google-maps-fullscreen.css" rel="stylesheet" />
    
    <?php include "script_basic.php"; ?>
  </head>

  <body>
    <div id="map-canvas"></div>
  </body>
</html>

