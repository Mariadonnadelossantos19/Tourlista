<!DOCTYPE html>
<?php
include '../../cms/connection/connection.php';
$sql = "Select * from accommodation_establishment where approve_status = '1' and geolocation <> ''";
$sql2 = "Select * from tourist_attraction where approve_status = '1' and geo_location <> ''";
$accomp = "";
$attract = "";

//For the accommodation establishments
$result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $accomp .="['".addslashes($row['ae_name'])."',".trim($row['geolocation'],'()').",".$row['ae_id']."],";
      }
  }
$accomp = substr($accomp, 0, -1);

//For the tourist attractions

$result2 = mysqli_query($conn, $sql2);
  if (mysqli_num_rows($result2) > 0) {
      while($row2 = mysqli_fetch_assoc($result2)) {
        $attract .="['".addslashes($row2['ta_name'])."',".trim($row2['geo_location'],'()').",".$row2['ta_id']."],";
      }
  }
$attract = substr($attract, 0, -1);
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
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

      // The following example creates complex markers to indicate beaches near
      // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
      // to the base of the flagpole.


      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 12, lng: 120}
        });

        setMarkers(map);
        setMarkers2(map);
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

    </script>
    <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZ9X84e00BPQ_LHTqgapBqCKrkSwFPrFU&callback=initMap">
    </script>
    <script src="../cms/bower_components/jquery/dist/jquery.min.js"></script>
    </body>
    </html>
