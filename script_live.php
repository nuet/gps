<?php

/**
 * @file script_live.php
 * @description Loads the Google Maps script with auto refresh for the markers 
 * @author Ebo Eppenga
 * @copyright 2013
 */

?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
    <script type='text/javascript'> 
      $(function(){
      	var locations = {}; //A repository for markers (and the data from which they were contructed).
      	
      	//initial dataset for markers
      	var locs = {
      		1: { info:'<?php echo $pos[0]['mes']; ?>', lat:<?php echo $pos[0]['lat']; ?>, lng:<?php echo $pos[0]['lon']; ?>, color: 'images/car.png' }
      	};
        
      	var map = new google.maps.Map(document.getElementById('map-canvas'), {
      		zoom: 13,
      		center: new google.maps.LatLng(<?php echo $loc['lat']; ?>,<?php echo $loc['lon']; ?>),
      		mapTypeId: google.maps.MapTypeId.ROADMAP
      	});
     		var infowindow = new google.maps.InfoWindow();
        var trafficlayer = new google.maps.TrafficLayer();
        trafficlayer.setMap(map);
      	
      	var auto_remove = <?php echo $remove ?>; // When true, markers for all unreported locs will be removed.
      
      	function setMarkers(locObj) {
      		if(auto_remove) {
      			// Remove markers for all unreported locs, and the corrsponding locations entry.
      			$.each(locations, function(key) {
      				if(!locObj[key]) {
      					if(locations[key].marker) {
      						locations[key].marker.setMap(null);                   
      					}
      					delete locations[key];
      				}
      			});
      		}
      
      		$.each(locObj, function(key, loc) {
      			if(!locations[key] && loc.lat!==undefined && loc.lng!==undefined) {
      				// Marker has not yet been made (and there's enough data to create one).
      
      				// Create marker
      				loc.marker = new google.maps.Marker({
      					position: new google.maps.LatLng(loc.lat, loc.lng),
      					icon: loc.color,
                map: map
      				});
      
      				// Attach click listener to marker
      				google.maps.event.addListener(loc.marker, 'click', (function(key) {
      					return function() {
      						if(locations[key]) {
      							infowindow.setContent(locations[key].info);
      							infowindow.open(map, locations[key].marker);
      						}
      					}
      				})(key));
      
      				// Remember loc in the `locations` so its info can be displayed and so its marker can be deleted.
      				locations[key] = loc;
      			}
      			else if(locations[key] && loc.remove) {
      				// Remove marker from map
      				if(locations[key].marker) {
      					locations[key].marker.setMap(null);
      				}
      				// Remove element from `locations`
      				delete locations[key];
      			}
      			else if(locations[key]) {
      				// Update the previous data object with the latest data.
      				$.extend(locations[key], loc);
      				if(loc.lat!==undefined && loc.lng!==undefined) {
      					// Update marker position (maybe not necessary but doesn't hurt).
      					locations[key].marker.setPosition(
      						new google.maps.LatLng(loc.lat, loc.lng)
      					);
      				}
      				// locations[key].info looks after itself.
      			}
      		});
      	}
      
      	var ajaxObj = {// Object to save cluttering the namespace.
      		options: {
      			url: "data.json?nocache=" + (new Date()).getTime(), // The resource that delivers loc data made cache safe.
      			dataType: "json" // The type of data tp be returned by the server.
      		},
      		delay: 5000, // (milliseconds) the interval between successive gets.
      		errorCount: 0, // running total of ajax errors.
      		errorThreshold: 5, // the number of ajax errors beyond which the get cycle should cease.
      		ticker: null, // setTimeout reference - allows the get cycle to be cancelled with clearTimeout(ajaxObj.ticker);
      		get: function() { // a function which initiates 
      			if(ajaxObj.errorCount < ajaxObj.errorThreshold) {
      				ajaxObj.ticker = setTimeout(getMarkerData, ajaxObj.delay);
      			}
      		},
      		fail: function(jqXHR, textStatus, errorThrown) {
      			console.log(errorThrown);
      			ajaxObj.errorCount++;
      		}
      	};
      	
      	// Ajax master routine
      	function getMarkerData() {
      		$.ajax(ajaxObj.options)
      		  .done(setMarkers) // fires when ajax returns successfully
      		  .fail(ajaxObj.fail) // fires when an ajax error occurs
      		  .always(ajaxObj.get); // fires after ajax success or ajax error
      	}
      
      	setMarkers(locs);// Create markers from the initial dataset served with the document.
      	ajaxObj.get();// Start the get cycle.
      
      	// *******************
      	//test: simulated ajax
      	var testLocs = {
      		1: { info:'1. New Random info and new position', lat:51.933445, lng:4.250224 },//update info and position
      		2: { lat:0, lng:14.5144 },//update position
      		3: { info:'3. New Random info' },//update info
      		5: { info:'55555. Added', lat:0, lng:60 }//add new marker
      	};
      	setTimeout(function() {
      		setMarkers(ajaxObj);
      	}, ajaxObj.delay);
      	// *******************
      
      });
    </script>
