<?php

/**
 * @file menu.php
 * @description Built top menu of GG-Tracker 
 * @author Ebo Eppenga
 * @copyright 2013
 */

?>

      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">GPS/GSM-Tracker</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Google Maps <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header">Maps</li>
                  <li><a href="index.php">Basic map</a></li>
                  <li><a href="trail.php">Trail map</a></li>                  
                  <li><a href="heatmap.php">Heatmap</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Periods</li> 
                  <li><a href="x-days.php?days=1">Today</a></li>
                  <li><a href="x-days.php?days=7">Week</a></li>
                  <li><a href="x-days.php?days=30">Month</a></li>                    
                </ul>
              </li>               
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Google Earth <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="gearth_now.kml">Now</a></li>
                  <li><a href="gearth_1.kml">Today</a></li>
                  <li><a href="gearth_7.kml">Week</a></li>
                  <li><a href="gearth_30.kml">Month</a></li>
                </ul>
              </li><?php if ($about) { ?>
              <li><a href="http://www.eppenga.com/gsm-gps-tracking.html">About</a></li>
              <li><a href="http://www.eppenga.com/about/contact.html">Contact</a></li>
              <li><a href="http://sourceforge.net/projects/gg-tracker/">Download</a></li><?php } ?> 
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
