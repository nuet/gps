<?php

/**
 * @file remove_message.php
 * @description Thank user for using GG-Tracker  
 * @author Ebo Eppenga
 * @copyright 2013
 */

include "config.php";
file_put_contents('remove_message.txt', 'Thank you!');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Ebo Eppenga" />
    <link rel="shortcut icon" href="favicon.png" />
    <title>GG-Tracker - GPS and GSM Tracking - Heatmap</title>

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
            <h2 class="panel-title">Thank you!</h2>            
          </div>
          <div class="panel-body">
            <p><b>GG-Tracker can only continue to exist because you are using the application!</b></p> 
            <p>
            Your contribution is therefore highly appreciated. Please feel free
            to contact me and send me your remarks or questions.</p>
            <p>Kind regards,</p>
            <p><a href="http://www.eppenga.com/contact.html">Ebo Eppenga</a></p> 
          </div>
        </div>
      </div>
    </div>
    
    <!-- Footer --><?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
