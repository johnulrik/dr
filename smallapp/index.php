<!DOCTYPE html>
<html>
  <head>
    <title>Showing pixel and tile coordinates</title>
    <meta name="viewport" content="initial-scale=1.0">
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
    <div id="map"></div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function drawMarkers( features, icon, map) {
            $.each(features, function(index, value) {
                var position = {lat: value.geometry.coordinates[0][1], lng: value.geometry.coordinates[0][0]};
                var marker = new google.maps.Marker({
                    position: position,
                    icon: icon,
                    map: map
                });
            });
        }

        function initMap() {
            var cph = new google.maps.LatLng(55.67, 12.592 );

            var map = new google.maps.Map(document.getElementById('map'), {
              center: cph,
              zoom: 13
        });

        $.getJSON("services.php?toilets")
          .done(function( json ) {
            var icon = 'http://maps.google.com/mapfiles/ms/icons/toilets.png';
            drawMarkers(json.features, icon, map);
          })
          .fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
        });

        $.getJSON("services.php?waterposts")
          .done(function( json ) {
            var icon = 'http://maps.google.com/mapfiles/ms/icons/drinking_water.png';
            drawMarkers(json, icon, map);
          })
          .fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            console.log( "Request Failed: " + err );
        });
        }

    </script>
    <script async defer type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEktfNdaZNKr6X5d216LGOkJaYuVSdLYU&callback=initMap">
    </script>
  </body>
</html>