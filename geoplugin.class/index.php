<?php


require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();

$geoplugin->locate();
$latitude=$geoplugin->latitude;
$longitude=$geoplugin->longitude;
$Country= $geoplugin->countryName;

echo "Geolocation results for {$geoplugin->ip}: <br />\n".

	"Country Name: {$Country} <br />\n".
	"Latitude:   {$latitude}<br />\n".
	"Longuitude: {$longitude}<br />\n";

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple Markers</title>
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

      function initMap() {
        var myLatLng = {lat: -25.363, lng: 131.044};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzQaIfFIwObTdRUBIsiXKk6tPbpns1hhQ&callback=initMap">
    </script>
  </body>
</html>