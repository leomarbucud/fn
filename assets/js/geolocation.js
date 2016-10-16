var geolocation = (function($, document) {
    var evt = [
            function($) {
                console.log('mapping');
                if (navigator.geolocation) navigator.geolocation.getCurrentPosition(onPositionUpdate);

                function onPositionUpdate(position) {
                    var googleApiKey = "AIzaSyAHhJTqvMbixe8tZcprHVS_mDnVKy_X4Rg";
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lng + "&sensor=true&key=" + googleApiKey;

                    console.log(url);

                    // $http.get(url)
                    //     .then(function(result) {
                    //         var address = result.data.results[0].formatted_address;
                    //         $scope.currentLocation = address;
                    //     });
                    initialize(lat, lng);
                }

                var map,
                    infowindow,
                    myLocation;

                function initialize(lat, lng) {
                    myLocation = new google.maps.LatLng(lat, lng);
                    var mapElem = document.getElementById('location-map');
                    map = new google.maps.Map(mapElem, {
                        center: myLocation,
                        zoom: 15
                    });

                    var request = {
                        location: myLocation,
                        radius: '10000',
                        keyword: 'tourist spots',
                        types: ['park', 'zoo', 'church']
                    };



                    var service = new google.maps.places.PlacesService(map);
                    service.nearbySearch(request, callback);
                }

                function callback(results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {

                        // $scope.$apply(function() {
                        //     $scope.nearByPlaces = results;
                        //     console.log(results);
                        // });

                        createMarker(myLocation);

                    }
                }

                function createMarker(myLocation) {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: myLocation
                    });

                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.setContent(place.name);
                        infowindow.open(map, this);
                    });
                }
            }
        ],
        initAll = function() {
            initEvt();
        },
        initEvt = function() {
            evt.forEach(function(e) {
                e($, document);
            });
        };

    return { init: initAll };

})(jQuery, document);

geolocation.init();