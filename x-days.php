<?php

/**
 * @file gmaps_x-days.php
 * @description Loads the last x locations based on URI parameter days=<days>
 * @author Ebo Eppenga
 * @copyright 2013
 */

// Get location
include "get.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Ebo Eppenga" />
    <link rel="shortcut icon" href="favicon.png" />
    <title>GG-Tracker - GPS and GSM Tracking - X Days</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet" />
    <link href="css/google-maps.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    
    <!-- Google X-Days script --><?php include "script_x-days.php"; ?>
  </head>

  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">
    
      <!-- Menu --><?php include "menu.php" ?>
      
      <!-- Page content -->
      <div class="container">
        
        <!-- Google maps -->
        <div class="panel panel-info">
          <div class="panel-heading">
            <a href="fullscreen_x-days.php?days=<?php echo $days; ?>"><img src="images/maximize.png" alt="maximize screen" class="pull-right" /></a>
            <h2 class="panel-title"><?php echo $days; ?>-Days</h2>            
          </div>
          <div class="panel-body">
            <div id="map-canvas"></div>
          </div>
        </div>
        
        <!-- GG-Tracker Information --><?php include "information.php"; ?>
        
      </div>
    </div>
    
    <!-- Footer --><?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
