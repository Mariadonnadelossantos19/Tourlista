<!DOCTYPE html>
<?php
include '../../cms/connection/connection.php';

// Check if we should show only TA or both
$show_only_ta = isset($_GET['show']) && $_GET['show'] == 'ta';
$show_only_ae = isset($_GET['show']) && $_GET['show'] == 'ae';

$sql = "Select * from accommodation_establishment where approve_status = '1' and geolocation <> ''";
$sql2 = "Select * from tourist_attraction where approve_status = '1' and geo_location <> ''";
$accomp = "";
$attract = "";

//For the accommodation establishments (only if not showing TA only)
if (!$show_only_ta) {
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $accomp .="['".addslashes($row['ae_name'])."',".trim($row['geolocation'],'()').",".$row['ae_id']."],";
        }
    }
    $accomp = substr($accomp, 0, -1);
}

//For the tourist attractions (only if not showing AE only)
if (!$show_only_ae) {
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        while($row2 = mysqli_fetch_assoc($result2)) {
            $attract .="['".addslashes($row2['ta_name'])."',".trim($row2['geo_location'],'()').",".$row2['ta_id']."],";
        }
    }
    $attract = substr($attract, 0, -1);
}
?>

<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="icon" href="../images/tl.png">
    <title>tourLISTA - Tourism Live-Inventory and Statistics of Tourist Arrivals</title>
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
      
      /* Filter buttons styling */
      .filter-controls {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1000;
        background: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        font-family: Arial, sans-serif;
      }
      
      .filter-controls h4 {
        margin: 0 0 10px 0;
        font-size: 14px;
        color: #333;
      }
      
      .filter-buttons {
        display: flex;
        gap: 5px;
      }
      
      .filter-btn {
        padding: 8px 12px;
        border: 1px solid #ddd;
        background: #f8f9fa;
        cursor: pointer;
        font-size: 12px;
        border-radius: 3px;
        transition: all 0.3s ease;
      }
      
      .filter-btn:hover {
        background: #e9ecef;
        border-color: #adb5bd;
      }
      
      .filter-btn.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
      }
      
      .filter-btn.active:hover {
        background: #0056b3;
        border-color: #0056b3;
      }
    </style>
  </head>
  <body>
    <!-- Filter Controls -->
    <div class="filter-controls">
      <h4>Filter Map</h4>
      <div class="filter-buttons">
        <button class="filter-btn active" onclick="filterMap('all')">Show All</button>
        <button class="filter-btn" onclick="filterMap('ae')">Show AE</button>
        <button class="filter-btn" onclick="filterMap('ta')">Show TA</button>
      </div>
    </div>
    
    <div id="map"></div>
    <script>

      // The following example creates complex markers to indicate beaches near
      // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
      // to the base of the flagpole.


      // Global variables for markers
      var aeMarkers = [];
      var taMarkers = [];
      var map;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 12, lng: 120}
        });

        <?php if (!$show_only_ta): ?>
        setMarkers(map);
        <?php endif; ?>
        
        <?php if (!$show_only_ae): ?>
        setMarkers2(map);
        <?php endif; ?>
      }

      // Data for the markers consisting of a name, a LatLng and a zIndex for the
      // order in which these markers should display on top of each other.
      var accomp = [<?php echo $accomp; ?>];
      var attract = [<?php echo $attract; ?>];
      var accDetails = "Click for details!";
      var attDetails = "Click for details!";

      function setMarkers(map) {
        // Adds markers to the map.

        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.

        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        var image = {
          url: '../images/hotels.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(30, 49),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 49)
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };


        for (var i = 0; i < accomp.length; i++) {
          var acc = accomp[i];
          var x = accomp[i][0];
          var marker = new google.maps.Marker({
            position: {lat: accomp[i][1], lng: accomp[i][2]},
            map: map,
            icon: image,
            shape: shape,
            title: accomp[i][0],
            zIndex: accomp[i][3]
          });

          // Store marker in global array for filtering
          aeMarkers.push(marker);

          var infoWindow = new google.maps.InfoWindow();
          google.maps.event.addListener(marker, 'mouseover', function () {
              var markerContent = this.getTitle();
              getAccDetails(markerContent);
              infoWindow.setContent("Click for Details!");
              infoWindow.open(map, this);
          });
          google.maps.event.addListener(marker, 'click', function () {
              var markerContent = this.getTitle();
              getAccDetails(markerContent);
              infoWindow.setContent(accDetails);
              infoWindow.open(map, this);
          });

        }

      }

      function setMarkers2(map) {
        // Adds markers to the map.

        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.

        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        var image = {
          url: '../images/attractions.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(30, 49),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 49)
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        for (var i = 0; i < attract.length; i++) {
          var att = attract[i];
          var marker = new google.maps.Marker({
            position: {lat: att[1], lng: att[2]},
            map: map,
            icon: image,
            shape: shape,
            title: att[0],
            zIndex: att[3]
          });

          // Store marker in global array for filtering
          taMarkers.push(marker);

          var infoWindow = new google.maps.InfoWindow();
          google.maps.event.addListener(marker, 'mouseover', function () {
              var markerContent = this.getTitle();
              getAttDetails(markerContent);
              infoWindow.setContent("Click for Details!");
              infoWindow.open(map, this);
          });
          google.maps.event.addListener(marker, 'click', function () {
              var markerContent = this.getTitle();
              getAttDetails(markerContent);
              infoWindow.setContent(attDetails);
              infoWindow.open(map, this);
          });

        }
      }

      function getAccDetails(x){
      //  accDetails = x;
        $.ajax({
          type: "GET",
          url: "acc_details.php",
          cache: false,
          data: {x},
          success: function(data){
            accDetails = data;
          }
        });
      }

      function getAttDetails(x){
      //  accDetails = x;
        $.ajax({
          type: "GET",
          url: "att_details.php",
          cache: false,
          data: {x},
          success: function(data){
            attDetails = data;
          }
        });
      }

      // Filter function to show/hide markers based on selection
      function filterMap(filterType) {
        // Update button states
        var buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(function(btn) {
          btn.classList.remove('active');
        });
        event.target.classList.add('active');

        // Show/hide markers based on filter
        if (filterType === 'all') {
          // Show all markers
          aeMarkers.forEach(function(marker) {
            marker.setMap(map);
          });
          taMarkers.forEach(function(marker) {
            marker.setMap(map);
          });
        } else if (filterType === 'ae') {
          // Show only AE markers
          aeMarkers.forEach(function(marker) {
            marker.setMap(map);
          });
          taMarkers.forEach(function(marker) {
            marker.setMap(null);
          });
        } else if (filterType === 'ta') {
          // Show only TA markers
          aeMarkers.forEach(function(marker) {
            marker.setMap(null);
          });
          taMarkers.forEach(function(marker) {
            marker.setMap(map);
          });
        }
      }

    </script>
    <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZ9X84e00BPQ_LHTqgapBqCKrkSwFPrFU&callback=initMap">
    </script>
    <script src="../cms/bower_components/jquery/dist/jquery.min.js"></script>
    </body>
    </html>
