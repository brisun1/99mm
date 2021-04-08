<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <!-- <link rel="stylesheet" type="text/css" href="master.css"> -->
</head>

<body>
    <div id="map" style="height:333px;width:500px;overflow: visible;"></div>
    <script>
        

    <h1>My First Google Map</h1>

    <div id="map" style="width:60%;height:800px;"></div>

    <script>
        function detectBrowser() {
            var useragent = navigator.userAgent;
            var mapdiv = document.getElementById("map");
            if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1) {
                mapdiv.style.width = '100%';
                mapdiv.style.height = '100%';
            } else {
                mapdiv.style.width = '600px';
                mapdiv.style.height = '800px';
            }
        }
        var myLatLng;
        var latit;
        var longit;
        function geoSuccess(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            //var directionsService = new google.maps.DirectionsService;
            //var directionsDisplay = new google.maps.DirectionsRenderer;
            myLatLng = {
                lat: latitude,
                lng: longitude
            };
            var mapProp = {
                //            center: new google.maps.LatLng(latitude, longitude), // puts your current location at the centre of the map,
                zoom: 15,
                mapTypeId: 'roadmap',
            };
            
            //////
            var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: {lat: 53, lng: -6.26}
          });
          
          var geocoder = new google.maps.Geocoder();
          geocodeAddress(geocoder, map);
            ////////
            
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            //call renderer to display directions
            directionsDisplay.setMap(map);
            
            //        var mapOptions = {
            //            mapTypeId: 'roadmap'
            //        };
           
            ////////////////
            directionsDisplay.setMap(map);
          var onClickHandler = function() {
            directionsService.route({
                        // origin: document.getElementById('start').value,
                        origin: myLatLng,
                        // destination: marker.getPosition(),
                        destination: {
                            lat: latit,
                            lng: longit
                        },
                        travelMode: 'DRIVING'
                    }, function(response, status) {
                        if (status === 'OK') {
                            directionsDisplay.setDirections(response);
                        } else {
                            window.alert('Directions request failed due to ' + status);
                        }
                    });
                
          //calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('dirBtn').addEventListener('click', onClickHandler);
            ///////////////////
            var markers = [
                ['3fe', 53.339964, -6.241972],
                
                ['my current location', latitude, longitude]
            ];
            // Info Window Content
            
            // Display multiple markers on a map
           
            // Loop through our array of markers & place each one on the map
            
        }
        
        function geoError() {
            alert("Geocoder failed.");
        }
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
                // alert("Geolocation is supported by this browser.");
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi9zEbNbmidV5rNdS3kcM0gEW1oAOYelY&callback=initMap"
async defer></script>

</body>

</html>