var GetURLParameter = function(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}
var base_path = '/fn';
var geolocation = (function($, document) {
    var evt = [
            function($) {

                if (navigator.geolocation) navigator.geolocation.getCurrentPosition(onPositionUpdate);

                function onPositionUpdate(position) {
                    var googleApiKey = "AIzaSyAHhJTqvMbixe8tZcprHVS_mDnVKy_X4Rg";
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lng + "&sensor=true&key=" + googleApiKey;

                    $('#lat').val(lat);
                    $('#lng').val(lng);
                    console.log(url);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            var loc = data.results[1].formatted_address;
                            if (loc) {
                                $('#loc').val(loc);
                                $('.location').text(loc);
                            }
                        }
                    });
                    initialize(lat, lng);
                }
                var map,
                    infowindow,
                    myLocation;

                function initialize(lat, lng) {
                    myLocation = new google.maps.LatLng(lat, lng);
                    var mapElem = document.getElementById('location-map');
                    if (mapElem) {
                        map = new google.maps.Map(mapElem, {
                            center: myLocation,
                            zoom: 15
                        });

                        var request = {
                            location: myLocation,
                            radius: GetURLParameter('radius') || '1000',
                            keyword: 'tourist spots',
                            types: ['park', 'zoo', 'church']
                        };

                        var service = new google.maps.places.PlacesService(map);
                        service.nearbySearch(request, callback);
                    }
                }

                function callback(results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        //console.log(results);
                        $.each(results, function(i, v) {
                            var list = '<a href="' + base_path + '/place.php?address=' + encodeURI(v.name + ',' + v.vicinity) + '&radius=' + GetURLParameter('radius') + '" class="list-group-item">' +
                                '<span>' + v.name + '</span><br>' +
                                '<small>' + v.vicinity + '</small>' +
                                '</a>';
                            $('.nearby').append(list)
                        });
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