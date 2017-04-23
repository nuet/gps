<?php

/**
 * @file gearth.php
 * @description Create a Google Earth XML file for the last X days 
 * @author Ebo Eppenga
 * @copyright 2013
 */

function google_earth($days) {
// Prepare an XML file for Google Earth

  include "config.php";
  
  // Open MySQL
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if (mysqli_connect_errno()) {
    echo 'Connection with MySQL database failed!';
    exit();
  }
  $query = "SELECT `log`, `lat`, `lon` FROM `location` WHERE `log` >= ( DATE_SUB( CURDATE( ), INTERVAL " . ($days -1) . " DAY ) ) ORDER BY `log` ASC";
  $result = mysqli_query($conn, $query);
  $dbready = mysqli_num_rows($result);

  // Execute only if there's data  
  if ($dbready > 0) {

  	// Start writing the XML
  	$gearth_placemarks = "
  	<Placemark>
  		<name>Distance of $days days</name>      
  		<styleUrl>#yellowLineGreenPoly</styleUrl>
  		<LineString>
  			<extrude>1</extrude>
  			<tessellate>1</tessellate>
  			<altitudeMode>absolute</altitudeMode>
  			<coordinates>\r\n";
  	
  	// Write the coordinates to the Google Earth XML file
  	while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  	   foreach ($line as $col_value) {
  			$lon = $line['lon'];
  			$lat = $line['lat'];
  			if ($lon && $lat) {
  				$gearth_placemarks .= "				";
  				$gearth_placemarks .= $line['lon'];
  				$gearth_placemarks .= ",";
  				$gearth_placemarks .= $line['lat'];
  				$gearth_placemarks .= "\r\n";
  			}
  		}
  	}
  	
  	// Close the Google Earth XML properly
  	 $gearth_placemarks .= "			</coordinates>
  		</LineString>
  	</Placemark>";
  
    // Open XML file with default header
    $gearth_header = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
    <kml xmlns=\"http://earth.google.com/kml/2.2\">
    	<Document>
    	<name>GG-Tracker</name>
    	<description>History of positions</description>
    	<Style id=\"yellowLineGreenPoly\">
    		<LineStyle>
    			<color>7f00ffff</color>
    			<width>4</width>
    		</LineStyle>
    		<PolyStyle>
    			<color>7f00ff00</color>
    		</PolyStyle>
    	</Style>";
  
    // Close XML file with default footer
    $gearth_footer .= "
    	</Document>
    </kml>";
  
    // Build Google Earth file
    $gearth_file = $gearth_header . $gearth_placemarks . $gearth_footer; 
  }
  
  // Close MySQL
  mysqli_close($conn);

return $gearth_file;
}

?>