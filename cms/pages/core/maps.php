
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
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
              height: 100%;
              margin: 0;
              padding: 0;
            }
          </style>
        </head>
        <body>
            <div style="background: #FCF3CF;"><input type = "hidden" id="location" /><input class="btn btn-primary btn-sm" type = "button" value="clear location" onclick="clearLocation()" /></div>
            <div id="map"></div>
          <script>
            // Note: This example requires that you consent to location sharing when
            // prompted by your browser. If you see the error "The Geolocation service
            // failed.", it means you probably did not give permission for the browser to
            // locate you.
            var map, infoWindow;

            function clearLocation(){
              initMap();
              document.getElementById('location').value="";
              parent.document.getElementById('location').value="";
            }

            function addMarker(location) {
              var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 15, center: location});
                var marker = new google.maps.Marker({position: location, map: map});
                document.getElementById('location').value=location;
                parent.getLocation(location);
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
          </script>
          <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZ9X84e00BPQ_LHTqgapBqCKrkSwFPrFU&callback=initMap">
          </script>

        </body>
      </html>
