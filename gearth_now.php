<?php

/**
 * @file gearth_now.php
 * @description Make current location available to Google Earth
 * @author Ebo Eppenga
 * @copyright 2013
 */
	
//Create the content
$gearth_now = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<kml xmlns=\"http://earth.google.com/kml/2.2\">
<Document>
	<name>GG-Tracker</name>
	<Style id=\"sn_cabs\">
		<IconStyle>
			<color>bfffffff</color>
			<Icon>
				<href>http://maps.google.com/mapfiles/kml/shapes/cabs.png</href>
			</Icon>
			<hotSpot x=\"0.5\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
		</IconStyle>
		<ListStyle>
		</ListStyle>
	</Style>
	<Style id=\"sh_cabs\">
		<IconStyle>
			<color>bfffffff</color>
			<scale>1.2</scale>
			<Icon>
				<href>http://maps.google.com/mapfiles/kml/shapes/cabs.png</href>
			</Icon>
			<hotSpot x=\"0.5\" y=\"0\" xunits=\"fraction\" yunits=\"fraction\"/>
		</IconStyle>
		<ListStyle>
		</ListStyle>
	</Style>
	<StyleMap id=\"msn_cabs\">
		<Pair>
			<key>normal</key>
			<styleUrl>#sn_cabs</styleUrl>
		</Pair>
		<Pair>
			<key>highlight</key>
			<styleUrl>#sh_cabs</styleUrl>
		</Pair>
	</StyleMap>	
	<Placemark>
		<name>GG-Tracker</name>
		<description>Live Network Link</description>
		<styleUrl>#msn_cabs</styleUrl>		
		<Point>
			<coordinates>$lon,$lat,0</coordinates>    
		</Point>
	</Placemark>
</Document>
</kml>";

// Write file
file_put_contents('gearth_now.kml', $gearth_now);

?>
