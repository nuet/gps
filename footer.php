<?php

/**
 * @file footer.php
 * @description Built footer of GG-Tracker 
 * @author Ebo Eppenga
 * @copyright 2013
 */

?>

    <div id="footer">
      <div class="container">
        <p class="text-muted credit">
          Copyright 2014 by <a href="http://www.eppenga.com/contact" target="_blank">Ebo Eppenga</a>, 
          based on <a href="http://sourceforge.net/projects/opengts/" target="_blank">OpenGTS</a> /  
          <a href="http://aprs.gids.nl/nmea/" target="_blank">GPRMC</a> and 
          template by <a href="http://getbootstrap.com/" target="_blank">Bootstrap</a>.
        </p>
      </div>
    </div>

    <?php if ($ganalytics) { ?><!-- Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-1921732-11', 'auto');
      ga('send', 'pageview');
    
    </script>
    <?php } ?>
