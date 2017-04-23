<?php

/**
 * @file heatmap.php
 * @description Loads the Google Maps Heatmap script
 * @author Ebo Eppenga
 * @copyright 2013
 */

// Get the last positions 
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
  echo 'Connection with MySQL database failed!';
  exit();
}
$query  = "SELECT `log`, `lat`, `lon` FROM `location` ORDER BY `id` ASC LIMIT 10000";
$result = mysqli_query($conn, $query);
$rowcount = mysqli_num_rows($result);

if ($rowcount < 10) {
  echo "<br /><br /><br /><center><p>You need at least ten positions in your database to show a heatmap.</p></center>";
} else {

  // Get the coordinates
  $heatmap = "\n";
  $lon_sum = 0;
  $lat_sum = 0;
  $loc_sum = 0;
  while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
     foreach ($line as $col_value) {
  		$lon = $line['lon'];
  		$lat = $line['lat'];
      $lon_sum = $lon_sum + $lon;
      $lat_sum = $lat_sum + $lat;
      $loc_sum = $loc_sum + 1;
  		if ($lon && $lat) {
  			$heatmap .= "        new google.maps.LatLng(";
  			$heatmap .= $line['lat'];
  			$heatmap .= ", ";
  			$heatmap .= $line['lon'];
  			$heatmap .= "),\r\n";
  		}
  	}
  }
  
  // Calculate center of map
  $lon_center = $lon_sum / $loc_sum;
  $lat_center = $lat_sum / $loc_sum;
  $heatmap = substr_replace($heatmap, "", -2); 
}

mysqli_close($conn);

?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;libraries=visualization"></script>
    <script>
      // Adding Data Points
      var map, pointarray, heatmap;
      
      var ggtracker = [<?php echo $heatmap; ?>
      ];

      function initialize() {
        var mapOptions = {
          zoom: 9,
          center: new google.maps.LatLng(<?php echo $lat_center; ?>, <?php echo $lon_center; ?>),
          mapTypeId: google.maps.MapTypeId.SATELLITE
        };
      
        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
      
        var pointArray = new google.maps.MVCArray(ggtracker);
      
        heatmap = new google.maps.visualization.HeatmapLayer({
          data: pointArray
        });
      
        heatmap.setMap(map);
        
      }
      
      google.maps.event.addDomListener(window, 'load', initialize);

    </script>