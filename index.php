<?php

/**
 * @file index.php
 * @description Show homepage of GG-Tracker using a basic map with auto update of markers 
 * @author Ebo Eppenga
 * @copyright 2013
 */

header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.

// Get location
include "get.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="GG-Tracker tracks your mobile device or cellphone via the internet and is a lightweight OpenGTS/(NMEA/)$GPRMC server." />
    <meta name="keywords" content="tracking, mobile, devices, cellphone, track, trace, location, latitude, longitude, open source, GPRMC, NMEA, OpenGTS" />
    <meta name="author" content="Ebo Eppenga" />
    <link rel="shortcut icon" href="favicon.png" />
    <title>GG-Tracker - GPS and GSM Tracking</title>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet" />
    <link href="css/google-maps.css" rel="stylesheet" />    

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--['if lt IE 9']>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <!['endif']-->
    
    <!-- Google Maps script --><?php include "script_live.php"; ?>
  </head>

  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">
    
      <!-- Menu --><?php include "menu.php" ?>
      
      <!-- Page content -->
      <div class="container">
      
        <?php if (($row_count > 10) && ($row_count < 25)) { ?>
          <?php if (!file_exists('remove_message.txt')) { ?>
        <!-- Buy me a coffee -->
        <div class="panel panel-success">
          <div class="panel-heading">
            <h2 class="panel-title">Please buy me a coffee</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-8">
                <p>
                  The development of GG-Tracker has taken hundreds of hours in development and
                  it would be great if only the costs of hosting and hardware could be funded thanks to you.
                </p>
                <p>
                  <a href="remove_message.php">Never show this message again</a>, alternatively
                  you could also consider <a href="http://sourceforge.net/projects/gg-tracker/reviews/new" target="_blank">writing a review</a>.  
                </p>
              </div>
              <div class="col-md-4 text-center">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                  <input type="hidden" name="cmd" value="_s-xclick" />
                  <input type="hidden" name="hosted_button_id" value="3L752AGZHRNR8" />
                  <input type="image" src="http://tracker.eppenga.com/images/buymecoffee.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
                  <img alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif" width="1" height="1" />
                </form>
              </div>
            </div>
          </div>
        </div>
          <?php } ?>
        <?php } ?>
        
        <!-- Google maps -->
        <div class="panel panel-info">
          <div class="panel-heading">
            <a href="fullscreen_index.php"><img src="images/maximize.png" alt="maximize screen" class="pull-right" /></a>
            <h2 class="panel-title">Basic map</h2>            
          </div>
          <div class="panel-body">
            <div id="map-canvas"></div>
          </div>
        </div>
        
        <!-- GG-Tracker Information --><?php include "information.php"; ?>
        
      </div>
    </div>
    
    <!-- Footer --><?php include "footer.php"; ?>

  </body>
</html>
