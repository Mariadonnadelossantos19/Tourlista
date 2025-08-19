
      <!DOCTYPE html>
      <html>
        <head>
          <title>Geolocation</title>
          <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
          <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
          <meta charset="utf-8">
                     <style>
             /* Always set the map height explicitly to define the size of the div
              * element that contains the map. */
             #map {
               height: 100%;
               width: 100%;
               min-height: 300px;
             }
             /* Optional: Makes the sample page fill the window. */
             html, body {
               height: 100%;
               margin: 0;
               padding: 0;
               font-family: Arial, sans-serif;
             }
             
             /* Responsive container for the map */
             .map-container {
               position: relative;
               width: 100%;
               height: 100%;
               min-height: 300px;
             }
             
                                         .search-container {
                position: absolute;
                top: 10px;
                left: 10px;
                z-index: 1000;
                background: white;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.3);
                width: 300px;
                max-width: calc(100vw - 20px);
              }
              
              .search-container input {
                width: 200px;
                max-width: calc(100% - 70px);
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 3px;
                font-size: 14px;
              }
              
              .search-container button {
                margin-left: 5px;
                padding: 8px 12px;
                background: #007bff;
                color: white;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                font-size: 14px;
              }
              
              .search-container button:hover {
                background: #0056b3;
              }
              
              .controls-container {
                position: absolute;
                top: 10px;
                right: 10px;
                z-index: 1000;
                background: #FCF3CF;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.3);
                max-width: calc(100vw - 20px);
              }
              
              .controls-container button {
                font-size: 12px;
                padding: 6px 10px;
              }
             
                           /* Mobile responsive styles */
              @media (max-width: 768px) {
                .search-container {
                  width: calc(100vw - 20px);
                  left: 10px;
                  right: 10px;
                  top: 10px;
                }
                
                .search-container input {
                  width: calc(100% - 80px);
                  font-size: 16px; /* Prevents zoom on iOS */
                }
                
                .search-container button {
                  font-size: 16px;
                  padding: 8px 10px;
                }
                
                .controls-container {
                  top: auto;
                  bottom: 10px;
                  right: 10px;
                  left: auto;
                }
                
                .controls-container button {
                  font-size: 14px;
                  padding: 8px 12px;
                }
              }
             
             /* Small mobile devices */
             @media (max-width: 480px) {
               .search-container {
                 padding: 8px;
               }
               
               .search-container input {
                 width: calc(100% - 70px);
                 padding: 6px;
               }
               
               .search-container button {
                 padding: 6px 8px;
                 font-size: 14px;
               }
               
               .controls-container {
                 padding: 8px;
               }
               
               .controls-container button {
                 font-size: 12px;
                 padding: 6px 10px;
               }
             }
             
             /* Landscape orientation on mobile */
             @media (max-height: 500px) and (orientation: landscape) {
               .search-container {
                 top: 5px;
                 left: 5px;
                 right: 5px;
                 width: calc(100vw - 10px);
                 padding: 5px;
               }
               
               .controls-container {
                 top: 5px;
                 right: 5px;
                 bottom: auto;
                 padding: 5px;
               }
             }
           </style>
        </head>
                 <body>
             <div class="map-container">
               <div class="search-container">
                 <input type="text" id="searchInput" placeholder="Search for a location..." />
                 <button type="button" onclick="searchLocation()">Search</button>
               </div>
               <div class="controls-container">
                 <input type="hidden" id="location" />
                 <button class="btn btn-primary btn-sm" type="button" value="clear location" onclick="clearLocation()">Clear Location</button>
               </div>
               <div id="map"></div>
             </div>
          <script>
            // Note: This example requires that you consent to location sharing when
            // prompted by your browser. If you see the error "The Geolocation service
            // failed.", it means you probably did not give permission for the browser to
            // locate you.
            var map, infoWindow, searchBox, markers = [];

            function clearLocation(){
              initMap();
              document.getElementById('location').value="";
              parent.document.getElementById('location').value="";
              // Clear all markers
              markers.forEach(marker => marker.setMap(null));
              markers = [];
            }

            function addMarker(location) {
              // Clear existing markers
              markers.forEach(marker => marker.setMap(null));
              markers = [];
              
              var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 15, center: location});
                var marker = new google.maps.Marker({position: location, map: map});
                markers.push(marker);
                document.getElementById('location').value=location;
                parent.getLocation(location);
            }

            function searchLocation() {
              var searchInput = document.getElementById('searchInput');
              var searchTerm = searchInput.value.trim();
              
              if (!searchTerm) {
                alert('Please enter a location to search for.');
                return;
              }
              
              // Show loading message
              searchInput.disabled = true;
              searchInput.placeholder = 'Searching...';
              
              // Use Nominatim (OpenStreetMap) for geocoding - free and no API key required
              var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(searchTerm) + '&limit=1';
              
              fetch(url)
                .then(response => response.json())
                .then(data => {
                  if (data && data.length > 0) {
                    var location = {
                      lat: parseFloat(data[0].lat),
                      lng: parseFloat(data[0].lon)
                    };
                    
                    map.setCenter(location);
                    map.setZoom(15);
                    
                    // Clear existing markers
                    markers.forEach(marker => marker.setMap(null));
                    markers = [];
                    
                    // Add new marker
                    var marker = new google.maps.Marker({
                      position: location,
                      map: map
                    });
                    markers.push(marker);
                    
                    // Update location value
                    var locationString = "(" + location.lat + "," + location.lng + ")";
                    document.getElementById('location').value = locationString;
                    parent.document.getElementById('location').value = locationString;
                    
                                         // Keep the search term in the input field so user can see what was searched
                     // searchInput.value = ""; // Removed auto-clear
                  } else {
                    alert('Location not found. Please try a different search term.');
                  }
                })
                .catch(error => {
                  console.error('Error:', error);
                  alert('Search failed. Please try again.');
                })
                .finally(() => {
                  // Reset input
                  searchInput.disabled = false;
                  searchInput.placeholder = 'Search for a location...';
                });
            }

            function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 11.59, lng: 123.97},
                zoom: 10
              });

            google.maps.event.addListener(map, 'click', function(event) {
                  addMarker(event.latLng);
            });

              infoWindow = new google.maps.InfoWindow;

              // Try HTML5 geolocation.
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                  };

                  infoWindow.setPosition(pos);
                  infoWindow.setContent('Your Location');
                  infoWindow.open(map);
                  map.setCenter(pos);
                  parent.document.getElementById('location').value="("+pos.lat+","+pos.lng+")";
                }, function() {
                  handleLocationError(true, infoWindow, map.getCenter());

                });
              } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
              }
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
              infoWindow.setPosition(pos);
              infoWindow.setContent(browserHasGeolocation ?
                                    'Error: The Geolocation service failed.' :
                                    'Error: Your browser doesn\'t support geolocation.');
              infoWindow.open(map);
            }

            // Add event listener for Enter key on search input
            document.addEventListener('DOMContentLoaded', function() {
              document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                  searchLocation();
                }
              });
            });
          </script>
          <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZ9X84e00BPQ_LHTqgapBqCKrkSwFPrFU&libraries=places,geocoding&callback=initMap">
          </script>

        </body>
      </html>
