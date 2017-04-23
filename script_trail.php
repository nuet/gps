<?php

/**
 * @file script_trail.php
 * @description Loads the Google Maps script with a trail 
 * @author Ebo Eppenga
 * @copyright 2013
 */

?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
    <script>
      function initialize() {
        var myLatlng = new google.maps.LatLng(<?php echo $loc['lat']; ?>,<?php echo $loc['lon']; ?>);
        var mapOptions = {
          zoom: 14,
          center: myLatlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'GPS and GSM Tracking'
        });
        
        var flightPlanCoordinates = [
            new google.maps.LatLng(<?php echo $pos[0]['lat']; ?>, <?php echo $pos[0]['lon']; ?>),
            new google.maps.LatLng(<?php echo $pos[1]['lat']; ?>, <?php echo $pos[1]['lon']; ?>),
            new google.maps.LatLng(<?php echo $pos[2]['lat']; ?>, <?php echo $pos[2]['lon']; ?>),
        ];
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });
      
        flightPath.setMap(map);
        
        var contentString = '<?php echo $pos[0]['mes']; ?>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            minWidth: 500            
        });
        
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map,marker);
        });
        
      }
      
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
