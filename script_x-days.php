<?php

/**
 * @file gmaps_x-days.php
 * @description Builts the Google Maps script for x-days 
 * @author Ebo Eppenga
 * @copyright 2013
 */

// Get variables from URI
$days = $_GET['days']; // Number of days to proces

// Prepare a flightpath for the last x days
function flightpath($days = 1) {

  // Only execute if within limits, prevent database overload
  if (($days > 100) || ($days < 1) || (!is_numeric($days))) {
    echo 'Please specify a correct number of days (maximum 100 days)';
    return;
  }

  // Load the basics
  include "config.php";

  // Define script parts of flightpath
  $flightpath_part[0] = "<script>
      function initialize() {
        var myLatLng = new google.maps.LatLng(";
        
  $flightpath_part[1] = ");
        var mapOptions = {
          zoom: 11,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
      
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      
        var flightPlanCoordinates = [
";
        
  $flightpath_part[2] = "
        ];
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });
      
        flightPath.setMap(map);
      }
      
      google.maps.event.addDomListener(window, 'load', initialize);

    </script>
";
    
  
  // Open MySQL
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if (mysqli_connect_errno()) {
    echo 'Connection with MySQL database failed!';
    exit();
  }
  $query = "SELECT `log`, `lat`, `lon` FROM `location` WHERE `log` >= ( DATE_SUB( CURDATE( ), INTERVAL " . ($days -1) . " DAY ) ) ORDER BY `log` ASC";
  $result = mysqli_query($conn, $query);
  $rowcount = mysqli_num_rows($result);
  
  if ($rowcount == 0) {
    echo "<br /><br /><br /><center><p>You have no locations in your database for this period!</p></center>";
  } else {
  $lat_sum = 0;
	$lon_sum = 0;
	$loc_sum = 0;
	$flightpath = '';
    // Write the coordinates to a string
    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
       foreach ($line as $col_value) {
    		$lon = $line['lon'];
    		$lat = $line['lat'];
        $lon_sum = $lon_sum + $lon;
        $lat_sum = $lat_sum + $lat;
        $loc_sum = $loc_sum + 1;
     		if ($lon && $lat) {
    			$flightpath .= "          new google.maps.LatLng(";
    			$flightpath .= $line['lat'];
    			$flightpath .= ", ";
    			$flightpath .= $line['lon'];
    			$flightpath .= "),\r\n";
    		}
    	}
    }
    
    // Calculate center of map
    $lon_center = $lon_sum / $loc_sum;
    $lat_center = $lat_sum / $loc_sum;
    $flightpath = substr_replace($flightpath, "", -3);
  
    // Built result string
    $flightpath = $flightpath_part[0] . $lat_center . ', ' . $lon_center . $flightpath_part[1] . $flightpath . $flightpath_part[2];    
  }

  // Close MySQL
  mysqli_close($conn);

  // Return result
  return $flightpath;
}

?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;libraries=visualization"></script>    
    <?php echo flightpath($days); ?>
